@extends('layouts.basic')

@section('script')
    <script src="{{URL::to('/')}}/ckeditor/ckeditor.js"></script>
@endSection

@section('content')
    <!-- 게시글 내용 수정 Form -->
    <div class="container">
        <h1>게시글 수정폼</h1>
        <div class="jumbotron">
            <form method="post" action="{{ action('NoticesController@update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $contents->id }}">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="content_title" class="form-control" value="{{ $contents->content_title }}">
                    <small class="form-text text-muted">update your title please.</small>
                </div>
                <div class="form-group">
                    <label for="context">Information</label>
                    <textarea name="content"><?= $contents->content ?></textarea>
                    <script type="text/javascript">
                            CKEDITOR.replace('content',{
                                'filebrowserUploadUrl' : "{{URL::to('/')}}/ckeditor/upload.php"
                                });
                        </script>
                </div>
                <button type="submit" class="btn btn-primary">수정하기</button>
                <button type="button" onclick="location.href='{{url()->previous()}}'" class="btn btn-danger" style="float:right;">Back</button>
            </form>
        </div>
    </div>
@endSection