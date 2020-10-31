@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="columns is-centered">
            <div class="column is-4">
                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">{{__('Login to your account')}}</p>
                    </div>
                    <div class="card-content">
                        <form action="{{route('auth.login')}}" method="POST">
                            @csrf
                            {{-- --}}
                            <div class="field">
                                <label for="email">{{__('Email address')}}</label>
                                <div class="control">
                                    <input type="text" name="email" id="email"
                                           class="input @error('email') is-danger @enderror"
                                           placeholder="{{__('Your email address')}}" value="{{old('email')}}">
                                    @error('email')
                                    <p class="help is-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            {{----}}

                            {{-- --}}
                            <div class="field">
                                <label for="password">{{__('Password')}}</label>
                                <div class="control">
                                    <input type="password" name="password" id="password"
                                           class="input @error('password') is-danger @enderror"
                                           placeholder="{{__('Your password')}}">
                                    @error('password')
                                    <p class="help is-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            {{----}}

                            {{-- --}}
                            <div class="field">
                                <label>
                                    <input type="checkbox" name="remember">
                                    <span class="ml-2">{{__('Remember?')}}</span>
                                </label>
                            </div>
                            {{----}}

                            <div class="field flex items-center">
                                <button class="button is-primary mr-2">{{__('Login')}}</button>
                                <a class="text-gray-600" href="{{route('auth.register')}}">Register now</a>
                            </div>
                            {{----}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
