@if(Auth::check())
    <button
        type="button"
        class="btn btn-sm btn-outline-danger"
        data-bs-toggle="modal"
        data-bs-target="#reportContentModal"
        data-report-type="{{ $reportType }}"
        data-report-id="{{ $reportId }}"
        data-report-label="{{ $reportLabel }}"
    >
        {{ trans('app.report') }}
    </button>
@endif
