@extends('layouts.master')

@section('title')
Product Upload
@endsection

@section('content')
<div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="../storage/product_images/{{ Session::get('image') }}">
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
            'route' => 'uploadproduct','files'=>true)) !!}

        <div class="row">
            <div class="col-md-12">
                <h3>Title: </h3>
                  {!! Form::text('title'); !!}  
            </div>
        </div>
            <div class="row">
            <div class="col-md-12">
                <h3>Description: </h3>
                    {!! Form::textarea('description'); !!}  
              </div>
            </div>
              <div class="row">
              <div class="col-md-12">
                  <h3>Price: </h3>
                    {!! Form::text('price'); !!}  
              </div>
            </div>
              <div class="row">
                    <div class="col-md-6">
                        <h3>Image Upload:</h3>
                        {!! Form::file('image', array('class' => 'form-control')) !!}
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