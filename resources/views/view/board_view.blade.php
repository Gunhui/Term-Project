@extends('layouts.master_view')

@section('content')
    <div class="container">
        <h1>상세보기</h1>
        <div class="jumbotron">
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
                    <td><?= $content->content ?></td>
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
            @if(Auth::check())
                @if($content->writer != Auth::user()['name'])
                    <input type="button" class="btn btn-light" style="float:right;" value="Apply" onclick="location.href='{{ URL::to('Apply/'.$content->id) }}'">
                @endif
            @endif
        </div>
        <div id="foot">
            <input type="button" class="btn btn-primary" onclick="location.href='/board/board'"  value="목록보기">
            <input type="button" class="btn btn-success" onclick="location.href='{{ URL::to('modify_form/'.$content->id) }}'" value="수정">
            <input type="button" class="btn btn-danger" onclick="location.href='{{ URL::to('board_destroy/'.$content->id) }}'" value="삭제">
        </div>
        @endforeach
    </div>
@endSection