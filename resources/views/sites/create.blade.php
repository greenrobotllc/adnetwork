@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Dashboard</div>
 -->
                <div class="panel-body">
    
    {!! Form::open(['route' => 'sites.store', 'method' => 'post']) !!}
        @include('sites.partials.form', ['buttonText' => 'Create sites'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}


                </div>
            </div>
        </div>
    </div>
</div>

@stop
