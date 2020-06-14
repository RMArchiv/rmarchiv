<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
class TranslatorLanguage extends Model
{
    protected $table = 'translator_languages';

    public $timestamps = true;

    protected $fillable = [
        'locale',
        'name',
    ];

    protected $guarded = [];
}
