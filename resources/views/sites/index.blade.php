<!-- <?php
if(isset($_REQUEST['start'])) {

}
else {
  header("Location:?start=" . date("Y-m-d") . "&end=" . date("Y-m-d"));

}
?> -->
@extends('layouts.app')






@section('content')
 


<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js">

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

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

  <div class="container">
  <!--                 <div class="panel-heading">Campaigns</div>
-->
<div class="panel-body">

                <div class="panel-body">
                    <p>
                        <form action="/sites/create" method="get">
                        <button type="submit" class="btn btn-primary">Add Site or App</button>
                        </form>
                    </p>



<div>
  <table width=100% border=0>
  <tr><td>

  <h4>Sites / Apps</h4>

</td>
<td align='right'>

<!--         <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
-->
<h4>
  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
    <span></span> <b class="caret"></b>
  </div>
</h4>

</td></tr></table>
</div>




<div class="table-responsive">          
  <table class="table table-striped table-bordered table-hover" id="myTable">
       <thead>
      <tr>
        <th>Name</th>
        <th>Edit</th>
        <th>Status</th>
        <th>Platform</th>
        <th>URL</th>
        <th>Impressions</th>
        <th>Clicks</th>
        <th>CTR</th>
        <th>Revenue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
      <tr>
        <td><a href="/sites/{{ $report->id }} ">{{ $report->name }}</a></td>
        <td><a href="/sites/{{ $report->id }}/settings">Edit</a></td>
        <td>{{ $report->approval_status }} </td>
        <td>{{ $report->platform }} </td>
        <td>{{ $report->url }} </td>
        <td>{{ $report->impressions }} </td>
        <td>{{ $report->clicks }} </td>
        <td><?php if($report->impressions) { echo(number_format($report->clicks /$report->impressions * 100, 3)); } ?>% </td>
        <td>${{ money_format("%i", $report->total_cost / 100) }} </td>

      </tr>
          @endforeach

    </tbody>
  </table>

  </div>


                </div>
            </div>

@endsection
