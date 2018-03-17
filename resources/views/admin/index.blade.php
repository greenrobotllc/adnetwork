@extends('layouts.app')

@section('content')

  <h4>Pending Ads</h4>

    @foreach($pending_ads as $ad)
    <div style="padding:10px">
     <div style='width:728px'>
     <table><tr><td>
      <a target="_blank" href="{{$ad->url}}">
        
       <img src="https://s3.amazonaws.com/gradnetwork/{{ $ad->image_url }}" width=90 height=90/></a>
</td><td>{{ $ad->headline }}</a>
  </td></tr></table>

<br><a href="/admin/{{$ad->id}}/approve">Approve</a> &nbsp; | &nbsp; <a href="/admin/{{$ad->id}}/deny">Deny</a></center></div>
  </div>

    @endforeach

    <h4>Approved Ads</h4>
    @foreach($approved_ads as $ad)
    <div style="padding:10px">
     <div style='width:728px'>
         <table><tr><td>
      <a target="_blank" href="{{$ad->url}}">
        
       <img src="https://s3.amazonaws.com/gradnetwork/{{ $ad->image_url }}" width=90 height=90/></a>
</td><td>{{ $ad->headline }}</a>
  </td></tr></table>

        
       
       <br><a href="/admin/{{$ad->id}}/reset">Reset</a></center></div>
  </div>

    @endforeach


    <h4>Denied Ads</h4>
    @foreach($denied_ads as $ad)
    <div style="padding:10px">
     <div style='width:728px'>
          <table><tr><td>
      <a target="_blank" href="{{$ad->url}}">
        
       <img src="https://s3.amazonaws.com/gradnetwork/{{ $ad->image_url }}" width=90 height=90/></a>
</td><td>{{ $ad->headline }}</a>
  </td></tr></table>

  <br><a href="/admin/{{$ad->id}}/reset">Reset</a></center></div>
  </div>

    @endforeach

    <hr>




  <h4>Pending Sites</h4>

    @foreach($pending_sites as $ad)
    <div style="padding:10px">
     <div style='width:728px'>

     
      <a target="_blank" href="{{$ad->url}}">{{ $ad->url }}</a>
      <br>
        <a href="/admin/{{$ad->id}}/approvesite">Approve</a> &nbsp; | &nbsp; <a href="/admin/{{$ad->id}}/denysite">Deny</a></div>
  </div>

    @endforeach

    <h4>Approved Sites</h4>
    @foreach($approved_sites as $ad)
    <div style="padding:10px">
     <div style='width:728px'>
      <a target="_blank" href="{{$ad->url}}">{{$ad->url}}
     </a><br><a href="/admin/{{$ad->id}}/resetsite">Reset</a></div>
  </div>

    @endforeach


    <h4>Denied Sites</h4>
    @foreach($denied_sites as $ad)
    <div style="padding:10px">
     <div style='width:728px'>
      <a target="_blank" href="{{$ad->url}}">{{$ad->url}}
     </a><br><a href="/admin/{{$ad->id}}/resetsite">Reset</a></div>
  </div>

    @endforeach


@stop
