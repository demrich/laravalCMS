@extends('layouts.master')

@section('title')
Beat Donation
@endsection

@section('content')
<div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Looks like there's some problems.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(array(
            'route' => 'beatdonation','files'=>true)) !!}

        <div class="row">
            <div class="col-md-12">
                <h3>Song Name: </h3>
                  {!! Form::text('title'); !!}  
            </div>
        </div>
            <div class="row">
            <div class="col-md-12">
                <h3>Artist: </h3>
                    {!! Form::text('artist'); !!}  
              </div>
            </div>
              <div class="row">
              <div class="col-md-12">
                  <h3>Album: </h3>
                    {!! Form::text('album'); !!}  
              </div>
            </div>
              <div class="row">
                    <div class="col-md-6">
                        <h3>Beat Upload:</h3>
                        {!! Form::file('beat', array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>

        {!! Form::close() !!}
</div>

@endsection