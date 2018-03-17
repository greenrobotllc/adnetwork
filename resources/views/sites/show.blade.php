<!-- <?php
if(isset($_REQUEST['start'])) {

}
else {
  header("Location:?start=" . date("Y-m-1") . "&end=" . date("Y-m-t"));

}
?> -->

@extends('layouts.app')

@section('content')

<?php
use App\Sites;

// $reportDate="this_month";
// if(isset($_REQUEST['date'])) {
//     $reportDate = $_REQUEST['date'];
// }
// else {
//   $reportDate="this_month";

// }

?>

<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />




<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>

<?php

require_once(Config::get('view.paths')[0] . '/datepickerjs.blade.php');

?>

<script type="text/javascript">
        $(document).ready(function() {
        $('#myTable').DataTable();
      });



</script>

<div class="container">
               <div class="panel-heading"><h2>Site "{{ $site->name }}" Performance</h2><br>                         <form action="/widgets/create">
                        <input type="hidden" name="sid" value="<?php echo $site->id; ?>">
                        <button type="submit" class="btn btn-primary">Create Widget</button>
                        </form>

                        </div>

                <div class="panel-body">
               

                   <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" class="active">
                <a href="/sites/<?php echo $site->id; ?>">Performance</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/content">Content</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/targeting">Targeting</a>
              </li>
              </ul>

             <!--  <p>&nbsp;</p>
              <p>&nbsp;</p> -->

<!--               <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" class="active">
                <a href="/campaigns/<?php echo $site->id; ?>">Daily</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $site->id; ?>/settings">Weekly</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $site->id; ?>/content">Monthly</a>
              </li>

            </ul> -->


<br>&nbsp;<br>
<br>&nbsp;<br>
 <table width=100% border=0><tr><td><h4>Daily Reports</h4></td><td align='right'>
 
 <h4>
<div id="daterange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
    <span></span> <b class="caret"></b>
</div>
</h4>

 </td></tr></table>


<div class="table-responsive">          
   <table class="table table-striped table-bordered table-hover" id="myTable">

    <thead>
      <tr>
        <th>Date</th>
        <th>Impressions</th>
        <th>Clicks</th>
        <th>Revenue</th>

      </tr>
    </thead>
    <tbody>
        @foreach($reports as $c)
      <tr>

        <td>{{ $c->report_date }}</td>
        <td>{{ $c->impressions }}</td>
        <td>{{ $c->clicks }}</td>
        <td>${{ money_format("%i", round(($c->total_cost / 100), 2)) }}</td>


      </tr>
          @endforeach

    </tbody>
  </table>
  </div>




                    <p></p>
                </div>
            </div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js">
  

</script><script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>


<!--     {!! var_dump($site) !!}
 -->

@stop
