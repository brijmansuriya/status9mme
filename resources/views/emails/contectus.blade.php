@extends('emails.template')
@section('emails.main')
<h1>Contact Us Email</h1>
<p>Name: {{ $data['name'] }}</p>
<p>Email: {{ $data['email'] }}</p>
<p>Subject: {{ $data['subject'] }}</p>
<p>Message: {{ $data['message'] }}</p>
@stop