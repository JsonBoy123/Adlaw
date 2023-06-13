@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Please Verify Code') }}</div>

                <div class="card-body">
                    @if($message = Session::get('warning'))
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @endif

                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    <div class="alert alert-success" style="display: none;">
                        {{$message}}
                    </div>

                    <form class="d-inline" method="POST" action="{{route('verify')}}">
                        @csrf
                    <div class="form-group row">
                        <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Verification Code') }}</label>

                        <div class="col-md-6">
                            <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code">
                            <button type="submit" class="btn btn-sm btn-primary mt-2">{{ __('Verify') }}</button>

                        </div>
                    </div>
                    
                    </form>
                </div>
                <div class="card-footer">
                    <a href="javascript:void(0)" id="resend" onclick="resendLogin()">Resend Code</a>
                    <input type="hidden" name="phone" value="{{request()->get('phone')}}">
                </div>
            </div>
        </div>
    </div>
</div>
<script>    
    function resendLogin(){
        var phone = $('input[name="phone"]').val();
        $.ajax({
            type:'GET',
            url:'{{route('resendVerifyCode')}}?phone='+phone,
            success:function(res){   
                if(res == "success"){
                    $('.alert-success').remove();
                    $('.alert-success').show().empty().html('We Sent Activation code again. Check Your mobile.');
                }else{
                    
                } 
            }
        });
    }
</script>
@endsection