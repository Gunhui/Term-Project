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
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
        
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-notifications.min.css">
    @yield('script')
    @yield('style')
    <style>
     
      .dropdown-toggle::after{
        display:none;
      }
      .nav .open>a, .nav .open>a:focus, .nav .open>a:hover{
        background-color: transparent;
      }
    </style>
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
              <div class="navbar-brand" style="display: flex;">
              @if(Auth::check())
                @if($master == 1)
                  <label id="id">{{Auth::user()['name']}}님</label>
                @else
                  <label id="id">{{Auth::user()['name']}}님</label>
                @endif
                &nbsp;
              
                <li class="dropdown dropdown-notifications">
                    <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration:none; padding-top:15px; padding-bottom:15px;">
                      <i data-count="0" class="glyphicon glyphicon-bell notification-icon" style="color:white;"></i>
                    </a>
      
                    <div class="dropdown-container">
                      <div class="dropdown-toolbar">
                        <div class="dropdown-toolbar-actions">
                          <a href="#">Mark all as read</a>
                        </div>
                        <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
                      </div>
                      <ul class="dropdown-menu">
                      </ul>
                      <div class="dropdown-footer text-center">
                        <a href="#">View All</a>
                      </div>
                    </div>
                  </li>
                <form action="{{ route('logout') }}" method="post" class="nav navbar-nav navbar-right" style="margin-left: 10px; margin-top:-7px; height:40px;">
                  @csrf
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-lock"></span>Logout</button>
                </form>
              </li>
              </div>
              @else
                <button type="button" style="height:40px; margin-left: 10px; margin-top:-7px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" style="margin-left: 10px; margin-top:-7px;"><span class="glyphicon glyphicon-lock"></span>Login</button>
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

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//js.pusher.com/3.1/pusher.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
        <script type="text/javascript">
          var notificationsWrapper   = $('.dropdown-notifications');
          var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
          var notificationsCountElem = notificationsToggle.find('i[data-count]');
          var notificationsCount     = parseInt(notificationsCountElem.data('count'));
          var notifications          = notificationsWrapper.find('ul.dropdown-menu');
          if (notificationsCount <= 0) {
            notificationsWrapper.hide();
          }
          // Enable pusher logging - don't include this in production
          // Pusher.logToConsole = true;
          var pusher = new Pusher('9228cfeec815f0e38b8c', {
            cluster:'ap1',
            encrypted: true
          });
          // Subscribe to the channel we specified in our Laravel Event
          var channel = pusher.subscribe('status-liked');
          // Bind a function to a Event (the full Laravel class)
          channel.bind('App\\Events\\StatusLiked', function(data) {
            var id = document.getElementById('id').innerHTML;
            if(data.who_send != id){
              return false;
            }
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `
              <li class="notification active">
                  <div class="media">
                    <div class="media-left">
                      <div class="media-object">
                        <img src="{{URL::to('/')}}/uploads/guest.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                      </div>
                    </div>
                    <div class="media-body">
                      <strong class="notification-title">`+data.message+`</strong>
                      <!--p class="notification-desc">Extra description can go here</p-->
                      <div class="notification-meta">
                        <small class="timestamp">`+data.title+`을 신청하셨습니다.</small>
                      </div>
                    </div>
                  </div>
              </li>
            `;
            notifications.html(newNotificationHtml + existingNotifications);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
          });
        </script>

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
      {{-- <script src="{{URL::to('/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
  </body>
</html>