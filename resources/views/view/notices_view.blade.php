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
                    <td>{!! $content->content !!}</td>
                </tr>
            </table>
        </div>
        <div id="foot">
            <input type="button" class="btn btn-primary" onclick="location.href='{{ url('board/notices') }}'" value="목록보기">
            @if(Auth::user()['master'] == 1 || Auth::user()['name'] == $content->writer)
                <input type="button" class="btn btn-success" onclick="location.href='{{ URL::to('Notices_modify_form/'.$content->id) }}'" value="수정">
                <input type="button" class="btn btn-danger" onclick="location.href='{{ URL::to('notices_destroy/'.$content->id) }}'" value="삭제">
            @endif
        </div>
        @endforeach
    </div>
@endSection