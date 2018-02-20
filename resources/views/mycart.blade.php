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
        @if(Cart::count() > 0)
       <h2> You have {{ Cart::count() }} Items!</h2>

       <?php foreach(Cart::content() as $row) :?>

       		<tr>
           		<td>
               		<p><strong><?php echo $row->name; ?></strong></p>
           		</td>
           		<td><input type="text" value="<?php echo $row->qty; ?>"></td>
           		<td>$<?php echo $row->price; ?></td>
       		</tr>

           <?php endforeach;?><br>

           {{ Cart::tax() }}<br>
           {{ Cart::subTotal() }}<br>
           {{ Cart::total() }}
           
           

       
        @else
     <h2>   You have 0 items!<br> Add some! </h2>
        @endif   

@endsection