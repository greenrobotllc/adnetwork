@extends('layouts.app')

@section('content')


<div style='background-color: white'>
      <a href="{{$ad->url}}">
        
       <img src="https://s3.amazonaws.com/gradnetwork/{{ $ad->image_url }}" width=240 height=160/>

        
        <br>{{ $ad->headline }}</a></div>
@stop
