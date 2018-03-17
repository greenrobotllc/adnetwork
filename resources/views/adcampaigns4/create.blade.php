@extends('layouts.app')

@section('content')

    {!! Form::open(['route' => 'adcampaigns4.store', 'method' => 'post']) !!}
        @include('adcampaigns4.partials.form', ['buttonText' => 'Create adcampaigns4'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}

@stop
