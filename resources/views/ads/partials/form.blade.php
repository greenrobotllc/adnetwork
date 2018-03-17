
<!--       <form class="form-horizontal" method="POST" action="{{URL::to('adzone')}}">
-->                   
 <div class="form-group">
<label for="name" class="col-sm-2 control-label" required>Campaign Name</label>
<div class="col-sm-10">
    <div><?php echo $campaign->name; ?></div>
</div>


</div>


<div style="clear:both">
&nbsp;
</div>

<div class="form-group">
  <label for="name" class="col-sm-2 control-label" required>URL</label>
  <div class="col-sm-10">
    <input type="text" size="10" name="url" class="form-control" id="url" placeholder="URL" minlength="3" maxlength="500" value="{{ $ad->url }}" required>
  </div>
</div>


<div style="clear:both">
&nbsp;
</div>


<div class="form-group">
  <label for="name" class="col-sm-2 control-label" required>Headline</label>
  <div class="col-sm-10">
    <input type="text" size="10" name="headline" class="form-control" id="headline" placeholder="Headline" minlength="3" maxlength="100" value="{{ $ad->headline }}" required>
  </div>
</div>


<div style="clear:both">
&nbsp;
</div>


<div class="form-group">
  <label for="name" class="col-sm-2 control-label" required>Brand Name</label>
  <div class="col-sm-10">
    <input type="text" size="10" name="brand_name" class="form-control" id="brand_name" placeholder="Brand Name" minlength="3" maxlength="100" value="{{ $ad->brand_name }}" required>
  </div>
</div>


<div style="clear:both">
&nbsp;
</div>



<div class="form-group">
  <label for="name" class="col-sm-2 control-label" required>Image</label>
  <div class="col-sm-10">
    <input type="file" name="image" class="form-control" id="image" required>
  </div>
</div>


<div style="clear:both">
&nbsp;
</div>



<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <input type="hidden" name="campaign_id" value="{{ $ad->campaign_id }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

     {{ csrf_field() }}

    <button type="submit" class="btn btn-info">Save</button>
  </div>

</div>








