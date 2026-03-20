<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\BoardPost;
use App\Models\BoardThreadsTracker;
use App\Models\Developer;
use App\Models\GamesFile;
use App\Models\GamesDeveloper;
use App\Models\Logo;
use App\Models\Maker;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\News;
use App\Models\TagRelation;
use App\Models\User;
use App\Models\Comment;
use App\Models\Shoutbox;
use App\Helpers\MiscHelper;
use App\Models\BoardThread;
use App\Models\GamesCoupdecoeur;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $settings = $user?->settings;
        $isAuthenticated = $user !== null;
        $allowNsfw = $isAuthenticated;

        $widgets = [
            'cdc' => ! $settings || (int) $settings->disable_widget_cdc !== 1,
            'latestadded' => ! $settings || (int) $settings->disable_widget_gamesadded !== 1,
            'latestreleased' => ! $settings || (int) $settings->disable_widget_gamesreleased !== 1,
            'topmonth' => ! $settings || (int) $settings->disable_widget_topmonth !== 1,
            'topalltime' => ! $settings || (int) $settings->disable_widget_alltimetop !== 1,
            'shoutbox' => $isAuthenticated && (! $settings || (int) $settings->disable_widget_shoutbox !== 1),
            'board' => ! $settings || (int) $settings->disable_widget_board !== 1,
            'news' => ! $settings || (int) $settings->disable_widget_news !== 1,
            'tags' => ! $settings || (int) $settings->disable_widget_tags !== 1,
            'stats' => ! $settings || (int) $settings->disable_widget_stats !== 1,
            'obyx' => ! $settings || (int) $settings->disable_widget_obyx !== 1,
            'comments' => ! $settings || (int) $settings->disable_widget_comments !== 1,
        ];

        $gametypes = [];
        if ($widgets['topmonth']) {
            $gametypes = Cache::remember('home.gametypes', now()->addHours(6), function () {
                return \DB::table('games_files_types')
                    ->select('id', 'title', 'short')
                    ->get()
                    ->mapWithKeys(function ($type) {
                        return [$type->id => [
                            'title' => $type->title,
                            'short' => $type->short,
                        ]];
                    })
                    ->all();
            });
        }

        $news = collect();
        if ($widgets['news']) {
            $news = Cache::remember('home.news', now()->addMinutes(10), function () {
                return News::with('user:id,name')
                    ->withCount('comments')
                    ->where('approved', '=', 1)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            });
        }

        $shoutbox = collect();
        if ($widgets['shoutbox']) {
            $shoutbox = Cache::remember('home.shoutbox', now()->addMinutes(2), function () {
                return Shoutbox::with('user:id,name')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get()
                    ->reverse()
                    ->values();
            });
        }

        $cdc = null;
        if ($widgets['cdc']) {
            $cdc = Cache::remember('home.cdc', now()->addMinutes(10), function () {
                return GamesCoupdecoeur::with([
                    'game.maker:id,title,short',
                    'game.language:id,name,short',
                    'game.gamefiles' => function ($query) {
                        $query->select('id', 'game_id', 'release_type')
                            ->with(['gamefiletype:id,title,short']);
                    },
                    'game.developers' => function ($query) {
                        $query->select('id', 'game_id', 'developer_id')
                            ->with(['developer:id,name']);
                    },
                ])
                    ->orderBy('created_at', 'desc')
                    ->first();
            });

            if ($cdc?->game) {
                $this->attachDeveloperLinks(collect([$cdc->game]));
            }
        }

        $threads = collect();
        $unreadThreadIds = [];
        if ($widgets['board']) {
            $threads = BoardThread::with([
                'user:id,name',
                'last_user:id,name',
                'cat:id,title',
            ])
                ->withCount('posts')
                ->withCount('votes')
                ->orderBy('last_created_at', 'desc')
                ->limit(10)
                ->get();

            if ($isAuthenticated && $threads->isNotEmpty()) {
                $trackers = BoardThreadsTracker::where('user_id', $user->id)
                    ->whereIn('thread_id', $threads->pluck('id'))
                    ->get()
                    ->keyBy('thread_id');

                $unreadThreadIds = $threads
                    ->filter(function ($thread) use ($trackers) {
                        $tracker = $trackers->get($thread->id);

                        return ! $tracker || Carbon::parse($tracker->last_read)->lt(Carbon::parse($thread->last_created_at));
                    })
                    ->pluck('id')
                    ->all();
            }
        }

        $topusers = collect();
        $obyxmax = null;
        if ($widgets['obyx']) {
            $topusers = Cache::remember('home.topusers', now()->addMinutes(10), function () {
                return \DB::table('users as u')
                    ->leftJoin('user_obyx as uo', 'u.id', '=', 'uo.user_id')
                    ->leftJoin('obyx as o', 'o.id', '=', 'uo.obyx_id')
                    ->leftJoin('user_role_user as uru', 'u.id', '=', 'uru.user_id')
                    ->leftJoin('user_roles as ur', 'ur.id', '=', 'uru.role_id')
                    ->select([
                        'u.id as userid',
                        'u.name as username',
                        'u.created_at as usercreated_at',
                        'ur.display_name as rolename',
                        'ur.description as roledesc',
                    ])
                    ->selectRaw('COALESCE(SUM(o.value), 0) as obyx')
                    ->groupBy('u.id', 'u.name', 'u.created_at', 'ur.display_name', 'ur.description')
                    ->orderBy('obyx', 'desc')
                    ->limit(10)
                    ->get();
            });

            $obyxmax = $topusers->first();
        }

        $pm = $isAuthenticated ? $user->newThreadsCount() : '';

        $stats = [
            'stats_gamecount' => 0,
            'stats_makercount' => 0,
            'stats_developercount' => 0,
            'stats_usercount' => 0,
            'stats_threadcount' => 0,
            'stats_postcount' => 0,
            'stats_shoutboxcount' => 0,
            'stats_commentcount' => 0,
            'stats_logocount' => 0,
            'stats_downloadcount' => 0,
            'stats_totalsize' => 0,
            'stats_filecount' => 0,
            'size' => MiscHelper::getReadableBytes(0),
            'newuser' => null,
        ];
        if ($widgets['stats']) {
            $stats = Cache::remember('home.stats', now()->addMinutes(10), function () {
                $downloadTraffic = (int) \DB::table('games_files')
                    ->selectRaw('COALESCE(SUM(filesize * downloadcount), 0) as downsize')
                    ->value('downsize');

                return [
                    'stats_gamecount' => Game::count(),
                    'stats_makercount' => Maker::count(),
                    'stats_developercount' => Developer::count(),
                    'stats_usercount' => User::count(),
                    'stats_threadcount' => BoardThread::count(),
                    'stats_postcount' => BoardPost::count(),
                    'stats_shoutboxcount' => Shoutbox::count(),
                    'stats_commentcount' => Comment::count(),
                    'stats_logocount' => Logo::count(),
                    'stats_downloadcount' => GamesFile::sum('downloadcount'),
                    'stats_totalsize' => GamesFile::sum('filesize'),
                    'stats_filecount' => GamesFile::count(),
                    'size' => MiscHelper::getReadableBytes($downloadTraffic),
                    'newuser' => User::select('id', 'name')->orderBy('created_at', 'desc')->first(),
                ];
            });
        }

        $latestadded = collect();
        if ($widgets['latestadded']) {
            $latestadded = Cache::remember('home.latestadded.'.(int) $allowNsfw, now()->addMinutes(10), function () use ($allowNsfw) {
                return $this->baseHomeGameQuery($allowNsfw)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            });
            $this->attachDeveloperLinks($latestadded);
        }

        $latestreleased = collect();
        if ($widgets['latestreleased']) {
            $latestreleased = Cache::remember('home.latestreleased.'.(int) $allowNsfw, now()->addMinutes(10), function () use ($allowNsfw) {
                return $this->baseHomeGameQuery($allowNsfw)
                    ->where('release_type', '!=', 99)
                    ->orderBy('release_date', 'desc')
                    ->limit(5)
                    ->get();
            });
            $this->attachDeveloperLinks($latestreleased);
        }

        $topmonth = collect();
        if ($widgets['topmonth']) {
            $topmonth = Cache::remember('home.topmonth.'.(int) $allowNsfw, now()->addMinutes(10), function () use ($allowNsfw) {
                return $this->baseHomeGameQuery($allowNsfw)
                    ->whereExists(function ($query) {
                        $query->selectRaw('1')
                            ->from('comments')
                            ->whereColumn('comments.content_id', 'games.id')
                            ->where('comments.content_type', 'game')
                            ->where('comments.created_at', '>', Carbon::today()->addMonth(-1)->toDateString());
                    })
                    ->orderByRaw('(voteup - votedown) / NULLIF((voteup + votedown), 0) DESC')
                    ->limit(5)
                    ->get();
            });
            $this->attachDeveloperLinks($topmonth);
        }

        $topalltime = collect();
        if ($widgets['topalltime']) {
            $topalltime = Cache::remember('home.topalltime.'.(int) $allowNsfw, now()->addMinutes(10), function () use ($allowNsfw) {
                return $this->baseHomeGameQuery($allowNsfw)
                    ->orderBy('avg', 'desc')
                    ->orderBy('voteup', 'desc')
                    ->limit(5)
                    ->get();
            });
            $this->attachDeveloperLinks($topalltime);
        }

        $latestcomments = collect();
        if ($widgets['comments']) {
            $latestcomments = Comment::with('game')
                ->whereContentType('game')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        $randomgame = $this->getRandomVisibleGame($allowNsfw);
        if ($randomgame) {
            $this->attachDeveloperLinks(collect([$randomgame]));
        }

        $tagCloudHtml = null;
        if ($widgets['tags']) {
            $tagCloudHtml = Cache::remember('home.tagcloud', now()->addMinutes(30), function () {
                $tags = \DB::table('tag_relations')
                    ->join('tags', 'tags.id', '=', 'tag_relations.tag_id')
                    ->select('tags.id', 'tags.title')
                    ->selectRaw('COUNT(tag_relations.id) as usage_count')
                    ->groupBy('tags.id', 'tags.title')
                    ->orderByDesc('usage_count')
                    ->limit(25)
                    ->get();

                if ($tags->isEmpty()) {
                    return '';
                }

                $maxUsage = max((int) $tags->max('usage_count'), 1);

                return $tags->map(function ($tag) use ($maxUsage) {
                    $ratio = $tag->usage_count / $maxUsage;
                    $btnsize = match (true) {
                        $ratio <= 0.2 => 6,
                        $ratio <= 0.4 => 5,
                        $ratio <= 0.6 => 4,
                        $ratio <= 0.8 => 3,
                        default => 2,
                    };

                    $url = action('TaggingController@showGames', $tag->id);

                    return '<div style="display: inline-block;"><a href="'.$url.'"><span style="word-wrap:normal;" class="m-3 h'.$btnsize.'">'.$tag->title.'</span></a></div>';
                })->implode('');
            });
        }

        return view('index.index', [
            'settings'       => $settings,
            'widgets'        => $widgets,
            'news'           => $news,
            'shoutbox'       => $shoutbox,
            'cdc'            => $cdc,
            'latestadded'    => $latestadded,
            'gametypes'      => $gametypes,
            'latestreleased' => $latestreleased,
            'threads'        => $threads,
            'obeymax'        => $obyxmax,
            'topusers'       => $topusers,
            'pm'             => $pm,
            'topmonth'       => $topmonth,
            'topalltime'     => $topalltime,
            'latestcomments' => $latestcomments,
            'size'           => $stats['size'],
            'randomgame'     => $randomgame,
            'newuser'        => $stats['newuser'],
            'stats_gamecount' => $stats['stats_gamecount'],
            'stats_makercount' => $stats['stats_makercount'],
            'stats_developercount' => $stats['stats_developercount'],
            'stats_usercount' => $stats['stats_usercount'],
            'stats_threadcount' => $stats['stats_threadcount'],
            'stats_postcount' => $stats['stats_postcount'],
            'stats_shoutboxcount' => $stats['stats_shoutboxcount'],
            'stats_commentcount' => $stats['stats_commentcount'],
            'stats_logocount' => $stats['stats_logocount'],
            'stats_downloadcount' => $stats['stats_downloadcount'],
            'stats_totalsize' => $stats['stats_totalsize'],
            'stats_filecount' => $stats['stats_filecount'],
            'tagCloudHtml'    => $tagCloudHtml,
            'unreadThreadIds' => $unreadThreadIds,
        ]);
    }

    private function baseHomeGameQuery(bool $allowNsfw)
    {
        $query = Game::query()
            ->select([
                'id',
                'title',
                'subtitle',
                'maker_id',
                'lang_id',
                'created_at',
                'release_date',
                'release_type',
                'voteup',
                'avg',
                'invisible_on_start_page',
                'nsfw',
            ])
            ->with([
                'maker:id,title,short',
                'language:id,name,short',
                'gamefiles' => function ($query) {
                    $query->select('id', 'game_id', 'release_type')
                        ->with(['gamefiletype:id,title,short']);
                },
                'developers' => function ($query) {
                    $query->select('id', 'game_id', 'developer_id')
                        ->with(['developer:id,name']);
                },
            ])
            ->where('games.invisible_on_start_page', '=', 0);

        if (! $allowNsfw) {
            $query->where('nsfw', '=', false);
        }

        return $query;
    }

    private function attachDeveloperLinks(Collection $games): void
    {
        foreach ($games as $game) {
            $links = collect($game->developers ?? [])
                ->map(function ($developerRelation) {
                    $developer = $developerRelation->developer;

                    if (! $developer) {
                        return null;
                    }

                    return '<a href="'.url('developer', $developer->id).'">'.$developer->name.'</a>';
                })
                ->filter()
                ->implode(' :: ');

            $game->setAttribute('developer_links', $links);
        }
    }

    private function getRandomVisibleGame(bool $allowNsfw): ?Game
    {
        $cacheKey = 'home.randomgame.'.(int) $allowNsfw;

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($allowNsfw) {
            $baseQuery = Game::query()->where('games.invisible_on_start_page', '=', 0);

            if (! $allowNsfw) {
                $baseQuery->where('nsfw', '=', false);
            }

            $maxId = (clone $baseQuery)->max('id');
            if (! $maxId) {
                return null;
            }

            $randomId = random_int(1, $maxId);

            $game = $this->baseHomeGameQuery($allowNsfw)
                ->where('id', '>=', $randomId)
                ->orderBy('id')
                ->first();

            if ($game) {
                return $game;
            }

            return $this->baseHomeGameQuery($allowNsfw)
                ->orderBy('id')
                ->first();
        });
    }
}
