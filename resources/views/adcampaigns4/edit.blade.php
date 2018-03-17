@extends('app')

@section('content')

    {!! Form::open(['route' => ['adcampaigns4.update', $adcampaigns4->id], 'method' => 'post']) !!}
        @include('adcampaigns4.partials.form', ['buttonText' => 'Update adcampaigns4'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


@stop
