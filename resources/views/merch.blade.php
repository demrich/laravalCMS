@extends('layouts.master')

@section('title')
Merch
@endsection

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-3">Fluid jumbo heading</h1>
        <p class="lead">Jumbo helper text</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
        </p>
    </div>
</div>

<div>
    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@foreach($products->chunk(3) as $productChunk)

<div class="row">
    @foreach($productChunk as $product)
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="/storage/product_images/{{ $product->imagePath }}" alt="..." class="img-responsive">
                <div class="caption">
                    <h3>{{ $product->name }}</h3>
                    <p class="description">{{ $product->description }}</p>
                    <div class="clearfix">
                        <div class="pull-left price">{{ $product->price }}</div>

                        <form action="{{ route('cart.store') }}" method="POST">

                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button type="submit" class="btn btn-success pull-right">Add to Cart</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
            @endforeach
        </div>
@endforeach
    
@endsection