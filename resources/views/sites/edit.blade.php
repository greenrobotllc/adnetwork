@extends('app')

@section('content')

    {!! Form::open(['route' => ['sites.update', $sites->id], 'method' => 'post']) !!}
        @include('sites.partials.form', ['buttonText' => 'Update sites'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


@stop
