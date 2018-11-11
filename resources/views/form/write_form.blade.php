@extends('layouts.basic')

@section('script')
    <script src="{{URL::to('/')}}/ckeditor/ckeditor.js"></script>
    <script>
        function open_maps(){
            window.open("google_map", "", "width=700, height=500");
        }
    </script>
@endSection

@section('content')
    <div class="container">
        <div class="jumbotron">
            <form action="{{ action('BoardController@store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="content_title" placeholder="enter the volenteer's title">
                    <small class="form-text text-muted">Please enter the Volunteer's title</small>
                </div>
                <div class="form-group">
                    <label for="loc">location</label>
                    <input type="text" class="form-control" id="place" name="content_loc" placeholder="enter the volenteer's location">
                    <button type="button" onclick="open_maps()">search</button> 
                    <small class="form-text text-muted">Please enter the Volunteer's location</small>
                    <input type="hidden" name="lat" value="" id="lat">
                    <input type="hidden" name="lng" value="" id="lng">
                </div>
                <div class="form-group">
                    <label for="Executing">Executing Date : </label>
                    <input id="execute_date" name="execute_date" type="date" value="2018-01-01"/>
                </div>

                <div class="form-group">
                    <label for="context">Information</label>
                    <textarea name="content"></textarea>
                    <script type="text/javascript">
                             CKEDITOR.replace('content',{
                                 'filebrowserUploadUrl' : "{{URL::to('/')}}/ckeditor/upload.php"
                                 });
                        </script>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="button" class="btn btn-success" onclick="location.href='{{url('board')}}'" value="목록보기">
            </form>
        </div>
    </div>
@endSection