@extends('layouts.basic')

@section('content')
    <!-- 게시글 내용 수정 Form -->
    <div class="container">
            <h1>게시글 수정폼</h1>
        <div class="jumbotron">
            <form id="store" method="post" action="{{ action('BoardController@update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $contents->id }}">
                <div class="form-group">
                    <h5>Title</h5>
                    <input type="text" name="content_title" class="form-control" value="{{ $contents->content_title }}">
                    <small class="form-text text-muted">update your title please.</small>
                </div>
                <div class="form-group">
                    <h5>Information</h5>
                    <textarea name="content">{!! $contents->content !!}</textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('content',{
                            'filebrowserUploadUrl' : "{{URL::to('/')}}/ckeditor/upload.php"
                            });
                    </script>
                </div>
                <div class="form-group">
                    <h5>Executing Date : </h5>
                    <input id="execute_date" name="execute_date" type="date" value="{{ $contents->execute_date}}"/>
                    <input type="hidden" id="current_date" value="{{ Carbon\Carbon::now()->toDateString()}}">
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#execute_date").change(function(){
                                if($('#execute_date').val() < $('#current_date').val()){
                                    alert('오늘 이후의 날짜를 선택해주세요.');
                                    $('#execute_date').val($('#current_date').val());
                                }
                            });
                        });
                    </script>
                </div>
                <div class="form-group">
                    <h5>location</h5>
                    <input type="hidden" class="form-control" id="place" name="content_loc" value="{{$contents->content_loc}}">
                    <button type="button" id="google_map" onclick="open_maps()"><img src="/img/google_map.png" height="50" width="50"></button> 
                    <small class="form-text text-muted">Please update the Volunteer's location</small>
                    <input type="hidden" name="lat" id="lat" value="{{$contents->lat}}">
                    <input type="hidden" name="lng" id="lng" value="{{$contents->lng}}">
                </div>
                <div>
                    <h5>Attach File</h5>
                </div>
                <ul>
                    @forelse($contents->attachments as $attach)
                    <li>
                        <a href="{{'/files/' . Auth::user()->id . '/' . $attach->filename}}">
                            {{$attach->filename}} 
                        </a>          
                        <input type="checkbox" class="glyphicon glyphicon-trash" value="{{$attach->id}}" name="del_attachments[]"> Delete
                    </li>
                    @empty <li>no attached file</li>
                    @endforelse
                </ul>
            </form>
            <form action="{{ route('attachments.store') }}" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                @csrf
            </form>
            <br>
            <div style="float:right;">
                <button type="button" class="btn btn-primary" onclick="$('#store').submit()">수정하기</button>&nbsp;
                <button type="button" onclick="location.href='{{url()->previous()}}'" class="btn btn-danger" style="float:right;">Back</button>
            </div>
        </div>
    </div>
    @include('form.dropzone')
@endSection