@extends('emails.template')
@section('emails.main')
    <h2 class="t-black">{{ $name }},</h2>
    <p class="t-black">{!! $body !!}</p>
@stop

