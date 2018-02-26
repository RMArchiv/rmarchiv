@extends('layouts.app')
@section('pagetitle', 'tags')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>tags</h1>
                {!! Breadcrumbs::render('tags') !!}
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">

                </div>
                <ul class="list-group">
                    @foreach($tags as $t)
                        @if($t->tag_relations->count() <> 0 and $t->title <> '')
                            <li class="list-group-item">
                                <a href='{{ url('tags/game',$t->id) }}'>{{ $t->title }}</a>
                                <span class="badge">{{ $t->tag_relations->count() }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection