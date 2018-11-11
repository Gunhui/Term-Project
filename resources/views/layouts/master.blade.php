<!DOCTYPE html>
<html lang="en">
  <head>
    <title>With Volunteer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php use Illuminate\Support\Facades\Auth; ?>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::to('/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @yield('script')
    @yield('style')
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse">
        <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="{{URL::to('/')}}">Gunny</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <div class="navbar-brand">
              @if(Auth::check())
                @if($master == 1)
                  <label>{{Auth::user()['name']}}(관리자)</label>
                @else
                  <label>{{Auth::user()['name']}}님 환영합니다 !</label>
                @endif
                <form action="{{ route('logout') }}" method="post" class="nav navbar-nav navbar-right" style="margin-left: 10px; margin-top:-7px;">
                  @csrf
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-lock"></span>Logout</button>
                </form>
              </div>
              @else
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" style="margin-left: 10px; margin-top:-7px;"><span class="glyphicon glyphicon-lock"></span>Login</button>
              @endif
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">  
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style="color:#000">LOGIN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label" style="color:#000">ID:</label>
                      <input type="text" class="form-control" name="email" id="recipie  nt-name">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label" style="color:#000">Password:</label>
                      <input type="password" class="form-control" name="password" id="message-text">
                    </div>
                </div>
                <div class="modal-footer">
                  <a style="margin-right:270px;" class="login" href="{{ url('/redirect') }}"><img src="{{URL::to('/')}}/img/google.png" height="30px" weight="60px"></a>
                  <button type="submit" class="btn btn-primary">Login</button>
                @if (Route::has('register'))
                  <button type="button" class="btn btn-success" onclick="location.href='{{ route('register') }}'" style="margin-left: 10px;">{{ __('Register') }}</button>  
                @endif
                </div>
                </form>
              </div>
            </div>
          </div>  
          
            </ul>
            </div>
        </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                  <h1 class="my-4">ボランティア</h1>
                  <div class="list-group">
                    <a href="{{ route('board.home') }}" class="list-group-item">Home</a>
                    <a href="{{ route('board.board') }}" class="list-group-item">Bolletin Board</a>
                    <a href="{{ route('board.notices') }}" class="list-group-item">Notices</a>
                    <a href="{{ route('board.mypage') }}" class="list-group-item">MyPage</a>
                  </div>
              </div>
              @yield('content')
            <!-- /.row -->
          </div>
          <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
      <footer class="py-5 bg-dark">
        <div class="container"> 
          <p class="m-0 text-center text-white">영진전문대학 &copy; 2WDJ 1501187 윤건희</p>
        </div>
        <!-- /.container -->
      </footer>
      <!-- Bootstrap core JavaScript -->
      <script src="{{URL::to('/')}}/vendor/jquery/jquery.min.js"></script>
      <script src="{{URL::to('/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>