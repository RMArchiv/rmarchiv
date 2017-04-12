<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Waavi\Translation\Repositories\LanguageRepository;

class TranslationController extends Controller
{
    protected $repository;

    public function __construct(LanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $locales = $this->repository->availableLocales();

        $list = [];

        foreach ($locales as $loc) {
            $temp['loc'] = $loc;
            $temp['perc'] = $this->repository->percentTranslated($loc);
            $list[] = $temp;
        }

        return view('translate.index', [
            'list' => $list,
        ]);
    }

    public function edit($loc, $loc2 = 'de')
    {
    }
}
