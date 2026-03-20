@extends('layouts.app')
@section('pagetitle', trans('app.add_faq'))
@section('content')
<div class="container">
    @permission(('create-faq'))
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>{{ $isEdit ? trans('app.edit') : trans('app.add_faq') }}</h1>
                {!! $isEdit ? Breadcrumbs::render('faq-edit', $faqEntry) : Breadcrumbs::render('faq-add') !!}
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="row">
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
                <h4>Fehler!</h4>
                <p>
                <ul>
                    @foreach($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </ul>
                </p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <form action="{{ $formAction }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('faq._form', [
                    'faqEntry' => $faqEntry,
                    'submitLabel' => $submitLabel,
                ])
            </form>
        </div>
    </div>
    @else
        @include('_partials.accessdenied')
    @endpermission
</div>

@endsection
