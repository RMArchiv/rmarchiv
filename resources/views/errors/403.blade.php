@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-danger">
                    <div class="card-header">
                        403
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Kein Zugriff auf diese Seite.
                        </h5>
                        <p class="card-text">
                            Herzlichen Glückwunsch. Du hast eine Seite gefunden, für die du keine Berechtigung hast.
                        </p>
                        {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
                    </div>
                    <div class="card-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection