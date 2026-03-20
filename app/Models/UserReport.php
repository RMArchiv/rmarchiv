<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
 */
class UserReport extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'user_reports';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'content_id',
        'content_type',
        'reason',
        'closed_user_id',
        'closed',
        'closed_remarks',
        'closed_at',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function user_closed()
    {
        return $this->hasOne('App\Models\User', 'id', 'closed_user_id');
    }

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'content_id');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment', 'content_id');
    }

    public function boardPost()
    {
        return $this->belongsTo('App\Models\BoardPost', 'content_id');
    }

    public function reportTypeLabel()
    {
        return match ($this->content_type) {
            'comment' => trans('app.report_comment'),
            'board_post' => trans('app.report_board_post'),
            'game' => trans('app.game'),
            default => ucfirst(str_replace('_', ' ', (string) $this->content_type)),
        };
    }

    public function reportedSubject()
    {
        return match ($this->content_type) {
            'comment' => optional($this->comment)->reportContextLabel() ?: 'Kommentar #'.$this->content_id,
            'board_post' => optional(optional($this->boardPost)->thread)->title ?: 'Forenbeitrag #'.$this->content_id,
            'game' => optional($this->game)->title ?: 'Spiel #'.$this->content_id,
            default => 'Eintrag #'.$this->content_id,
        };
    }

    public function reportedExcerpt($limit = 160)
    {
        return match ($this->content_type) {
            'comment' => optional($this->comment)->reportExcerpt($limit) ?: '',
            'board_post' => optional($this->boardPost)->reportExcerpt($limit) ?: '',
            default => Str::limit((string) $this->reason, $limit),
        };
    }

    public function reportedUrl()
    {
        return match ($this->content_type) {
            'comment' => optional($this->comment)->reportUrl(),
            'board_post' => optional($this->boardPost)->reportUrl(),
            'game' => optional($this->game) ? action('GameController@show', $this->game->id) : null,
            default => null,
        };
    }
}
