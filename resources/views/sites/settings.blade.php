@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Site "{{ $site->name }}" Settings</h2></div>
                
                <div class="panel-body">
               

                   <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>">Performance</a>
              </li>
              <li role="presentation" class="active">
                <a href="/sites/<?php echo $site->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation"  >
                <a href="/sites/<?php echo $site->id; ?>/content">Content</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/targeting" >Targeting</a>
              </li>

            </ul>




<p>&nbsp;</p>
<p>&nbsp;</p>

<div style='clear: left;'>

        {!! Form::open(['route' => ['sites.update', $site->id], 'method' => 'put']) !!}

        @include('sites.partials.form', ['buttonText' => 'Save'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}

</div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop
