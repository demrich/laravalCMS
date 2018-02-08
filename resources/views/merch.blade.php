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
@foreach($products->chunk(3) as $productChunk)

<div class="row">
    @foreach($productChunk as $product)
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="{{ $product->imagePath }}" alt="..." class="img-responsive">
                <div class="caption">
                    <h3>{{ $product->title }}</h3>
                    <p class="description">{{ $product->description }}</p>
                    <div class="clearfix">
                        <div class="pull-left price">${{ $product->price }}</div>
                        <a href="#" class="btn btn-success pull-right" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
            @endforeach
        </div>
@endforeach
    
@endsection