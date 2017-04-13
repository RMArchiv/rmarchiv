<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Waavi\Translation\Repositories\LanguageRepository;
use Waavi\Translation\Repositories\TranslationRepository;

class TranslationController extends Controller
{
    protected $lng;
    protected $trans;

    public function __construct(LanguageRepository $lng, TranslationRepository $trans)
    {
        $this->$lng = $lng;
        $this->$trans = $trans;
    }

    public function index()
    {
        $locales = $this->$lng->availableLocales();

        $list = [];

        foreach ($locales as $loc) {
            $temp['loc'] = $loc;
            $temp['perc'] = $this->$lng->percentTranslated($loc);
            $list[] = $temp;
        }

        return view('translate.index', [
            'list' => $list,
        ]);
    }

    public function edit($loc1, $loc2 = 'de', $viewtype = 'untranslated', $searchterm = '')
    {
        $list = $this->trans->untranslated($loc2);

        dd($list);

        return view('translate.show', [
            'list' => $list,
            'loc1' => $loc1,
            'loc2' => $loc2,
        ]);
    }
}
