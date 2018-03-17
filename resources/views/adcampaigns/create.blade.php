@extends('app')

@section('content')

    {!! Form::open(['route' => 'adcampaigns.store', 'method' => 'post']) !!}
        @include('adcampaigns.partials.form', ['buttonText' => 'Create adcampaigns'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}

@stop
