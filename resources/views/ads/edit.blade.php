@extends('layouts.app')

@section('content')

    {!! Form::open(['route' => ['ads.update', $ad->id], 'method' => 'put', 'files' => true]) !!}
        @include('ads.partials.form', ['buttonText' => 'Update ad'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


@stop
