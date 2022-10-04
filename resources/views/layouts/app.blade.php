@extends('layouts.base')

@section('body')

    <x-navbar></x-navbar>

    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
