<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq.
 */
class Faq extends Model
{
    protected $table = 'faq';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'cat',
        'desc_md',
        'desc_html',
    ];

    protected $guarded = [];
}
