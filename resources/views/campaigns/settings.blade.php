@extends('layouts.app')

@section('content')

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">
<!-- <script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script> -->
  <script src="/semantic/dist/semantic.min.js"></script>

<script type="text/javascript">
  

      $(function() {

   $('div #hybrid')
   .dropdown()
   });

 

</script>




<script type="text/javascript">
    $(function() {

    $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker();



 

});

</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Campaign "{{ $campaign->name }}" Settings</h2></div>
                <div class="panel-body">
               

                   <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>">Performance</a>
              </li>
              <li role="presentation" class="active">
                <a href="/campaigns/<?php echo $campaign->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation"  >
                <a href="/campaigns/<?php echo $campaign->id; ?>/content">Content</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/targeting">Targeting</a>
              </li>

            </ul>




                    <p>&nbsp;</p>
<p>&nbsp;</p>

<div style='clear: left;'>

        {!! Form::open(['route' => ['campaigns.update', $campaign->id], 'method' => 'put']) !!}        @include('adcampaigns4.partials.form', ['buttonText' => 'Save'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}

</div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop
