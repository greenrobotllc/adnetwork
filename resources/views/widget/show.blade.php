@extends('layouts.app')

@section('content')
<?php use App\Sites;

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Widget "{{ $widget->name }}" Details</h2></div>

                <div class="panel-body">
                    <?php $mySite = Sites::find($widget->site_id); ?>
                    <h3>Widget Details</h3>
                    <p>Site: <?php echo $mySite->name; ?> </p>
                    <p>Platform: <?php echo $mySite->platform; ?> </p>
                    <?php if($mySite->platform == "android") {?>
                    <strong>In order to be a Liberty Ads publisher on Android, you must install the free, open-source GreenRobot AdServer at <a href="https://github.com/greenrobotllc/adserver">https://github.com/greenrobotllc/adserver</a>. Once you have setup your adserver instance, use the following code in your apps to intelligently optimize your earnings.</strong>
                    <?php } ?>

                    <?php if($mySite->platform == "android") {?>
                    <h3>Initialization Code</h3>
                    <p>Use this code in your Application class.</p>
                    <textarea style='width:600px; height:300px'>
GreenRobotAds.initialize(this, "https://myadserver3.greenrobot.com/getadmobile/2");

                    </textarea>

                    <?php } 
                   // echo $mySite->platform; 
                    ?>


                    <h3>Widget Code</h3>
                    <p>Use this code where you want to install your ad view</p>

                    <textarea style='width:600px; height:300px'><?php if($mySite->platform == "android") {?>GreenRobotAdView adView = (GreenRobotAdView) findViewById(R.id.gr_adview);
                        adView.setAdUnitId("<?php echo $widget->id; ?>");


                        <?php
                    }

                    else if($mySite->platform == "ios") {
                        ?>
#import "GreenRobotAdView.h"
@property (nonatomic, retain) GreenRobotAdView *adView;

if(!self.adView) {
    self.adView = [[GreenRobotAdView alloc] initWithRootViewController:self withWidgetID:@"<?php echo $widget->id; ?>"];
}<?php
                    }
                    else if($mySite->platform == "web") {
                        ?><iframe width="728px" height="90px" scrolling="no"   frameBorder="0" src="{{ $protocol}}{{Request::getHost()}}/ads/randomad?wid={{ $widget->id }}"></iframe><?php
                    }
                    ?></textarea>

                <h3>Widget Preview</h3>
                <iframe width="728px" height="90px"  scrolling="no" frameBorder="0" src="{{ $protocol}}{{Request::getHost()}}/ads/randomad?wid={{ $widget->id }}"></iframe>

            </div>
        </div>
    </div>
</div>
</div>


<!--     {!! var_dump($widget) !!}
-->



@stop
