@extends('layouts.app')

@section('content')




<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Dashboard</div>
 -->
                <div class="panel-body">
               








    {!! Form::open(['route' => 'widgets.store', 'method' => 'post']) !!}
        @include('widget.partials.form', ['buttonText' => 'Create widget'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}

                </div>
            </div>
        </div>
    </div>
</div>




@stop
