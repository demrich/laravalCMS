@extends('layouts.master')

@section('title')
Product Upload
@endsection

@section('content')
<div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading"><h2>Upload a Product Here</h2></div>
      <div class="panel-body">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="../images/{{ Session::get('image') }}">
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(array(
            'route' => 'uploadproduct','files'=>true)) !!}
            <div class="row">
                <div class="col-md-6">
                    {!! Form::file('image', array('class' => 'form-control')) !!}
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
        {!! Form::close() !!}

      </div>
    </div>
</div>
@endsection