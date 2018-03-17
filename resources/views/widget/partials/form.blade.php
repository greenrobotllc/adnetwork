<!--       <form class="form-horizontal" method="POST" action="{{URL::to('adzone')}}">
-->                   
 <div class="form-group">
<label for="name" class="col-sm-2 control-label" required>Site Name</label>
<div class="col-sm-10">
   {{ $site->name }}


</div>


</div>



<div style="clear:both">
&nbsp;
</div>


 <div class="form-group">
<label for="name" class="col-sm-2 control-label" required>Widget Name</label>
<div class="col-sm-10">
    <input type="text" size="10" name="name" class="form-control" id="name" placeholder="Widget Name" minlength="3" maxlength="500" value="{{ $widget->name }}" required>


</div>


</div>



<div style="clear:both">
&nbsp;
</div>





<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="sid" value="{{ $site->id }}">

     {{ csrf_field() }}

    <button type="submit" class="btn btn-info">Save</button>
  </div>

</div>








