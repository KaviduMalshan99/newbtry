




@extends('layouts.authentication.master')
@section('title', 'Login-one')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      {{-- <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/2.jpg')}}" alt="looginpage"></div> --}}
      <div class="col-xl-12 p-0">
         <div class="login-card">
            <div>
                {{-- @if(Session::has('error'))
            <p>{{ Session::get('error') }}</p>
                @else
                    <img class="img-fluid" 
                        src="{{ $logoPath }}" 
                        alt="Company Logo">
                @endif --}}


                
                
               <div class="login-main">
                  <form class="theme-form" action="{{ url('/login') }}" method="POST">
                    @csrf
                     <h4>Sign in to account</h4>
                     <p>Enter your email & password to login</p>
                     <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="Test@gmail.com">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required="" placeholder="*********">
                        <div class="show-hide"><span class="show">                         </span></div>
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Remember password</label>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                     </div>
                     
                     <p class="mt-4 mb-0">Don't have account?<a class="ms-2" href="{{ route('registration') }}">Create Account</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection