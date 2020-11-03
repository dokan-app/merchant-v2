@extends('layouts.dashboard')

@section('content')
    <div class="text-center">
        <h1 class="text-4xl uppercase">Dashboard</h1>
        {{auth()->user()->me->json('name')}}
    </div>
@endsection
