@extends('layouts.master')

@section('title')
Profile
@endsection

@section('content')

<h1>Hello, {{ Auth::user()->first_name }}</h1><br>
<a href="https://youtu.be/atWUeGBIAAM?t=7m" target="_blank">
<img src="/img/eye.gif" width="300">
</a>

@endsection