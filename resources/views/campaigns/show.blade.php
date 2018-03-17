<?php
if(isset($_REQUEST['start'])) {

}
else {
  header("Location:?start=" . date("Y-m-1") . "&end=" . date("Y-m-t"));

}
?>

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




<script type="text/javascript">
$(function() {

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
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
        $('#daterange span').html(start + ' - ' + end);

      }
      else {
    
      }
    }


    $('#daterange').daterangepicker({
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




<script>



$('input[name="daterange"]').daterangepicker();






           <?php

        if(isset($_REQUEST['start'])) {
            //echo("WTF");
        $start = $_REQUEST['start']; ?>
           var mydate = new Date("<?php echo $start; ?> EDT");
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
         echo("var start = moment().startOf('month');\n");
        

        }

?>

<?php

        if(isset($_REQUEST['end'])) {
        $end = $_REQUEST['end']; ?>
            var mydate = new Date("<?php echo $end; ?> EDT");
            //mydate.setDate(mydate.getDate() + 1);
            var day = mydate.getDate();
            var monthIndex = mydate.getMonth() + 1;
            var year = mydate.getFullYear();


          <?php echo("var end="); ?>  monthIndex + '/' + day + '/' + year;
          //alert(end);
          <?php
        }
        else {
          
         echo("var end = moment().endOf('month');\n");
        

        }
        ?>
        

   
 

</script>




<div class="container">
    
                <div class="panel-heading"><h2>Campaign "{{ $campaign->name }}" Performance</h2>
                <br>
                   <form action="/ads/create">
                        <input type="hidden" name="cid" value="<?php echo $campaign->id; ?>">
                        <button type="submit" class="btn btn-primary">Create Ad</button>
                        </form>


</div>

                <div class="panel-body">
               

                   <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" class="active">
                <a href="/campaigns/<?php echo $campaign->id; ?>">Performance</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/content">Content</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/targeting">Targeting</a>
              </li>
              </ul>

              <p>&nbsp;</p>
              <p>&nbsp;</p>
<!-- 
              <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" class="active">
                <a href="/campaigns/<?php echo $campaign->id; ?>">Daily</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/settings">Weekly</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/content">Monthly</a>
              </li>

            </ul> -->

<div style='clear:both'>&nbsp; </div>

 <table width=100% border=0><tr><td><h4>"{{ $campaign->name }}"</h4></td><td align='right'>
 
 <h4>
<div id="daterange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
    <span></span> <b class="caret"></b>
</div>
</h4>


 </td></tr></table>
 <br>&nbsp;
<div class="table-responsive">   

<!--   <table class="table">
 -->  

   <table class="table table-striped table-bordered table-hover" id="myTable">

  <thead>
      <tr>
        <th>Date</th>
        <th>Impressions</th>
        <th>Clicks</th>
        <th>Cost</th>

      </tr>
    </thead>
    <tbody>
        @foreach($reports as $c)
      <tr>

        <td>{{ $c->report_date }}</td>
       
        <td>{{ $c->impressions }}</td>
        <td>{{ $c->clicks }}</td>
        <td>${{ money_format("%i", $c->cost) }}</td>

      </tr>
          @endforeach

    </tbody>
  </table>
  </div>






                    <p></p>
                </div>
</div>




<!--     {!! var_dump($campaign) !!}
 -->

@stop
