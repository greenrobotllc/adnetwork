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


 <script>
  $( function() {
   $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker();
      } );
  </script>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                 <div class="panel-heading">Dashboard</div>
 -->
                <div class="panel-body">
               

    {!! Form::open(['route' => 'campaigns.store', 'method' => 'post']) !!}
        @include('adcampaigns4.partials.form', ['buttonText' => 'Create Campaign'])
    {!! Form::close() !!}

    {{-- @include('errors.validation') --}}




                </div>
            </div>
        </div>
    </div>
</div>




@stop
