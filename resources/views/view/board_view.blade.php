@extends('layouts.master_view')

@section('content')
   
    <div class="container">
        <h1>상세보기</h1>
        <div class="jumbotron" style="padding-bottom:10px;">
            <table class="table">
                <tr>
                    <th><b>Title</b></th>
                    <td>{{ $content['content_title'] }}</td>
                </tr>
                <tr>
                    <th><b>작성자</b></th>

                    <td>{{ $content['writer'] }}</td>
                </tr>
                <tr>
                    <th><b>봉사일자</b></th>
                    <td>{{ $content['execute_date'] }}</td>
                </tr>
                <tr>
                    <th><b>조회수</b></th>
                    <td>{{ $content['hits'] }}</td>
                </tr>
                <tr>
                    <th><b>내용</b></th>
                    <td>{!! $content['content'] !!}</td>
                </tr>
                <tr>
                    <th><b>장소</b></th>
                    <td>
                        <div id="map"></div>
                            <script>
                                var marker;
                            
                                function initMap() {
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 15,
                                    center: {lat: <?= $content['lat'] ?>, lng: <?= $content['lng'] ?>}
                                    });
                            
                                    marker = new google.maps.Marker({
                                    map: map,
                                    draggable: true,
                                    animation: google.maps.Animation.DROP,
                                    position: {lat: <?= $content['lat'] ?>, lng: <?= $content['lng'] ?>}
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
                <tr>
                    <th><b>첨부파일</b></th>
                    <td>
                        <ul>
                            @forelse($content->attachments as $attach)
                                <li>
                                    <a href="{{'/files/' . Auth::user()->id . '/' . $attach->filename}}">
                                    {{$attach->filename}}
                                    </a>
                                </li>
                            @empty <li>첨부파일 없음</li>	
                            @endforelse	
                        </ul>
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
                @if(Auth::user()['master'] == 1 || $content->writer == Auth::user()['name'])
                    <input type="button" class="btn btn-success" onclick="location.href='{{ URL::to('modify_form/'.$content->id) }}'" value="수정">
                    <input type="button" class="btn btn-danger" onclick="location.href='{{ URL::to('board_destroy/'.$content->id) }}'" value="삭제">
                @endif
            @endif
        </div>
        
    </div>
@endSection