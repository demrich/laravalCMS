@extends('layouts.master')

@section('title')
Did you click?
@endsection

@section('content')


<div class="text-center">
<img src="{{ URL::to('img/eye.gif') }}" width="100">
</div>
<div class="row">
        @if(count($errors) > 0)
        <div class="col-md-4 col-md-offset-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
<br><br>

<div class="row">
    <div class="col-md-6">
        <h3>Sign Up</h3>
        <form action="{{ route('signup') }}" method="post">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                <label for="email">Your E-Mail</label>
                <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
            </div>
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                <label for="first_name">Your Username</label>
                <input class="form-control" type="text" name="first_name" id="first_name" value="{{ Request::old('first_name') }}">
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password">
            </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"><!--Every Form Needs This -->
        </form>
    </div>
    <div class="col-md-6">
        <h3>Sign In</h2>
        <form action="{{ route('signin') }}" method="post">
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                <label for="first_name">Your Username</label>
                <input class="form-control" type="text" name="first_name" id="first_name">
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password">
            </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"> <!--Every Form Needs This -->
        </form>
    </div>
</div>



<br>
clicked.
<br>
<br>
Good Work. And I see you've also added a function sign up form as well. Excellent.
<h2>And you're secure.</h2><br>Lets continue <a href="https://www.youtube.com/watch?v=PkiHgAmYLec&list=PL55RiY5tL51oloSGk5XdO2MGjPqc0BxGV&index=7" target="_blank">onward.</a><br><br>
@endsection

