@extends('layouts.app')
@section('pagetitle', trans('app.faq'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                        <h1 class="mb-0">{{ trans('app.faq') }}</h1>
                        @permission(('create-faq'))
                            <a href="{{ url('faq/create') }}" class="btn btn-primary">{{ trans('app.add_faq') }}</a>
                        @endpermission
                    </div>
                    {!! Breadcrumbs::render('faq') !!}
                </div>
            </div>
        </div>
            @foreach($faq as $catTitle => $entries)
                <div class="row">
                    <div class="col-md-12" id="faq{{ $catTitle }}">
                        <div class="card">
                            @foreach($entries as $f)
                                <div class="card-header d-flex justify-content-between align-items-center gap-2">
                                    <div class="accordion-toggle question-toggle collapsed flex-grow-1" data-bs-toggle="collapse" data-bs-parent="#faq{{ $f->cat }}" data-bs-target="#question{{ $f->id }}">
                                        <a href="#" class="ing">Q: {{ $f->cat }} # {{ $f->title }}</a>
                                    </div>
                                    @permission(('create-faq'))
                                        <a href="{{ route('faq.edit', $f->id) }}" class="btn btn-sm btn-outline-secondary flex-shrink-0">
                                            {{ trans('app.edit') }}
                                        </a>
                                    @endpermission
                                </div>
                                <div id="question{{ $f->id }}" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="card-body">
                                        <h5><span class="label label-primary">Answer</span></h5>
                                        <p>
                                            {!! $f->desc_html ?: Markdown::convertToHtml($f->desc_md) !!}
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
