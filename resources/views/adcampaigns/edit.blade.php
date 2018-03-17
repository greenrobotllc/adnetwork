@extends('app')

@section('content')

    {!! Form::open(['route' => ['adcampaigns.update', $adcampaigns->id], 'method' => 'post']) !!}
        @include('adcampaigns.partials.form', ['buttonText' => 'Update adcampaigns'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


@stop
