@extends('layouts.master')

@section('style')
  <style>
    .row{
      height:950px;
    }
    #table1{
      height:380px;
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
        <h1><b>공지사항</b></h1>
        <br>
        <div id="table1">
        <table class="table table-hover">
          <thead class="thead-dark">
              <tr>
                  <th>Writer</th>
                  <th>Title</th>
                  <th>Regtime</th>
                  <th>Hits</th>
              </tr>
              </thead>
              @foreach($notices as $notice)
                @if($notice->master == 1)
                  <tbody class="list-group-item-info" onclick="location.href='{{ URL::to('notices_view/'.$notice->id) }}'">
                    <tr>
                        <td><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;<b>운영자</b></td>
                        <td><b>{{$notice->content_title}}</b></td>
                        <td><b>{{$notice->created_at}}</b></td>
                        <td><b>{{$notice->hits}}</b></td>
                    </tr>   
                  </tbody>
                @else  
                  <tbody onclick="location.href='{{ URL::to('notices_view/'.$notice->id) }}'">
                    <tr>
                      <td>{{$notice->writer}}</td>
                      <td>{{$notice->content_title}}</td>
                      <td>{{$notice->created_at}}</td>
                      <td>{{$notice->hits}}</td>
                    </tr>   
                  </tbody>
                @endif
              @endforeach
            </table>
          </div>
          <div style="display: flex; justify-content: center; width: 100%;">
            {{ $notices->links() }}
          </div>
    
          @if(Auth::check())
            <input type="button" value="글쓰기" class="btn btn-primary" onclick="location.href='{{url('notices_write')}}'">
          @endif
@endSection