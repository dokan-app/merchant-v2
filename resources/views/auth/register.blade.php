@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="columns is-centered">
            <div class="column is-4">
                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">{{__('Register now')}}</p>
                    </div>
                    <div class="card-content">
                        <form action="{{route('auth.register')}}" method="POST">
                            @csrf
                            {{-- --}}
                            <div class="field">
                                <label for="name" class="label">{{__('Your name')}}</label>
                                <div class="control">
                                    <input type="text" name="name" id="name"
                                           class="input @error('name') is-danger @enderror"
                                           placeholder="{{__('Your name')}}" value="{{old('name')}}">
                                    @error('name')
                                    <p class="help is-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            {{----}}

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
                                <label for="password">{{__('Confirm password')}}</label>
                                <div class="control">
                                    <input type="password" name="password_confirmation" id="password" class="input"
                                           placeholder="{{__('Confirm Password')}}">
                                    @error('name')
                                    <p class="help is-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            {{----}}

                            <div class="field flex items-center">
                                <button class="button is-primary mr-2">{{__('Register')}}</button>
                                <a class="text-gray-600" href="{{route('auth.login')}}">Login now</a>
                            </div>
                            {{----}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
