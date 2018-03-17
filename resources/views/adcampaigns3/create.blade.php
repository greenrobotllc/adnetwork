@extends('app')

@section('content')

    {!! Form::open(['route' => 'adcampaigns3.store', 'method' => 'post']) !!}
        @include('adcampaigns3.partials.form', ['buttonText' => 'Create adcampaigns3'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}

@stop
