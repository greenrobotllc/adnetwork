@extends('app')

@section('content')

    {!! Form::open(['route' => 'adcampaigns2.store', 'method' => 'post']) !!}
        @include('adcampaigns2.partials.form', ['buttonText' => 'Create adcampaigns2'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}

@stop
