@extends('layouts.app')
@section('pagetitle', trans('app.reported_comments'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.reported_comments') }}</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $reports->links('vendor.pagination.bootstrap-4') }}</div>
                    <div class="card-body table-responsive">
                        @if($reports->count() === 0)
                            {{ trans('app.no_reported_content') }}
                        @else
                            <table class="table table-striped align-middle">
                                <thead>
                                <tr>
                                    <th>{{ trans('app.type') }}</th>
                                    <th>{{ trans('app.content') }}</th>
                                    <th>{{ trans('app.report_reason') }}</th>
                                    <th>{{ trans('app.status') }}</th>
                                    <th>{{ trans('app.note') }}</th>
                                    <th>{{ trans('app.user') }}</th>
                                    <th>{{ trans('app.last_change_by') }}</th>
                                    <th>{{ trans('app.original_post') }}</th>
                                    <th>{{ trans('app.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $report->reportTypeLabel() }}</td>
                                        <td>
                                            <div><strong>{{ $report->reportedSubject() }}</strong></div>
                                            <div class="text-muted small">{{ $report->reportedExcerpt() }}</div>
                                        </td>
                                        <td>{{ $report->reason }}</td>
                                        <td>
                                            @if($report->closed)
                                                <span class="badge text-bg-success">{{ trans('app.done') }}</span>
                                            @else
                                                <span class="badge text-bg-warning">{{ trans('app.open') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('reports.comments.note', $report->id) }}">
                                                @csrf
                                                <textarea class="form-control form-control-sm mb-2" name="closed_remarks" rows="3">{{ $report->closed_remarks }}</textarea>
                                                <button type="submit" class="btn btn-sm btn-secondary">{{ trans('app.save_note') }}</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ url('users', $report->user_id) }}">{{ $report->user->name }}</a><br>
                                            <small class="text-muted">{{ $report->created_at }}</small>
                                        </td>
                                        <td>
                                            @if($report->user_closed)
                                                <a href="{{ url('users', $report->user_closed->id) }}">{{ $report->user_closed->name }}</a><br>
                                            @endif
                                            @if($report->closed_at)
                                                <small class="text-muted">{{ $report->closed_at }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($report->reportedUrl())
                                                <a href="{{ $report->reportedUrl() }}">{{ trans('app.show_original') }}</a>
                                            @else
                                                <span class="text-muted">{{ trans('app.not_available') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('reports.comments.status', $report->id) }}">
                                                @csrf
                                                <input type="hidden" name="closed" value="{{ $report->closed ? 0 : 1 }}">
                                                <button type="submit" class="btn btn-sm {{ $report->closed ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                    {{ $report->closed ? trans('app.reopen') : trans('app.close_report') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="card-footer">{{ $reports->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
