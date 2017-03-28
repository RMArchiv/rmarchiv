@extends('layouts.app')
@section('content')
  <div id="content">
      <?php
      $default_error_message = 'Der Server ist entweder überlastet oder befindet sich im Wartungsmodus. Bitte versuche es später erneut.';
      ?>
    {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
  </div>

@endsection



