<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class ActivityLog.
 *
 * @property int $id
 * @property string $log_name
 * @property string $description
 * @property int $subject_id
 * @property string $subject_type
 * @property int $causer_id
 * @property string $causer_type
 * @property string $properties
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereCauserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereCauserType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereLogName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereProperties($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereSubjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog query()
 */
	class ActivityLog extends \Eloquent {}
}

namespace App\Models{
/**
 * Class AwardCat.
 *
 * @property int $id
 * @property string $title
 * @property int $award_page_id
 * @property int $year
 * @property int $month
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereAwardPageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\AwardPage $awardpage
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AwardSubcat[] $subcats
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardCat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardCat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardCat query()
 * @property-read int|null $revision_history_count
 * @property-read int|null $subcats_count
 */
	class AwardCat extends \Eloquent {}
}

namespace App\Models{
/**
 * Class AwardPage.
 *
 * @property int $id
 * @property string $title
 * @property string $short
 * @property string $website_url
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardPage query()
 * @property-read int|null $revision_history_count
 */
	class AwardPage extends \Eloquent {}
}

namespace App\Models{
/**
 * Class AwardSubcat.
 *
 * @property int $id
 * @property string $title
 * @property string $desc_html
 * @property string $desc_md
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $page_id
 * @property int $cat_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat wherePageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereCatId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesAward[] $game_awards
 * @property-read \App\Models\AwardCat $award_cat
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardSubcat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardSubcat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardSubcat query()
 * @property-read int|null $game_awards_count
 * @property-read int|null $revision_history_count
 */
	class AwardSubcat extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Ban.
 *
 * @property int $id
 * @property int $bannable_id
 * @property string $bannable_type
 * @property int|null $created_by_id
 * @property string|null $created_by_type
 * @property string|null $comment
 * @property string|null $expired_at
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereBannableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereBannableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereCreatedByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban query()
 */
	class Ban extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BoardCat.
 *
 * @property int $id
 * @property int $order
 * @property string $title
 * @property string $desc
 * @property int $last_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $last_created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereLastUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereLastCreatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardThread[] $threads
 * @property-read \App\Models\User $last_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardCat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardCat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardCat query()
 * @property-read int|null $revision_history_count
 * @property-read int|null $threads_count
 */
	class BoardCat extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BoardPoll.
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $thread_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPollAnswer[] $answers
 * @property-read \App\Models\BoardThread $thread
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPoll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPoll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPoll query()
 * @property-read int|null $answers_count
 */
	class BoardPoll extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BoardPollAnswer.
 *
 * @property int $id
 * @property int $poll_id
 * @property string $title
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\BoardPoll $poll
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPollVote[] $votes
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer wherePollId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollAnswer query()
 * @property-read int|null $votes_count
 */
	class BoardPollAnswer extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BoardPollVote.
 *
 * @property int $id
 * @property int $poll_id
 * @property int $answer_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereAnswerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote wherePollId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollVote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollVote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollVote query()
 */
	class BoardPollVote extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BoardPost.
 *
 * @property int $id
 * @property int $user_id
 * @property int $cat_id
 * @property int $thread_id
 * @property string $content_md
 * @property string $content_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereContentMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereContentHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\BoardCat $cat
 * @property-read \App\Models\BoardThread $thread
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPost query()
 * @property-read int|null $revision_history_count
 */
	class BoardPost extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BoardThread.
 *
 * @property int $id
 * @property int $cat_id
 * @property int $user_id
 * @property string $title
 * @property int $closed
 * @property int $pinned
 * @property int $last_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $last_created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereClosed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread wherePinned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereLastUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereLastCreatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\BoardCat $cat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPost[] $posts
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $last_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\BoardPoll $votes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThread query()
 * @property-read int|null $posts_count
 * @property-read int|null $revision_history_count
 */
	class BoardThread extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BoardThreadsTracker.
 *
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property string $last_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereLastRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThreadsTracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThreadsTracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThreadsTracker query()
 * @property-read int|null $revision_history_count
 */
	class BoardThreadsTracker extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Comment.
 *
 * @property int $id
 * @property int $user_id
 * @property int $content_id
 * @property string $content_type
 * @property string $comment_md
 * @property string $comment_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $vote_up
 * @property int $vote_down
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereVoteUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereVoteDown($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $content
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Game $game
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\News $news
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment withoutTrashed()
 * @property int $deleted
 * @property string $delete_reason
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDeleteReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @property-read int|null $revision_history_count
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Developer.
 *
 * @property int $id
 * @property string $name
 * @property string $short
 * @property string $website_url
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Developer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Developer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Developer query()
 * @property-read int|null $revision_history_count
 */
	class Developer extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Easyticket.
 *
 * @property int $id
 * @property int $gamefile_id
 * @property int $user_id
 * @property int|null $savegame_id
 * @property string $userreport
 * @property string $player_version
 * @property string $known_patches
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereGamefileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereKnownPatches($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket wherePlayerVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereSavegameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereUserreport($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket query()
 */
	class Easyticket extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EasyticketConsolelog.
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $console_id
 * @property string $console_type
 * @property string $console_text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog whereConsoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog whereConsoleText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog whereConsoleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketConsolelog query()
 */
	class EasyticketConsolelog extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EasyticketStatus.
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property int $state_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EasyticketStatus query()
 */
	class EasyticketStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Event.
 *
 * @property int $id
 * @property int $user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $title
 * @property string $description
 * @property int $slots
 * @property string $reg_start_date
 * @property string $reg_end_date
 * @property int $reg_allowed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegAllowed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventSetting[] $settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventMeeting[] $meetings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventUserRegistered[] $users_registered
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventPicture[] $pictures
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @property-read int|null $comments_count
 * @property-read int|null $meetings_count
 * @property-read int|null $pictures_count
 * @property-read int|null $revision_history_count
 * @property-read int|null $users_registered_count
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EventAdmin.
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventAdmin query()
 * @property-read int|null $revision_history_count
 */
	class EventAdmin extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EventMeeting.
 *
 * @property int $id
 * @property int $event_id
 * @property int $reg_type
 * @property int $slots
 * @property string $start_date
 * @property string $end_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereRegType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeeting query()
 * @property-read int|null $revision_history_count
 */
	class EventMeeting extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EventMeetingUserRegistered.
 *
 * @property int $id
 * @property int $event_id
 * @property int $meeting_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereMeetingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeetingUserRegistered newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeetingUserRegistered newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeetingUserRegistered query()
 * @property-read int|null $revision_history_count
 */
	class EventMeetingUserRegistered extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EventPicture.
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property string $title
 * @property string $desc
 * @property string $filename
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture query()
 * @property-read int|null $revision_history_count
 */
	class EventPicture extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EventSetting.
 *
 * @property int $id
 * @property int $event_id
 * @property int $slots
 * @property string $reg_start_date
 * @property string $reg_end_date
 * @property int $reg_allowed
 * @property int $reg_price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegAllowed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventSetting query()
 * @property-read int|null $revision_history_count
 */
	class EventSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EventUserRegistered.
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int $reg_price_payed
 * @property int $reg_state
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereRegPricePayed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereRegState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Event $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUserRegistered newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUserRegistered newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUserRegistered query()
 * @property-read int|null $revision_history_count
 */
	class EventUserRegistered extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Faq.
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $cat
 * @property string $desc_md
 * @property string $desc_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereCat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq query()
 * @property-read int|null $revision_history_count
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Game.
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property string $desc_md
 * @property string $desc_html
 * @property string $website_url
 * @property int $user_id
 * @property int $views
 * @property string $release_date
 * @property int $maker_id
 * @property int $lang_id
 * @property string $deleted_at
 * @property int $atelier_id
 * @property string $makerpendium_article
 * @property int $invisible_on_start_page
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereViews($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereReleaseDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereMakerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereLangId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereMakerpeniumArticle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereInvisibleOnStartPage($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Maker $maker
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesDeveloper[] $developer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Developer[] $developers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Screenshot[] $screenshots
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read mixed $votes
 * @property-read \App\Models\Language $language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesFile[] $gamefiles
 * @property string $youtube
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereYoutube($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TagRelation[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserCredit[] $credits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesAward[] $awards
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesCoupdecoeur[] $cdcs
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereAtelierId($value)
 * @property int $release_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereReleaseType($value)
 * @property int $voteup
 * @property int $votedown
 * @property string $avg
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereAvg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereVotedown($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereVoteup($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property string $desc_md_translation
 * @property int $license_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereDescMdTranslation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereLicenseId($value)
 * @property-read \App\Models\License $license
 * @property int $is_banned
 * @property string $is_banned_reason
 * @property string $is_banned_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereIsBannedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereIsBannedReason($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read int|null $awards_count
 * @property-read int|null $cdcs_count
 * @property-read int|null $comments_count
 * @property-read int|null $credits_count
 * @property-read int|null $developers_count
 * @property-read int|null $gamefiles_count
 * @property-read int|null $revision_history_count
 * @property-read int|null $screenshots_count
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereMakerpendiumArticle($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Models{
/**
 * Class GamesAward.
 *
 * @property int $id
 * @property int $game_id
 * @property int $developer_id
 * @property int $award_cat_id
 * @property int $award_page_id
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $place
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDeveloperId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardPageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDescription($value)
 * @mixin \Eloquent
 * @property int $award_subcat_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardSubcatId($value)
 * @property-read \App\Models\User $user
 * @property-read \App\Models\AwardCat $cat
 * @property-read \App\Models\AwardPage $page
 * @property-read \App\Models\AwardSubcat $subcat
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\Game $game
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesAward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesAward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesAward query()
 * @property-read int|null $revision_history_count
 */
	class GamesAward extends \Eloquent {}
}

namespace App\Models{
/**
 * Class GamesCoupdecoeur.
 *
 * @property int $id
 * @property int $game_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesCoupdecoeur newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesCoupdecoeur newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesCoupdecoeur query()
 * @property-read int|null $revision_history_count
 */
	class GamesCoupdecoeur extends \Eloquent {}
}

namespace App\Models{
/**
 * Class GamesDeveloper.
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $developer_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereDeveloperId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Developer $developer
 * @property-read \App\Models\Game $game
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesDeveloper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesDeveloper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesDeveloper query()
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read int|null $revision_history_count
 */
	class GamesDeveloper extends \Eloquent {}
}

namespace App\Models{
/**
 * Class GamesFile.
 *
 * @property int $id
 * @property int $game_id
 * @property int $filesize
 * @property string $extension
 * @property int $release_type
 * @property string $release_version
 * @property int $release_year
 * @property int $release_month
 * @property int $release_day
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereFilesize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $filename
 * @property int $downloadcount
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereDownloadcount($value)
 * @property-read \App\Models\GamesFilesType $gamefiletype
 * @property-read \App\Models\Game $game
 * @property int $forbidden
 * @property string $reason
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereForbidden($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReason($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlayerIndexjson[] $playerIndex
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile withoutTrashed()
 * @property int|null $language_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesFile whereLanguageId($value)
 * @property-read \App\Models\Language|null $language
 * @property-read int|null $player_index_count
 * @property-read int|null $revision_history_count
 */
	class GamesFile extends \Eloquent {}
}

namespace App\Models{
/**
 * Class GamesFilesType.
 *
 * @property int $id
 * @property string $title
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $short
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereShort($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesFilesType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesFilesType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesFilesType query()
 * @property-read int|null $revision_history_count
 */
	class GamesFilesType extends \Eloquent {}
}

namespace App\Models{
/**
 * Class GamesSavegame.
 *
 * @property int $id
 * @property int $user_id
 * @property int $gamefile_id
 * @property int $slot_id
 * @property mixed $save_data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereSaveData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereSlotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\GamesFile $gamefile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesSavegame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesSavegame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GamesSavegame query()
 */
	class GamesSavegame extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Language.
 *
 * @property int $id
 * @property string $name
 * @property string $short
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @property-read int|null $revision_history_count
 */
	class Language extends \Eloquent {}
}

namespace App\Models{
/**
 * Class License.
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License query()
 */
	class License extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Logo.
 *
 * @property int $id
 * @property string $title
 * @property string $extension
 * @property string $filename
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Logo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LogoVote[] $logovote
 * @property-read int $voteresult
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logo query()
 * @property-read int|null $logovote_count
 * @property-read int|null $revision_history_count
 */
	class Logo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class LogoVote.
 *
 * @property int $id
 * @property int $logo_id
 * @property int $user_id
 * @property int $up
 * @property int $down
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Logo $logo
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereLogoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereDown($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogoVote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogoVote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogoVote query()
 * @property-read int|null $revision_history_count
 */
	class LogoVote extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Maker.
 *
 * @property int $id
 * @property string $title
 * @property string $short
 * @property string $website_url
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Game $game
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Maker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Maker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Maker query()
 * @property-read int|null $games_count
 * @property-read int|null $revision_history_count
 */
	class Maker extends \Eloquent {}
}

namespace App\Models{
/**
 * Class MessengerMessage.
 *
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerMessage query()
 * @property-read int|null $revision_history_count
 */
	class MessengerMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * Class MessengerParticipant.
 *
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $last_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereLastRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerParticipant query()
 * @property-read int|null $revision_history_count
 */
	class MessengerParticipant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class MessengerThread.
 *
 * @property int $id
 * @property string $subject
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MessengerParticipant[] $participants
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerThread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerThread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessengerThread query()
 * @property-read int|null $participants_count
 * @property-read int|null $revision_history_count
 */
	class MessengerThread extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Migration.
 *
 * @property int $id
 * @property string $migration
 * @property int $batch
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Migration whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Migration whereMigration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Migration whereBatch($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration query()
 * @property-read int|null $revision_history_count
 */
	class Migration extends \Eloquent {}
}

namespace App\Models{
/**
 * Class News.
 *
 * @property int $id
 * @property string $title
 * @property string $news_md
 * @property string $news_html
 * @property string $news_category
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property int $approved
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereApproved($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @property-read int|null $comments_count
 * @property-read int|null $revision_history_count
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Obyx.
 *
 * @property int $id
 * @property int $value
 * @property string $reason
 * @property string $reason_visible
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereReasonVisible($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Obyx newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Obyx newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Obyx query()
 * @property-read int|null $revision_history_count
 */
	class Obyx extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PasswordReset.
 *
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereCreatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset query()
 * @property-read int|null $revision_history_count
 */
	class PasswordReset extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PlayerFeedback.
 *
 * @property int $id
 * @property int $gamefile_id
 * @property int $user_id
 * @property string $issue_desc
 * @property string $known_patches
 * @property string $steps_to
 * @property int $savegame_slot
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereGamefileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereIssueDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereKnownPatches($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereSavegameSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereStepsTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback query()
 */
	class PlayerFeedback extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PlayerFileGamefileRel.
 *
 * @property int $id
 * @property int $gamefile_id
 * @property int $file_hash_id
 * @property string $orig_filename
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereFileHashId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereOrigFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\PlayerFileHash $filehash
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFileGamefileRel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFileGamefileRel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFileGamefileRel query()
 */
	class PlayerFileGamefileRel extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PlayerFileHash.
 *
 * @property int $id
 * @property string $filehash
 * @property int $supported
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereFilehash($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereSupported($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFileHash newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFileHash newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFileHash query()
 */
	class PlayerFileHash extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PlayerIndexjson.
 *
 * @property int $id
 * @property int $gamefile_id
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereValue($value)
 * @mixin \Eloquent
 * @property string $filename
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerIndexjson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerIndexjson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerIndexjson query()
 */
	class PlayerIndexjson extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Resource.
 *
 * @property int $id
 * @property string $type
 * @property string $cat
 * @property int $user_id
 * @property string $title
 * @property string $desc_md
 * @property string $desc_html
 * @property string $content_type
 * @property string $content_path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereCat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereContentPath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read mixed $votes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TagRelation[] $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Resource query()
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read int|null $comments_count
 * @property-read int|null $revision_history_count
 * @property-read int|null $tags_count
 */
	class Resource extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Revision.
 *
 * @property int $id
 * @property string $revisionable_type
 * @property int $revisionable_id
 * @property int $user_id
 * @property string $key
 * @property string $old_value
 * @property string $new_value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereNewValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereOldValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereRevisionableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereRevisionableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Revision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Revision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Revision query()
 */
	class Revision extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Screenshot.
 *
 * @property int $id
 * @property int $game_id
 * @property int $user_id
 * @property int $screenshot_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $filename
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereScreenshotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereFilename($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Screenshot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Screenshot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Screenshot query()
 * @property-read int|null $revision_history_count
 */
	class Screenshot extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Session.
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string $payload
 * @property int $last_activity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session query()
 */
	class Session extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Shoutbox.
 *
 * @property int $id
 * @property string $shout_md
 * @property string $shout_html
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereShoutMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereShoutHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoutbox newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoutbox newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shoutbox query()
 * @property-read int|null $notifications_count
 * @property-read int|null $revision_history_count
 */
	class Shoutbox extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Tag.
 *
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TagRelation[] $tag_relations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 * @property-read int|null $revision_history_count
 * @property-read int|null $tag_relations_count
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * Class TagRelation.
 *
 * @property int $id
 * @property int $tag_id
 * @property int $user_id
 * @property int $content_id
 * @property string $content_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereTagId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Tag $tag
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TagRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TagRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TagRelation query()
 * @property-read int|null $games_count
 * @property-read int|null $revision_history_count
 */
	class TagRelation extends \Eloquent {}
}

namespace App\Models{
/**
 * Class TranslatorLanguage.
 *
 * @property int $id
 * @property string $locale
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorLanguage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorLanguage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorLanguage whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorLanguage whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TranslatorLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TranslatorLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TranslatorLanguage query()
 */
	class TranslatorLanguage extends \Eloquent {}
}

namespace App\Models{
/**
 * Class TranslatorTranslation.
 *
 * @property int $id
 * @property string $locale
 * @property string $namespace
 * @property string $group
 * @property string $item
 * @property string $text
 * @property bool $unstable
 * @property bool $locked
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereItem($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereLocked($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereNamespace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereUnstable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TranslatorTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TranslatorTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TranslatorTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TranslatorTranslation query()
 */
	class TranslatorTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $is_admin
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Logo[] $logo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LogoVote[] $logovote
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Message[] $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\News[] $news
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Participant[] $participants
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $roles
 * @property-read \App\Models\UserSetting $settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Thread[] $threads
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserList[] $userlists
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserObyx[] $userobyx
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $discord_user
 * @property string $discord_channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPost[] $boardposts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDiscordChannel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDiscordUser($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Shoutbox[] $shoutbox
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Developer[] $developers
 * @property string|null $banned_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cog\Laravel\Ban\Models\Ban[] $bans
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBannedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withRole($role)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @property-read int|null $bans_count
 * @property-read int|null $boardposts_count
 * @property-read int|null $comments_count
 * @property-read int|null $developers_count
 * @property-read int|null $games_count
 * @property-read int|null $logo_count
 * @property-read int|null $logovote_count
 * @property-read int|null $messages_count
 * @property-read int|null $news_count
 * @property-read int|null $notifications_count
 * @property-read int|null $participants_count
 * @property-read int|null $revision_history_count
 * @property-read int|null $roles_count
 * @property-read int|null $shoutbox_count
 * @property-read int|null $threads_count
 * @property-read int|null $userlists_count
 * @property-read int|null $userobyx_count
 */
	class User extends \Eloquent implements \Cog\Contracts\Ban\Bannable {}
}

namespace App\Models{
/**
 * Class UserCredit.
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $credit_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereCreditTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\UserCreditType $type
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit query()
 * @property-read int|null $revision_history_count
 */
	class UserCredit extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserCreditType.
 *
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCreditType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCreditType whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCreditType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCreditType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCreditType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCreditType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCreditType query()
 * @property-read int|null $revision_history_count
 */
	class UserCreditType extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserDownloadLog.
 *
 * @property int $id
 * @property int $user_id
 * @property int $gamefile_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDownloadLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDownloadLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserDownloadLog query()
 * @property-read int|null $revision_history_count
 */
	class UserDownloadLog extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserList.
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $desc_html
 * @property string $desc_md
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserListItem[] $listitems
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserList query()
 * @property-read int|null $listitems_count
 * @property-read int|null $revision_history_count
 */
	class UserList extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserListItem.
 *
 * @property int $id
 * @property int $content_id
 * @property string $content_type
 * @property int $user_id
 * @property int $list_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereListId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\UserList $userlist
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserListItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserListItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserListItem query()
 * @property-read int|null $revision_history_count
 */
	class UserListItem extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserObyx.
 *
 * @property int $id
 * @property int $user_id
 * @property int $obyx_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereObyxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Obyx $obyx
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserObyx newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserObyx newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserObyx query()
 * @property-read int|null $revision_history_count
 */
	class UserObyx extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserOnline.
 *
 * @property int $id
 * @property int $user_id
 * @property string $last_place
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereLastPlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOnline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOnline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOnline query()
 * @property-read int|null $revision_history_count
 */
	class UserOnline extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserPermission.
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPermission query()
 * @property-read int|null $roles_count
 */
	class UserPermission extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserPermissionRole.
 *
 * @property int $permission_id
 * @property int $role_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermissionRole wherePermissionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermissionRole whereRoleId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPermissionRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPermissionRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPermissionRole query()
 * @property-read int|null $revision_history_count
 */
	class UserPermissionRole extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserReport.
 *
 * @property int $id
 * @property int $user_id
 * @property int $content_id
 * @property string $content_type
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $closed
 * @property int $closed_user_id
 * @property string $closed_remarks
 * @property string $closed_at
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $user_closed
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosedRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosedUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReport query()
 * @property-read int|null $revision_history_count
 */
	class UserReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserRole.
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserPermission[] $perms
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole query()
 * @property-read int|null $perms_count
 * @property-read int|null $users_count
 */
	class UserRole extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserRoleUser.
 *
 * @property int $user_id
 * @property int $role_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRoleUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRoleUser whereRoleId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRoleUser query()
 * @property-read int|null $revision_history_count
 */
	class UserRoleUser extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserSetting.
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_admin
 * @property int $is_moderator
 * @property string $avatar_path
 * @property int $is_banned
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereAvatarPath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property int $disable_widget_msg
 * @property int $disable_widget_cdc
 * @property int $disable_widget_gamesreleased
 * @property int $disable_widget_gamesadded
 * @property int $disable_widget_topmonth
 * @property int $disable_widget_alltimetop
 * @property int $disable_widget_news
 * @property int $disable_widget_board
 * @property int $disable_widget_shoutbox
 * @property int $disable_widget_search
 * @property int $disable_widget_tags
 * @property int $disable_widget_stats
 * @property int $disable_widget_obyx
 * @property int $disable_widget_comments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetAlltimetop($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetBoard($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetCdc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetGamesadded($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetGamesreleased($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetMsg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetNews($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetObyx($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetSearch($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetShoutbox($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetStats($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetTopmonth($value)
 * @property int $rows_per_page_developer
 * @property int $rows_per_page_games
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereRowsPerPageDeveloper($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereRowsPerPageGames($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property string $language
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting whereLanguage($value)
 * @property string $download_template
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting whereDownloadTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting query()
 * @property-read int|null $revision_history_count
 */
	class UserSetting extends \Eloquent {}
}

