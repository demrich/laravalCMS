@extends('layouts.master')

@section('title')
Cart
@endsection

@section('content')
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


<div class="container">
@if(Cart::count() > 0)
       <h2> You have {{ Cart::instance('shopping')->count() }} Items</h2>
	<div class="row">
		<div class="col-xs-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-xs-6">
								<h5><span class="glyphicon glyphicon-shopping-cart"></span> Cart</h5>
							</div>
							<div class="col-xs-6">
						 	<a href="{{ route('merch') }}" class="btn btn-primary btn-sm btn-block">
									<span class="glyphicon glyphicon-share-alt"></span> Continue Shopping
						    </a>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
                 @foreach(Cart::instance('shopping')->content() as $row)
					<div class="row">
						<div class="col-xs-2"><img class="img-responsive" src="/storage/product_images/{{ $row->model->imagePath }}">
						</div>
						<div class="col-xs-4">
							<h4 class="product-name"><strong>{{ $row->name }}</strong></h4>
                            <h4><small>{{ $row->model->description }}</small></h4>
                        </div>
						<div class="col-xs-6">
							<div class="col-xs-6 text-right">
								<h6><span class="text-muted">$</span><strong>{{ $row->price }} </strong></h6>
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control input-sm" value="{{ $row->qty }}">
							</div> 
							<div class="col-xs-2">

								<form action="{{ route('cart.remove', $row->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit"><i class="fa fa-trash"></i></button>
                                </form>
								<form action="{{ route('cart.wishList', $row->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit"><i class="fa fa-heart"></i></button>
                                </form>
                                
							</div>
						</div>
					</div>
                    <hr>
        			@endforeach

    @else
     <h2>You have 0 items in your cart.</h2>
            
            @endif

				</div>
				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-9">
							<h4 class="text-right">Total <strong><br>
         {{ presentPrice(Cart::total()) }}</strong></h4>
						</div>

						<div class="col-xs-3">
							<button type="button" class="btn btn-success btn-block">
								Checkout!
							</button>
						</div>
					</div>
				</div>

			@if(Cart::instance('wishList')->count() > 0)
			<h3> You have {{ Cart::instance('wishList')->count() }} items in your wishlist</h3>
			@else 
			<h3>You have no items in your wishlist</h3>
			@endif
			<div class="row">
			@foreach(Cart::instance('wishList')->content() as $heart)
			<div class="col-md-4">
				<div class="wishlist">
				<img class="img-responsive"src='/storage/product_images/{{ $heart->model->imagePath }}' alt=''/><br>
				<p>{{ $heart->name }}</p><span>{{ presentPrice($heart->price) }}</span>
				</div>
				
			<div style="position:relative;display:block;float:right">
			 <form action="{{ route('cart.store') }}" method="POST">

                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $heart->id }}">
                            <input type="hidden" name="name" value="{{ $heart->name }}">
                            <input type="hidden" name="price" value="{{ $heart->price }}">
                            <button type="submit"><i class="fa fa-shopping-cart"></i></button>
            </form>
						<form action="{{ route('wishList.remove', $heart->rowId) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit"><i class="fa fa-trash"></i></button>
						</form>
						
					</div>
			</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endsection