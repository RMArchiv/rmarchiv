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
        $faq = Faq::orderBy('cat', 'asc')
            ->orderBy('title', 'asc')
            ->get()
            ->groupBy('cat');

        return view('faq.index', [
            'faq' => $faq,
        ]);
    }

    public function create()
    {
        return view('faq.create', [
            'faqEntry' => new Faq(),
            'formAction' => url('faq'),
            'submitLabel' => trans('app.add_faq'),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cat'   => 'required',
            'title' => 'required',
            'msg'   => 'required',
        ]);

        \DB::table('faq')->insert([
            'cat'       => $request->get('cat'),
            'title'     => $request->get('title'),
            'desc_md'   => $request->get('msg'),
            'desc_html' => \Markdown::convertToHtml($request->get('msg')),
        ]);

        return redirect()->action('FaqController@index');
    }

    public function edit($id)
    {
        $faqEntry = Faq::whereId($id)->firstOrFail();

        return view('faq.create', [
            'faqEntry' => $faqEntry,
            'formAction' => route('faq.update', $faqEntry->id),
            'submitLabel' => trans('app.save_note'),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cat'   => 'required',
            'title' => 'required',
            'msg'   => 'required',
        ]);

        $faqEntry = Faq::whereId($id)->firstOrFail();
        $faqEntry->cat = $request->get('cat');
        $faqEntry->title = $request->get('title');
        $faqEntry->desc_md = $request->get('msg');
        $faqEntry->desc_html = \Markdown::convertToHtml($request->get('msg'));
        $faqEntry->save();

        return redirect()->action('FaqController@index');
    }
}
