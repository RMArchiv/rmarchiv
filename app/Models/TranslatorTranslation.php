<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 */
class TranslatorTranslation extends Model
{
    protected $table = 'translator_translations';

    public $timestamps = true;

    protected $fillable = [
        'locale',
        'namespace',
        'group',
        'item',
        'text',
        'unstable',
        'locked',
    ];

    protected $guarded = [];
}
