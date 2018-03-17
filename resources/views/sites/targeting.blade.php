@extends('layouts.app')






@section('content')
 <div class="container">

                    <ul class="nav nav-tabs" style="float:left">
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>">Performance</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/settings">Settings</a>
              </li>
              <li role="presentation" >
                <a href="/sites/<?php echo $site->id; ?>/content">Content</a>
              </li>
              <li role="presentation" class="active">
                <a href="/sites/<?php echo $site->id; ?>/targeting" >Targeting</a>
              </li>
              </ul>
              <br><br>

                 <div class="panel-heading">
					 <h2>Site "{{ $site->name }}" Targeting</h2>
					 <div class="panel-body">
						 <h4>Block New Advertiser Campaigns</h4>
						 <form action="/blocks" method="post">
						   <div class="form-group">
						     <label for="campaign_id">Campaign ID:</label>
						     <input type="text" class="form-control" name="campaign_id" id="campaign_id">
						   </div>

						     <input type="hidden"  name="site_id" value="{{$site->id}}">

						   <button type="submit" class="btn btn-default">Submit</button>
					       
						   {{ csrf_field() }}
						   
						 </form>
						 
						 <hr>
						 <h4>Blocked Advertiser Campaigns</h4>
				         @foreach($blocks as $block)
						 
						 <table><tr>
							 <td>
						 {{$block->campaign_id}}
					 </td><td>
						 
						 {{ Form::open(['method' => 'DELETE', 'route' => ['blocks.destroy', $block->id]]) }}
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
 