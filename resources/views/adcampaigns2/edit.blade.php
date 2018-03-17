@extends('app')

@section('content')

    {!! Form::open(['route' => ['adcampaigns2.update', $adcampaigns2->id], 'method' => 'post']) !!}
        @include('adcampaigns2.partials.form', ['buttonText' => 'Update adcampaigns2'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


@stop
