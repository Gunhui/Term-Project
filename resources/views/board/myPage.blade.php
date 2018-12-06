@extends('layouts.master')

@section('style')
  <style>
    .row{
      height:1200px;
    }
    .starR{
        background: url('http://miuu227.godohosting.com/images/icon/ico_review.png') no-repeat right 0;
        background-size: auto 100%;
        width: 30px;
        height: 30px;
        display: inline-block;
        text-indent: -9999px;
        cursor: pointer;
    }
    .starR.on{
        background-position:0 0;
    }
  </style>
@endSection

@section('content')
    <div class="col-lg-9">
            @if($master == 1)
                <br><br><br><br><br><br><br><br>
                <h1><b>모든 회원정보 보기</b></h1>
                <br><hr><br>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>user_email</th>
                            <th>user_name</th>
                            <th>address</th>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tbody>
                        <tr> 
                            <td>{{$user->email}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->addr}}</td>
                        </tr>   
                        </tbody>
                    @endforeach        
                </table>
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
            @else
                <br><br><br>
                <h1><b>내가 올린 봉사 모집글</b></h1>
                <br>
                <div style="float:right; margin-bottom:5px;">
                    <img src="{{URL::to('/')}}/img/blue.png" height="15" width="50"> :
                    봉사자 평가 가능
                </div>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>content_title</th>
                                <th>content_loc</th>
                                <th>execute_date</th>
                                <th>hits</th>
                            </tr>
                        </thead>
                    <?php $counting = 0; ?>
                    @foreach($contents as $content)
                    <?php $confirm = DB::table('board_applies')->where('applied_id', $content->id)->value('id'); ?> 
                        @if($content->execute_date < Carbon\Carbon::now() && $confirm)
                            @if($content->give_point == 0)
                                <tbody data-toggle="modal" data-target="#{{$content->id}}" class="list-group-item-info">
                            @endif
                            <tr>
                                <td>
                                    {{ $content->content_title }}
                                </td>
                                <!-- modal -->
                                <div id="{{$content->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h4 class="modal-title"><b>"{{ $content->content_title }}"</b>의 봉사 결과</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <?php
                                                    if($confirm) {
                                                        $did_list = DB::table('board_applies')->where('applied_id', $content->id)->get();
                                                    }
                                                ?>
                                                <form action="{{ action('Mypages_pageController@store') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                    @if($confirm)
                                                    <?php $counting2 = 0; ?>
                                                        @foreach($did_list as $list)
                                                            <ul>
                                                                <li>
                                                                    {{ $list->user_id }}
                                                                    <div class="starRev{{$counting2}}">
                                                                        <span id="1" class="starR on">별1</span>
                                                                        <span id="2" class="starR">별2</span>
                                                                        <span id="3" class="starR">별3</span>
                                                                        <span id="4" class="starR">별4</span>
                                                                        <span id="5" class="starR">별5</span>
                                                                    </div>
                                                                    <input type="hidden" name="name[{{ $counting2 }}]" value="{{ $list->user_id }}">
                                                                    <input type="hidden" name="val[{{$counting2}}]" id="text{{$counting2}}">   
                                                                    <input type="hidden" name="boards[{{$counting2}}]" value="{{$list->applied_id}}">            
                                                                    <script>
                                                                        $('.starRev{{$counting2}} span').click(function(){                                                                            
                                                                            $(this).parent().children('span').removeClass('on');
                                                                            $(this).addClass('on').prevAll('span').addClass('on');
                                                                            var score = $(this).attr('id');
                                                                            var test = document.getElementById('text{{$counting2}}');
                                                                            test.value = score;
                                                                            return false;                                                                        
                                                                        });
                                                                    </script>                                        
                                                                </li><br>
                                                            </ul>
                                                            <?php $counting2++; ?>
                                                        @endforeach
                                                    @endif
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" onclick="getScore">별점주기</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                            @else
                                <td>{{ $content->content_title }}</td>
                            @endif
                            <td>{{ $content->content_loc }}</td>
                            <td>{{ $content->execute_date }}</td>
                            <td>{{ $content->hits }}</td>
                        </tr>   
                        </tbody>
                        <?php $counting++; ?>
                    @endforeach      
                    </table>
                    <br><br><hr><br><br>
                    <h1><b>내가 쓴 공지글 목록</b></h1>
                    <br><br>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>content_title</th>
                                <th>regtime</th>
                                <th>hits</th>
        
                            </tr>
                        </thead>
                    @if($notices != "empty")
                        @foreach($notices as $notice)
                            <tbody>
                            <tr>
                                <td>{{ $notice->content_title }}</td>
                                <td>{{ $notice->created_at }}</td>
                                <td>{{ $notice->hits }}</td>
                            </tr>   
                            </tbody>   
                        @endforeach
                    @endif
                    </table>

                    <br><br><hr><br>
                    <h1><b>내가 신청한 봉사 목록</b></h1>
                    <br><br>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>content_title</th>
                                <th>content_loc</th>
                                <th>writer</th>
                                <th>hits</th>
        
                            </tr>
                        </thead>
                    @foreach($lists as $list)
                        <tbody>
                        <tr>
                            <td>{{ $list->content_title }}</td>
                            <td>{{ $list->content_loc }}</td>
                            <td>{{ $list->writer }}</td>
                            <td>{{ $list->hits }}</td>
                        </tr>   
                        </tbody>   
                    @endforeach
                    </table>
                    @endif
                
{{-- <script>
    function getScore(){
        var tags = [];
        var score = 0;
        for(var i = 0; i<4; i++){
            tags[i] = document.getElementById(i);
            if(tags[i].className=="starR on"){
                score++;
            }
        }
        alert(score);
    }
</script> --}}
               
@endSection