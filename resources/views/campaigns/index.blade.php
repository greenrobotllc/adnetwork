
@extends('layouts.app')

@section('content')


<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />




<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>




<script>



  $('input[name="daterange"]').daterangepicker();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



  var _token = $('input[name="_token"]').val();
  function disable(campaign_id) {
        //alert("disable");
        //alert(campaign_id);

        $.ajax({
    method: 'POST', // Type of response and matches what we said in the route
    url: '/campaigns/' +  campaign_id +'/ajax_disable', // This is the url we gave in the route
    data: { _token : _token },
    success: function(response){ // What to do if we succeed
      console.log(response);
        //alert('success'); 
        //alert(campaign_id);
        $("#on_or_off_" + campaign_id).text("Off");

      },
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      alert('error');

    }
  });

      }

      function enable(campaign_id) {
        //alert("enable");
        //alert(campaign_id);
        $.ajax({
    method: 'POST', // Type of response and matches what we said in the route
    url: '/campaigns/' +  campaign_id +'/ajax_enable', // This is the url we gave in the route
    data: {'campaign_id' : campaign_id}, // a JSON object to send back
    success: function(response){ // What to do if we succeed
      console.log(response);
      $("#on_or_off_" + campaign_id).text("On");

        //alert('success'); 
      },
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      alert('error');
    }
  });


      }



    </script>


    <script type="text/javascript">
      $(function() {

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  //$('#daterange').val('');
    //alert(picker.startDate);
    //alert(picker.endDate);
    window.location="?start=" + picker.startDate.format('Y-MM-DD') + "&end=" + picker.endDate.format('Y-MM-DD') ;

  });

    //var start = moment().subtract(29, 'days');
    //var end = moment();
      //var d = $(this).datepicker("getDate");


    <?php

    if(isset($_REQUEST['start'])) {
            //echo("WTF");
      $start = $_REQUEST['start']; ?>
      var mydate = new Date("<?php echo $start; ?>".replace(/-/g, "/"));
            //mydate.setDate(mydate.getDate() + 1);
            var day = mydate.getDate();
            var monthIndex = mydate.getMonth() + 1;
            var year = mydate.getFullYear();


            <?php echo("var start="); ?>  monthIndex + '/' + day + '/' + year;

                   //alert(start);
                   <?php
                 }
                 else {
         //echo("OKGOOD");
                   echo("var start = moment(); ");


                 }

                 ?>

                 <?php

                 if(isset($_REQUEST['end'])) {
                  $end = $_REQUEST['end']; ?>
                  var mydate = new Date("<?php echo $end; ?>".replace(/-/g, "/"));
            //mydate.setDate(mydate.getDate() + 1);
            var day = mydate.getDate();
            var monthIndex = mydate.getMonth() + 1;
            var year = mydate.getFullYear();


            <?php echo("var end="); ?>  monthIndex + '/' + day + '/' + year;
          //alert(end);
          <?php
        }
        else {

         echo("var end = moment();\n");


       }
       ?>




       function cb(start, end) {
        if(typeof(start) != "object") {
          $('#reportrange span').html(start + ' - ' + end);

        }
        else {

        }
      }


      $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,

        ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
       }
     }, cb);

      cb(start, end);


    });


      $(document).ready(function() {
        $('#myTable').DataTable();
      });


  </script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js">
  

</script><script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>



  <div class="container">
  <!--                 <div class="panel-heading">Campaigns</div>
-->
<div class="panel-body">
  <p>
    <form action="/campaigns/create" method="get">
      <button type="submit" class="btn btn-primary">Create Campaign</button>
    </form>
  </p>




  <table width=100% border=0><tr><td><h4>Campaigns</h4></td><td align='right'>

<!--         <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
-->
<h4>
  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
    <span></span> <b class="caret"></b>
  </div>
</h4>


</td></tr></table>


<!-- 
<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> <thead> <tr> <th>Name</th> <th>Position</th> <th>Office</th> <th>Salary</th> </tr></thead> <tbody> <tr> <td>Tiger Nixon</td><td>System Architect</td><td>Edinburgh</td><td>$320,800</td></tr><tr> <td>Garrett 


 -->


<div class="table-responsive">          
  <table class="table table-striped table-bordered table-hover" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Enabled</th>
        <th>Status</th>
        <th>Bid Amount</th>
        <th>Impressions</th>
        <th>Clicks</th>
        <th>CTR</th>
        <th>Cost</th>
        <th>Budget</th>
      </tr>
    </thead>
    <tbody>
      @foreach($campaigns as $c)
      <tr>

        <td>{{ $c->id }}</td>
        <td><a href="/campaigns/{{$c->id}}">{{ $c->name }}</a></td>
        <td><a href="/campaigns/{{$c->id}}/settings">Edit</a></td>

        <td>{{ $c->start_date }}</td>
        <td><?php if($c->end_date) { echo $c->end_date; } else { echo "N/A"; } ?></td>
        <td><!-- Rectangular switch -->

          <table cellpadding='5px'><tr><td style='padding-right:10px'>
            <div valign='center' style='margin-bottom:10px' id="on_or_off_<?php echo $c->id; ?>"><?php if($c->enabled) { echo("On"); } else { echo("Off"); } ?></div>
          </td>
          <td>

            <label class="switch">
              <input id="my_checkbox" onClick="if($(this).is(':checked')){
              enable('<?php echo $c->id; ?>');
            }
            else {
            disable('<?php echo $c->id; ?>');
          }
          " type="checkbox" <?php if($c->enabled && $c->status != "no_ads") { echo("checked"); } if($c->status == "no_ads") { echo "disabled"; } ?> >
          <div class="slider"></div>
        </label>
      </td>
    </tr>
  </table>


  <!-- {{ $c->enabled }} --></td>
  <td>{{$c->status}}</td>
  <td>${{ money_format("%i", $c->bid_amount / 100 ) }}</td>
  <td> {{ $c->impressions }}</td>
  <td> {{ $c->clicks }}</td>
  <td> <?php if($c->impressions == 0) {
    echo "0";
  }
  else {
    echo(number_format(($c->clicks/$c->impressions)*100, 2)); } ?>%

  </td>

  <td>${{ money_format("%i", $c->cost) }}</td>
  <td>${{ money_format("%i", $c->budget_amount) }}</td>

</tr>
@endforeach

</tbody>
</table>
</div>

<!--     @foreach($campaigns as $c)

        {!! var_dump($c) !!}
    @endforeach
  -->


</div>
</div>

@endsection
