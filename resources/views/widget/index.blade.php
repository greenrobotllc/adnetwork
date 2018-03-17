<?php
use App\Sites;

?>

@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Campaigns</div>
 -->
                <div class="panel-body">
         

 
 <h2>Widgets</h2>

<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Site/App</th>

      </tr>
    </thead>
    <tbody>
        @foreach($widgets as $c)
      <tr>

        <td>{{ $c->id }}</td>
        <td><a href="/widgets/{{$c->id}}">{{ $c->name }}</a></td>
        <td><?php echo Sites::find($c->site_id)->name; ?></td>


      </tr>
          @endforeach

    </tbody>
  </table>
  </div>

    @foreach($widgets as $c)

        {!! var_dump($c) !!}
    @endforeach



                </div>
            </div>
        </div>
    </div>
</div>
@stop
