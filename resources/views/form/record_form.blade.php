@extends('layouts.basic')

@section('content')
    <!-- 게시글 글쓰기 폼 -->
    <div class="container jumbotron">
            <h2>새 글쓰기 폼</h2>
            <p>아래의 모든 필드를 채워주세요. </p>
            <form action="{{action('NoticesController@store')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="writer" value="{{ $user }}">
                <div class="form-group">
                    <label for="title">제목: </label>
                    <input type="text" class="form-control" id="title" name="content_title" required>
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
                <button type="submit" class="btn btn-success">글등록</button>
                <a class="btn btn-primary" href="/board/board">목록보기</a>
            </form>
        </div>
@endSection 