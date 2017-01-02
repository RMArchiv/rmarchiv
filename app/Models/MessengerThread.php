<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MessengerThread
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
 */
class MessengerThread extends Model
{
    protected $table = 'messenger_threads';

    public $timestamps = true;

    protected $fillable = [
        'subject'
    ];

    protected $guarded = [];

        
}