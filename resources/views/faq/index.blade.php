@extends('layouts.app')
@section('pagetitle', trans('faq.index.title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('faq.index.title') }}</h1>
                {!! Breadcrumbs::render('faq') !!}
            </div>
        </div>
        @foreach($faq as $cat)
            <div class="row">
                <div class="panel-group" id="faq{{ $cat->cat }}">
                    <div class="panel panel-default ">
                    @foreach(\App\Models\Faq::whereCat($cat->cat)->get() as $f)
                        <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faq{{ $f->cat }}" data-target="#question{{ $f->id }}">
                            <h4 class="panel-title">
                                <a href="#" class="ing">Q: {{ $f->cat }} # {{ $f->title }}</a>
                            </h4>
                        </div>
                        <div id="question{{ $f->id }}" class="panel-collapse collapse" style="height: 0px;">
                            <div class="panel-body">
                                <h5><span class="label label-primary">Answer</span></h5>
                                <p>
                                    {!! $f->desc_html !!}
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