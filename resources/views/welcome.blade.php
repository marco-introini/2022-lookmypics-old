@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="flex items-center justify-center">
            <div class="flex flex-col justify-around">
                <div class="space-y-6">
                    <a href="{{ route('home') }}">
                        <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
                    </a>

                    <section class="lg:py-12 lg:flex lg:justify-center">
                        <div class="bg-white dark:bg-gray-800 lg:mx-8 lg:flex lg:max-w-5xl lg:shadow-lg lg:rounded-lg">
                            <div class="lg:w-1/2">
                                <div class="h-64 bg-cover lg:rounded-lg lg:h-full" style="background-image:url('https://images.unsplash.com/photo-1593642532400-2682810df593?ixlib=rb-1.2.1&ixid=MXwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=750&q=80')"></div>
                            </div>

                            <div class="max-w-xl px-6 py-12 lg:max-w-5xl lg:w-1/2">
                                <h2 class="text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">
                                    <span class="text-blue-600 dark:text-blue-400">{{ config('app.name') }}</span></h2>
                                <p class="mt-4 text-gray-600 dark:text-gray-400">The Open Source project for photography acceptance.</p>
                                <p class="mt-4 text-gray-600 dark:text-gray-400">This software is written for helping photographers to share their pictures to client and asking them for acceptance.</p>

                                <div class="mt-8">
                                    <a href="{{route('login')}}" class="px-5 py-2 font-semibold text-gray-100 transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-700">Client Login</a>
                                </div>
                            </div>
                        </div>
                    </section>



                    <h2 class="text-xl font-extrabold tracking-wider text-center text-gray-600">

                    </h2>


                    <div class="text-xl font-extrabold tracking-wider text-center text-gray-600 mt-60">
                        Written by Marco Introini
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
