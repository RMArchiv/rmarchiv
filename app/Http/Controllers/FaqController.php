<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faq = Faq::groupBy('cat')->orderBy('cat', 'asc')->get();

        return view('faq.index', [
            'faq' => $faq,
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
