@extends('layouts.app')

@section('content')

    @livewire('image-acceptance',['album' => $album])

@endsection