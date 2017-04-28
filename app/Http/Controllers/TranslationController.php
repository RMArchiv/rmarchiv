<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Waavi\Translation\Repositories\LanguageRepository;
use Waavi\Translation\Repositories\TranslationRepository;

class TranslationController extends Controller
{
    protected $languageRepository;
    protected $translationRepository;

    public function __construct(LanguageRepository $languageRepository, TranslationRepository $translationRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->translationRepository = $translationRepository;
    }

    public function index()
    {
        $locales = $this->languageRepository->availableLocales();

        $list = [];

        foreach ($locales as $loc) {
            $temp['loc'] = $loc;
            $temp['perc'] = $this->languageRepository->percentTranslated($loc);
            $list[] = $temp;
        }

        return view('translate.index', [
            'list' => $list,
        ]);
    }

    public function edit($loc1, $loc2 = 'de', $viewtype = 'untranslated', $searchterm = '')
    {
        $list = null;

        if($viewtype == 'untranslated'){
            $list = $this->translationRepository->untranslated($loc2);
        }elseif($viewtype == 'all'){
            $list = $this->translationRepository->allByLocale($loc2);
        }

        return view('translate.show', [
            'list' => $list,
            'loc1' => $loc1,
            'loc2' => $loc2,
        ]);
    }

    public function savestring(Request $request){
        dd($request);
    }
}
