@extends('layouts.authentication.master')
@section('title', 'Sign-up-one')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/3.jpg')}}" alt="looginpage"></div>
      <div class="col-xl-7 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo" href="{{ route('index') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  
                <form action="{{ route('register.submit') }}" method="POST" class="theme-form">
                    @csrf
                    <h4>Create your account</h4>
                    <p>Enter your personal details to create account</p>
                
                    <!-- Name Field -->
                    <div class="form-group">
                        <label class="col-form-label pt-0">Your Name</label>
                        <input class="form-control" type="text" id="name" name="name" required placeholder="Your Name">
                    </div>
                
                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" id="email" name="email" required placeholder="Test@gmail.com">
                    </div>
                
                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required placeholder="*********">
                    </div>
                
                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label class="col-form-label">Confirm Password</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                
                    <!-- Submit Button -->
                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                    </div>
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