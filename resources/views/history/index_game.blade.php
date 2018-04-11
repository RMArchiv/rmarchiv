@extends('layouts.app')
@section('pagetitle', trans('app.changelog'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.changelog') }}</h1>
                    {!! Breadcrumbs::render('game.changelog', $game) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.changelog') }}
                    </div>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>{{ trans('app.activity') }}</th>
                            <th>{{ trans('app.date') }}</th>
                            <th>{{ trans('app.activity_by') }}</th>
                            <th>{{ trans('app.change') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activity as $a)
                            <tr>
                                <td>
                                    {{ $a->description }}
                                </td>
                                <td>
                                    {{ $a->created_at }}
                                </td>
                                <td>
                                    <a href="{{ action('UserController@show', $a->causer->id) }}" class="usera" title="{{ $a->causer->name }}">
                                        <img width="16px" src="//{{ config('app.avatar_path') }}?gender=male&amp;id={{ $a->causer->id }}" alt="{{ $a->causer->name }}" class="avatar">
                                    </a>
                                    <a href="{{ action('UserController@show', $a->causer->id) }}" class="user">{{ $a->causer->name }}</a>
                                </td>
                                <td>
                                    @if($a->description == 'updated')
                                        {{ implode(', ', array_keys(\App\Helpers\MiscHelper::array_diff_assoc_recursive($a->changes()['old'], $a->changes()['attributes']))) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection