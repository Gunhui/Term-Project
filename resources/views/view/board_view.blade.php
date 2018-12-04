@extends('layouts.master_view')

@section('content')
    <script type="text/javascript">
        var es = new EventSource("<?php echo action('Controller@Action'); ?>");
    
        es.onmessage = function(e) {
            console.log(e);
        }
      </script>

    <div class="container">
        <h1>상세보기</h1>
        <div class="jumbotron" style="padding-bottom:10px;">
            <table class="table">
                @foreach($contents as $content)
                <tr>
                    <th>Title</th>
                    <td>{{ $content->content_title }}</td>
                </tr>
                <tr>
                    <th>작성자</th>
                    <td>{{ $content->writer }}</td>
                </tr>
                <tr>
                    <th>작성일지</th>
                    <td>{{ $content->created_at }}</td>
                </tr>
                <tr>
                    <th>조회수</th>
                    <td>{{ $content->hits }}</td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td>{!! $content->content !!}</td>
                </tr>
                <tr>
                    <th>장소</th>
                    <td>
                        <div id="map"></div>
                            <script>
                                var marker;
                            
                                function initMap() {
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 15,
                                    center: {lat: <?= $content->lat ?>, lng: <?= $content->lng ?>}
                                    });
                            
                                    marker = new google.maps.Marker({
                                    map: map,
                                    draggable: true,
                                    animation: google.maps.Animation.DROP,
                                    position: {lat: <?= $content->lat ?>, lng: <?= $content->lng ?>}
                                    });
                                    marker.addListener('click', toggleBounce);
                                }
                            
                                function toggleBounce() {
                                    if (marker.getAnimation() !== null) {
                                    marker.setAnimation(null);
                                    } else {
                                    marker.setAnimation(google.maps.Animation.BOUNCE);
                                    }
                                }
                            </script>
                        <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClOu8jkJLSWyNI2jXy3l1Gza3rjyvO59w&callback=initMap">
                        </script>
                    </td>
                </tr>
            </table>
            <small id="apply"` style="font-size:13px;"><b>신청 현황 : {{ $count }}명</b></small>            
        </div>
        <div id="foot"style="padding-bottom:30px;">
            @if(Auth::check())
                @if($content->writer != Auth::user()['name'])
                    <input type="button" class="btn btn-light" style="position:absolute; left:400px;" value="Apply" onclick="location.href='{{ URL::to('Apply/'.$content->id) }}'">
                @endif
            @endif
            <input type="button" class="btn btn-primary" onclick="location.href='/board/board'"  value="목록보기">
            @if(Auth::check())
                @if(Auth::user()['master'] == 1 && $content->writer == Auth::user()['name'])
                    <input type="button" class="btn btn-success" onclick="location.href='{{ URL::to('modify_form/'.$content->id) }}'" value="수정">
                    <input type="button" class="btn btn-danger" onclick="location.href='{{ URL::to('board_destroy/'.$content->id) }}'" value="삭제">
                @endif
            @endif
        </div>
        @endforeach
    </div>
@endSection