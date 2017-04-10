<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 */
class Logo extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'logos';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'extension',
        'filename',
        'user_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function logovote()
    {
        return $this->belongsToMany('App\Models\LogoVote');
    }

    public function voteresult()
    {
        $up = LogoVote::whereLogoId($this->id)->selectRaw('SUM(up) as sumup, SUM(down) as sumdown');

        $res = $up->get(['sumup', 'sumdown']);

        return $res;
    }
}
