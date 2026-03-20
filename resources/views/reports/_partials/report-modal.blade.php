@if(Auth::check())
    <div class="modal fade" id="reportContentModal" tabindex="-1" aria-labelledby="reportContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('reports.content.store') }}">
                    @csrf
                    <input type="hidden" name="content_type" id="report-content-type">
                    <input type="hidden" name="content_id" id="report-content-id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportContentModalLabel">{{ trans('app.report_content') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ trans('app.close') }}"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">
                            {{ trans('app.report_content_for') }}:
                            <strong id="report-content-label"></strong>
                        </p>
                        <div class="mb-3">
                            <label class="form-label" for="report-reason">{{ trans('app.report_reason') }}</label>
                            <textarea class="form-control" id="report-reason" name="reason" rows="6" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('app.report_submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('reportContentModal');

            if (!modal) {
                return;
            }

            modal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;

                modal.querySelector('#report-content-type').value = button.getAttribute('data-report-type');
                modal.querySelector('#report-content-id').value = button.getAttribute('data-report-id');
                modal.querySelector('#report-content-label').textContent = button.getAttribute('data-report-label');
                modal.querySelector('#report-reason').value = '';
            });
        });
    </script>
@endif
