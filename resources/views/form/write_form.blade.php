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
            <form action="{{ action('BoardController@store') }}" method="POST" enctype="multipart/form-data">
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
                <div>
                    
                </div>
                <script type="text/javascript">
                    Dropzone.options.dropzone =
                     {
                        maxFilesize: 12,
                        renameFile: function(file) {
                            var dt = new Date();
                            var time = dt.getTime();
                           return time+file.name;
                        },
                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                        addRemoveLinks: true,
                        timeout: 50000,
                        removedfile: function(file) 
                        {
                            var name = file.upload.filename;
                            $.ajax({
                                headers: {
                                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                        },
                                type: 'POST',
                                url: '{{ url("image/delete") }}',
                                data: {filename: name},
                                success: function (data){
                                    console.log("File has been successfully removed!!");
                                },
                                error: function(e) {
                                    console.log(e);
                                }});
                                var fileRef;
                                return (fileRef = file.previewElement) != null ? 
                                fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        },
                   
                        success: function(file, response) 
                        {
                            console.log(response);
                        },
                        error: function(file, response)
                        {
                           return false;
                        }
                    };
                </script>

                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="button" class="btn btn-success" onclick="location.href='{{url('board')}}'" value="목록보기">
            </form>
        </div>
    </div>
@endSection