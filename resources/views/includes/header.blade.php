<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('welcome') }}">Brain</a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ route('merch') }}">Merch</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Filters <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Gaming</a></li>
              <li><a href="#">News</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Special Blend</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Topic Salad</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">


           @if (Auth::guest())
           <li><a href="{{ route('mycart') }}" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart </a></li>
           <li><a href="{{ route('login') }}" ><i class="fa fa-power-off" aria-hidden="true"></i> Login </a></li>

           @elseif (Auth::user()->hasRole('admin'))
           <li><a href="{{ route('admin') }}"><i class="fa fa-diamond" aria-hidden="true"></i> Admin <span class="sr-only">(current)</span></a></li>
           <li><a href="{{ route('dashboard') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile <span class="sr-only">(current)</span></a></li>
           <li><a href="{{ route('mycart') }}" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart </a></li>
           <li><a href="{{ route('logout') }}" ><i class="fa fa-power-off" aria-hidden="true"></i> Logout </a></li>

           @elseif (Auth::user()->hasRole('author'))
           <li><a href="{{ route('admin') }}"><i class="fa fa-diamond" aria-hidden="true"></i> Blog <span class="sr-only">(current)</span></a></li>
           <li><a href="{{ route('dashboard') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile <span class="sr-only">(current)</span></a></li>
           <li><a href="{{ route('mycart') }}" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart </a></li>
           <li><a href="{{ route('logout') }}" ><i class="fa fa-power-off" aria-hidden="true"></i> Logout </a></li>

           @else
           <li><a href="{{ route('dashboard') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile <span class="sr-only">(current)</span></a></li>
           <li><a href="{{ route('mycart') }}" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart </a></li>
           <li><a href="{{ route('logout') }}" ><i class="fa fa-power-off" aria-hidden="true"></i> Logout </a></li>

           @endif
           
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>