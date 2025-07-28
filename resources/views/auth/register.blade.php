<!-- resources/views/home.blade.php -->
@extends('layouts.app')
@section('title', 'Registro')
@section('content')

            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="card w-100" style="max-width: 1000px;">
                    <div class="card">
                        <div class="card-header">Registrarse</div>
                        <div class="card-body">
                            <form action="/register" method="POST">
                                @csrf
                                @include('layouts.messages')
                                <div class="form-group row">
                                    <label for="Name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                            <input type="text" id="name" class="form-control" name="name" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                    <div class="col-md-6">
                                        <input type="username" id="username" class="form-control" name="username" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrarse
                                    </button>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
@endsection
