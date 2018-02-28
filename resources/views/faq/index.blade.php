@extends('layouts.app')
@section('pagetitle', trans('app.faq'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.faq') }}</h1>
                    {!! Breadcrumbs::render('faq') !!}
                </div>
            </div>
        </div>
            @foreach($faq as $cat)
                <div class="row">
                    <div class="col-md-12" id="faq{{ $cat->cat }}">
                        <div class="card">
                        @foreach(\App\Models\Faq::whereCat($cat->cat)->get() as $f)
                            <div class="card-header accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faq{{ $f->cat }}" data-target="#question{{ $f->id }}">
                                <a href="#" class="ing">Q: {{ $f->cat }} # {{ $f->title }}</a>
                            </div>
                            <div id="question{{ $f->id }}" class="panel-collapse collapse" style="height: 0px;">
                                <div class="card-body">
                                    <h5><span class="label label-primary">Answer</span></h5>
                                    <p>
                                        {!! Markdown::convertToHtml($f->desc_md) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
@endsection