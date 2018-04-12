<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

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
 */
class Developer extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    use Searchable;

    protected $table = 'developer';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'short',
        'website_url',
        'user_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
