@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                <span id="name_check" style="color:blue;">사용가능합니다.</span>
                                <script>
                                    $(document).ready(checking);
                                    function checking(){
                                        $("#name").keyup(function(){
                                            $.ajax({
                                                method:'POST',
                                                url:'/name_check',
                                                data:{'name' : $('#name').val(),
                                                        _token : '{!! csrf_token() !!}',
                                                    },
                                                success:function(response){
                                                    console.log(response);
                                                    if(response == "name"){
                                                        $('#name_check').html('사용 불가능합니다.');
                                                        $('#name_check').css('color', 'red');
                                                    }else{
                                                        $('#name_check').html('사용 가능합니다.');
                                                        $('#name_check').css('color', 'blue');
                                                    }      
                                                },
                                                error: function(jqXHR, textStatus, errorThrown){
                                                        console.log(JSON.stringify(jqXHR));
                                                        console.log("AJAX error: " + textStatus + " : " + errorThrown);
                                                    }
                                            });
                                        });
                                    }
                                </script>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <input type="hidden" id="confirm">
                                <script>
                                    var code = $('#confirm').val();
                                    $(document).ready(pressed);
                                    function pressed(){
                                        $("#confirm").keyup(function(){
                                            $.ajax({
                                                method:'POST',
                                                url:'/check',
                                                data:{'code' : $('#confirm').val(),
                                                    'confirmCode' : $('#confirm1').val(),
                                                        _token : '{!! csrf_token() !!}',
                                                    },
                                                success:function(response){
                                                    console.log(response);
                                                    if(response == "ok"){
                                                        $('#btn').css('display','');
                                                    }
                                                },
                                                error: function(jqXHR, textStatus, errorThrown){
                                                        console.log(JSON.stringify(jqXHR));
                                                        console.log("AJAX error: " + textStatus + " : " + errorThrown);
                                                    }
                                            });
                                        });
                                    }
                                </script>
                                <button type="button" onclick="send_email()" class="btn btn-success">인증하기</button>
                                <input type="hidden" value="" id="confirm1">
                                <script>
                                    function send_email(){
                                        var send = $('#email').val();
                                        $.ajax({  
                                           method:'POST',
                                           url:'/email',
                                           data : {'mail' : send,
                                                    _token : '{!! csrf_token() !!}',    
                                                },
                                           success: function(response){
                                               $('#confirm1').val(response);
                                               console.log(response);
                                               $('#confirm').attr('type', 'text');        
                                           },
                                           error: function(jqXHR, textStatus, errorThrown){
                                               console.log(JSON.stringify(jqXHR));
                                               console.log("AJAX error: " + textStatus + " : " + errorThrown);
                                           }
                                        });
                                    }
                                </script>    
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="addr" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
    
                            <div class="col-md-6">
                                <input id="addr" type="text" class="form-control{{ $errors->has('addr') ? ' is-invalid' : '' }}" name="addr" value="{{ old('addr') }}" required>
    
                                @if ($errors->has('addr'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr') }}</strong>
                                     </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btn" type="submit" class="btn btn-primary" style="display:none;">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div>
                <button type="button" onclick="location.href='{{url()->previous()}}'" class="btn btn-danger" style="float:right;">Back</button>
            </div>
        </div>
    </div>
</div>
@endsection
