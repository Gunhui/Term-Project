@extends('layouts.master')

@section('style')
  <style>
    #map {
      height: 170px;
      weight: 70px;
    }
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
@endSection

@section('content')
  <div class="col-lg-9">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
            <img class="d-block img-fluid" src="{{URL::to('/')}}/img/volunteer.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{URL::to('/')}}/img/volunteer1.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{URL::to('/')}}/img/volunteer2.gif" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <br>
            <form action="{{action('Board_pageController@distance')}}" method="get">
                @csrf
                <p id="demo" name="demo"></p>
                <input type="hidden" id="lat" name="lat">
                <input type="hidden" id="lng" name="lng">
              
                <script>
                  var x = document.getElementById('demo');
                  var lat = document.getElementById('lat');
                  var lng = document.getElementById('lng');
  
                  $(document).ready(function getlocation(){
                    if(navigator.geolocation){
                      navigator.geolocation.getCurrentPosition(showPosition);
                    }else{
                      x.innerHTML = "Geolocation is not supported by this browser.";
                    }
                  });
  
                  function showPosition(position){
                    lat.value = position.coords.latitude;
                    lng.value = position.coords.longitude;
                  }
                </script>
                  <select name="list" onchange="this.form.submit()">
                    @if($check == 1)
                      <option value="1" selected>등록순</option>
                      <option value="2">거리</option>
                    @else
                      <option value="1">등록순</option>
                      <option value="2" selected>거리</option>
                    @endif 
                    {{-- <noscript><input type="submit" value="Submit"></noscript> --}}
                  </select>
              </form>
          <div class="row">
          <?php $checking = 0; ?>
          <?php $count = 0; ?>
            @foreach($boards as $board)
            @if($board->execute_date >= Carbon\Carbon::now())   
            <div class="col-lg-4 col-md-6 mb-4" onclick="location.href='{{ URL::to('board_view/'.$board->id) }}'"> 
            @else
            <div class="col-lg-4 col-md-6 mb-4"> 
            @endif
              <div class="card h-100">   
                <div id="{{$checking}}" style="height:170px; weight=50px;"></div>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a> </a>
                      </h4>
                      <h5><b>봉사 모집자</b> : {{$board->writer}}</h5>
                      <br>
                      <h5><b>위치</b> : {{$board->content_loc}}</h5>
                    </div>
                  <div class="card-footer" style="color:red;">
                  @if($board->execute_date < Carbon\Carbon::now())
                    <small style="float:left;">모집 마감</small>
                  @endif
                    <small class="text-muted" style="float:right;">조횟수 : <b><?= $board->hits ?></b></small>
                  </div>
              </div>              
            </div>
            <?php $count++; ?>
            <?php $checking++; ?>
              @endforeach

              <script>
                  var marker;
                <?php $count1 =0; ?>
                <?php $checking1 =0; ?>
                <?php $marker = 0; ?>

                  function initMap() {
                    <?php foreach($boards as $board) : ?>
                    <?php $lat = $board->lat; ?>
                    <?php $lng = $board->lng; ?>
                    <?= "map".$count1 ?> = new google.maps.Map(document.getElementById('{{$checking1}}'), {
                      zoom: 18,
                      center: {lat: <?= $lat ?>, lng: <?= $lng ?>}
                    });
                    <?= "marker".$count1 ?> = new google.maps.Marker({
                      position: {lat: <?= $lat ?>, lng: <?= $lng ?>},
                      map: <?= "map".$count1 ?>
                    });
                    
                  <?php $count1++; ?>
                  <?php $checking1++; ?>
                  <?php endforeach ?>
                  google.maps.event.addDomListener(window, "load", initMap);
                  }
                </script>
                <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClOu8jkJLSWyNI2jXy3l1Gza3rjyvO59w&callback=initMap" type="text/javascript"> </script>
              <br>
          <div style="display: flex; justify-content: center; width: 100%;">
            {{ $boards->links() }}
          </div>
          <!-- search bar -->
          <div class="container">
          <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div id="imaginary_container">
                    <form action="{{ action('Board_pageController@search') }}" method="post"> 
                    @csrf
                    <div class="input-group stylish-input-group" style="display: flex;">
                      <select name="menu" style="border-radius:5px;"> 
                        <option value="content_title">제목</option>
                        <option value="content">내용</option>
                        <option value="writer">글쓴이</option>
                      </select>
                      <input type="text" class="form-control" name="search_content" style="flex: 1;" placeholder="Enter any keyword">
                      <div class="input-group-addon" style="width: 60px">
                        <button type="submit">
                          <span class="glyphicon glyphicon-search"></span>
                        </button>  
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>

        </div>
        <br>
        @if(Auth::check()) 
          <a href="{{url('board_write')}}" class="btn btn-primary">Write</a>
        @endif 
        </div>
        <!-- /.row -->
      </div>
      <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
  </div>
@endSection



