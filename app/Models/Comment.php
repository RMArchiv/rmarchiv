<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $content_id
 * @property string $content_type
 * @property string $comment_md
 * @property string $comment_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property integer $vote_up
 * @property integer $vote_down
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
 */
class Comment extends Model
{
    protected $table = 'comments';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'content_id',
        'content_type',
        'comment_md',
        'comment_html',
        'vote_up',
        'vote_down'
    ];

    protected $guarded = [];

        
}