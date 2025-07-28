<!-- resources/views/home.blade.php -->
@extends('layouts.app')
@section('title', 'Login')
@section('content')

            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="card w-100" style="max-width: 1000px;">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <form action="/login" method="POST">
                                @csrf
                                @include('layouts.messages')
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address or Username</label>
                                    <div class="col-md-6">
                                            <input type="text" id="username" class="form-control" name="username" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
@endsection
