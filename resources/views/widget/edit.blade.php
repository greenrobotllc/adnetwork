@extends('app')

@section('content')

    {!! Form::open(['route' => ['widget.update', $widget->id], 'method' => 'post']) !!}
        @include('widget.partials.form', ['buttonText' => 'Update widget'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


@stop
