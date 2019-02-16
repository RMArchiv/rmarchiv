<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
class EasyticketStatus extends Model
{
    protected $table = 'easyticket_status';

    public $timestamps = true;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'state_id',
    ];

    protected $guarded = [];
}
