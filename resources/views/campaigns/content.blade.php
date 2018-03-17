<?php
if(isset($_REQUEST['start'])) {

}
else {
  header("Location:?start=" . date("Y-m-1") . "&end=" . date("Y-m-t"));

}
?>
<!-- {!! var_dump($ads) !!}
 -->
@extends('layouts.app')

@section('content')



<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
 


<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>




<script>


  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



  var _token = $('input[name="_token"]').val();
  
  function disable(ad_id) {
        //alert("disable");
        //alert(campaign_id);

        $.ajax({
    method: 'POST', // Type of response and matches what we said in the route
    url: '/ads/' +  ad_id +'/ajax_disable', // This is the url we gave in the route
    data: { _token : _token },
    success: function(response){ // What to do if we succeed
      console.log(response);
        //alert('success'); 
        //alert(campaign_id);
        $("#on_or_off_" + ad_id).text("Off");

      },
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      alert('error');

    }
  });

      }

      function enable(ad_id) {
        //alert("enable");
        //alert(campaign_id);
        $.ajax({
    method: 'POST', // Type of response and matches what we said in the route
    url: '/ads/' +  ad_id +'/ajax_enable', // This is the url we gave in the route
    data: { _token : _token },
    success: function(response){ // What to do if we succeed
      console.log(response);
      $("#on_or_off_" + ad_id).text("On");

        //alert('success'); 
      },
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      alert('error');
    }
  });


      }


            $(document).ready(function() {
        $('#myTable').DataTable();
      });



</script>
<?php
require_once(Config::get('view.paths')[0] . '/datepickerjs.blade.php');

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js">
  

</script><script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>



<div class="container">
                 <div class="panel-heading"><h2>Create and View Ads For Campaign "{{ $campaign->name }}"</h2>
                  <br>
                    <form action="/ads/create">
                        <input type="hidden" name="cid" value="<?php echo $campaign->id; ?>">
                        <button type="submit" class="btn btn-primary">Create Ad</button>
                        </form>


</div>
                <div class="panel-body">
               
                <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>">Performance</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation" class="active" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/content">Content</a>
              </li>
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>/targeting">Targeting</a>
              </li>
</ul>


            <div style="clear: both;"></div>
            <br><br>
                     


<br><br>

 <table width=100% border=0><tr><td><h4>Ads</h4></td><td align='right'>
 
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
        <th>Ad ID</th>
        <th>Status</th>
        <th>Impressions</th>
        <th>Clicks</th>
        <th>CTR</th>
        <th>Avg. CPC</th>
        <th>Cost</th>
        <th>Added On</th>
        <th>Ad Enabled</th>
        <th>Campaign Enabled</th>
        <th>Edit</th>
        <th>Ad Preview</th>

      </tr>
    </thead>
    <tbody>
        @foreach($ads as $c)
      <tr>

        <td>{{ $c->id }}</td>
   

        <td>{{ $c->status }}</td>
        <td>{{ $c->impressions }}</td>
        <td>{{ $c->clicks }}</td>
        <td><?php if($c->impressions == 0) {
            echo "0";
        }
            else {
                echo(number_format(($c->clicks/$c->impressions)*100, 2)); } ?>%

                </td>
                <td><?php if($c->clicks == 0) {
                 echo("$");
                 echo money_format("%i", 0); 
                }
                else { ?>
                  ${{money_format("%i", $c->cost / $c->clicks) }}
                <?php } ?>
                </td>
                <td>${{money_format("%i", $c->cost) }}</td>
                <td>{{$c->created_at}}</td>

                <td>
            <label class="switch">
              <input id="my_checkbox" onClick="if($(this).is(':checked')){
              enable("<?php echo $c->id; ?>");
            }
            else {
            disable("<?php echo $c->id; ?>");
          }
          " type="checkbox" <?php if($c->enabled && $c->status != "no_ads") { echo("checked"); } if($c->status == "no_ads") { echo "disabled"; } ?> >
          <div class="slider"></div>
        </label>
        </td>
                <td>{{$c->campaign_enabled}}</td>
                <td><a href="/ads/{{$c->id}}/edit">Edit</a></td>

     <td>


     <div style='width:718px; height:80px'>
      <table><tr><td>
      <a target="_blank" href="{{$c->url}}">
        
       <img src="https://s3.amazonaws.com/gradnetwork/{{ $c->image_url }}" width=80 height=80/> </a>
       </td><td>

        <center> <a target="_blank" href="{{$c->url}}">{{ $c->headline }}</a></center>

</td></tr></table>
</div>


        </td>


      </tr>

          @endforeach

    </tbody>
  </table>
  </div>


                </div>
            </div>




@stop
