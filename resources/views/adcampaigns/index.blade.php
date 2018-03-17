@extends('app')

@section('content')

    @foreach($adcampaigns as $adcampaigns)
        {!! var_dump($adcampaigns) !!}
    @endforeach


@stop
