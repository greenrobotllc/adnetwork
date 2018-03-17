

@extends('layouts.app')

@section('content')




<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Dashboard</div>
 -->
                <div class="panel-body">
               

<!--     {!! Form::open(['route' => 'ads.store', 'method' => 'post']) !!}
 -->
 
    <form method="POST" action="/ads" enctype="multipart/form-data">
        @include('ads.partials.form', ['buttonText' => 'Create ads'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}




                </div>
            </div>
        </div>
    </div>
</div>




@stop
