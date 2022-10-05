@extends('layouts.base')

@section('body')

    <div class="min-h-screen grid grid-rows-[auto,1fr] mx-auto">

        <div>
    <x-navbar></x-navbar>
        </div>

        <div>
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
        </div>

    </div>
@endsection
