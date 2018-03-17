@extends('app')

@section('content')

    {!! Form::open(['route' => ['adcampaigns3.update', $adcampaigns3->id], 'method' => 'post']) !!}
        @include('adcampaigns3.partials.form', ['buttonText' => 'Update adcampaigns3'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


@stop
