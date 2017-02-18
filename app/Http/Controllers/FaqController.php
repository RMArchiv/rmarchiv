<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faq = \DB::table('faq')
            ->orderBy('cat')
            ->get();

        $res = [];
        foreach ($faq as $f) {
            $t['id'] = $f->id;
            $t['cat'] = $f->cat;
            $t['title'] = $f->title;
            $t['desc_html'] = $f->desc_html;

            $res[$f->cat][] = $t;
        }

        return view('faq.index', [
            'faq' => $res,
        ]);
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cat' => 'required',
            'title' => 'required',
            'msg' => 'required',
        ]);

        \DB::table('faq')->insert([
            'cat' => $request->get('cat'),
            'title' => $request->get('title'),
            'desc_md' => $request->get('msg'),
            'desc_html' => \Markdown::convertToHtml($request->get('msg')),
        ]);

        return redirect()->action('FaqController@index');
    }
}
