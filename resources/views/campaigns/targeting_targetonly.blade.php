@extends('layouts.app')






@section('content')
<script type="text/javascript">

	//alert('hi');
	
	// $( ".blacklist_or_targetonly" ).change(function() {
 //  		alert( "Handler for .change() called." );
	// });

	// $('select').on('change', function() {
 //  		alert( this.value );
	// })

</script>
 <div class="container">

               

                   <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" >
                <a href="/campaigns/<?php echo $campaign->id; ?>">Performance</a>
              </li>
              <li role="presentation">
                <a href="/campaigns/<?php echo $campaign->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation"  >
                <a href="/campaigns/<?php echo $campaign->id; ?>/content">Content</a>
              </li>
              <li role="presentation" class="active">
                <a href="/campaigns/<?php echo $campaign->id; ?>/targeting" >Targeting</a>
              </li>
              </ul>
		<br>


                 <div class="panel-heading">
					 <h2>Campaign "{{ $campaign->name }}" Whitelist Target Only Targeting</h2>
					 <div class="panel-body">

					<form>

					<p>You can either choose to blacklist certain widgets or only target certain widgets</p>

					 <select name="blacklist_or_targetonly" class="blacklist_or_targetonly">
  						<option value="blacklist">Blacklist</option>
  						<option value="targetonly" selected>Target Only</option>
					</select>
					<button type="submit" class="btn btn-default">Save</button>

  					</form>



						 <h4>Target New Publisher Sites/Apps</h4>
						 <form action="/targetonly" method="post">
						   <div class="form-group">
						     <label for="site_id">Site ID:</label>
						     <input type="text" class="form-control" name="site_id" id="site_id">
						   </div>

						     <input type="hidden"  name="campaign_id" value="{{$campaign->id}}">

						   <button type="submit" class="btn btn-default">Submit</button>
					       
						   {{ csrf_field() }}
						   
						 </form>
						 
						 <hr>
						 <h4>Target Publisher Sites/Apps</h4>
				         @foreach($targetonly as $block)
						 
						 <table><tr>
							 <td>
						 {{$block->site_id}}
					 </td><td>
						 
						 {{ Form::open(['method' => 'DELETE', 'route' => ['targetonly.destroy', $block->id]]) }}
						     {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
						 {{ Form::close() }}
						 
						 
						
						 </td>
					 </tr>
				 </table>
							 </p>
							 
			             @endforeach
						 
					</div>		 
				</div>
			</div>

@endsection
 