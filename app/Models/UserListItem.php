<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereListId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserListItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserListItem extends Model
{
    protected $table = 'user_list_items';

    public $timestamps = true;

    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
        'list_id',
    ];

    protected $guarded = [];
}
