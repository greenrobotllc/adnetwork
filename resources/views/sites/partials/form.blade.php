<!--       <form class="form-horizontal" method="POST" action="{{URL::to('adzone')}}">
-->                   
 <div class="form-group">
<label for="name" class="col-sm-2 control-label" required>Site Name</label>
<div class="col-sm-10">
<!--     <div><?php echo $site->name; ?></div>
 -->        <input type="text" size="10" name="name" class="form-control" id="name" placeholder="Site Name" minlength="3" maxlength="500" value="{{ $site->name }}" required>


</div>


</div>


<div style="clear:both">
&nbsp;
</div>

<div class="form-group">
  <label for="name" class="col-sm-2 control-label" required>URL</label>
  <div class="col-sm-10">
    <input type="text" size="10" name="url" class="form-control" id="url" placeholder="URL" minlength="3" maxlength="500" value="{{ $site->url }}" required>
  </div>
</div>


<div style="clear:both">
&nbsp;
</div>


<div class="form-group">
  <label for="platform" class="col-sm-2 control-label" required>Platform</label>
  <div class="col-sm-10">

<?php echo Form::select('platform', array('web' => 'Web', 'ios' => 'iOS', 'android' => 'Android'), $site->platform );
?>


  </div>
</div>

<div style="clear:both">
&nbsp;
</div>



<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="site_id" value="{{ $site->id }}">

     {{ csrf_field() }}

    <button type="submit" class="btn btn-info">Save</button>
  </div>

</div>








