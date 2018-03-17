<?php
if(isset($_REQUEST['start'])) {

}
else {
  header("Location:?start=" . date("Y-m-1") . "&end=" . date("Y-m-t"));

}
?>
@extends('layouts.app')

@section('content')

<?php
use App\Sites;
?>



<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />




<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>

<script type="text/javascript">
  
    $(document).ready(function() {
        $('#myTable').DataTable();
      });



</script>




<?php

require_once(Config::get('view.paths')[0] . '/datepickerjs.blade.php');

?>



<div class="container">
                 <div class="panel-heading"><h2>Site "{{ $site->name }}" Content</h2><br>

                                         <form action="/widgets/create">
                        <input type="hidden" name="sid" value="<?php echo $site->id; ?>">
                        <button type="submit" class="btn btn-primary">Create Widget</button>
                        </form>

                        </div>
 
                <div class="panel-body">
               
                <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>">Performance</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation" class="active" >
                <a href="/sites/<?php echo $site->id; ?>/content">Content</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/targeting" >Targeting</a>
              </li>

</ul>


            <div style="clear: both;"></div>
            <br><br>




<br><br> 

 <table width=100% border=0><tr><td><h4>Widgets</h4></td><td align='right'>
 
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
        <th>ID</th>
        <th>Name</th>
        <th>Site/App</th>
        <th>Impressions</th>
        <th>Clicks</th>

      </tr>
    </thead>
    <tbody>
        @foreach($widgets as $c)
      <tr>

        <td>{{ $c->id }}</td>
        <td><a href="/widgets/{{$c->id}}">{{ $c->name }}</a></td>
        <td><?php echo Sites::find($c->site_id)->name; ?></td>
        <td>{{ $c->impressions }}</td>
        <td>{{ $c->clicks }}</td>


      </tr>
          @endforeach

    </tbody>
  </table>
  </div>

<!--     @foreach($widgets as $c)

        {!! var_dump($c) !!}
    @endforeach -->


                </div>
            </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js">
  

</script><script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>



@stop
