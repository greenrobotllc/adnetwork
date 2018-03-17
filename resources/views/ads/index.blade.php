@extends('layouts.app')

@section('content')

    @foreach($ads as $ads)
        {!! var_dump($ads) !!}
    @endforeach


@stop
