<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EasyticketConsolelog
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
 */
class EasyticketConsolelog extends Model
{
    protected $table = 'easyticket_consolelog';

    public $timestamps = true;

    protected $fillable = [
        'ticket_id',
        'console_id',
        'console_type',
        'console_text'
    ];

    protected $guarded = [];

        
}