@extends('layouts.basic')

@section('content')
    <div class="container">
        <h2>게시판 작성 폼</h2>
        <div class="jumbotron">
            <form id="store" action="{{ action('BoardController@store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="form-group">
                    <h5>Title</h5>
                    <input type="text" class="form-control" name="content_title" placeholder="enter the volenteer's title">
                    <small class="form-text text-muted">Please enter the Volunteer's title</small>
                </div>
                <div class="form-group">
                    <h5 for="loc">location</h5>
                    <input type="hidden" class="form-control" id="place" name="content_loc" placeholder="enter the volenteer's location">
                    <button type="button" id="google_map" onclick="open_maps()"><img src="/img/google_map.png" height="50" width="50"></button> 
                    <small class="form-text text-muted">Please enter the Volunteer's location</small>
                    <input type="hidden" name="lat" value="" id="lat">
                    <input type="hidden" name="lng" value="" id="lng">
                </div>
                <div class="form-group">
                    <h5 for="Executing">Executing Date : </h5>
                    <input id="execute_date" name="execute_date" type="date" value="{{ Carbon\Carbon::now()->toDateString()}}"/>
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
                    <h5 for="context">Information</h5>
                    <textarea name="content"></textarea>
                    <script type="text/javascript">
                             CKEDITOR.replace('content',{
                                 'filebrowserUploadUrl' : "{{URL::to('/')}}/ckeditor/upload.php"
                                 });
                        </script>
                </div>
            </form>
            <br>
            <div style="text-align:center">
                <h5>Attach files</h5>
            </div>
            <form action="{{ route('attachments.store') }}" class="dropzone col-md-10 offset-md-1" id="dropzone" method="post" enctype="multipart/form-data">
                @csrf
            </form>
        </div>
        <div style="float:right">
            <button type="button" class="btn btn-primary" onclick="$('#store').submit()">Submit</button>&nbsp;
            <input type="button" class="btn btn-success" onclick="location.href='{{url('board')}}'" value="목록보기">
        </div>
    </div>
@include('form.dropzone')
@endSection