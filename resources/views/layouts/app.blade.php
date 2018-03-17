<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>






<title>{{ config('app.name', 'Liberty Ad Network') }}</title>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />







<!-- Scripts -->
<script>
  window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    ]) !!};
  </script>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">





        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
          <?php if(Auth::check()) { ?>
          <div >
            <ul class="nav nav-tabs" style="float:right">
              <li role="presentation" class="{{ isActiveURL('/home') }}">
                <a href="/home">HOME</a>
              </li>
              <li role="presentation" class="{{ isActiveURL('/campaigns') }}">
                <a href="{{ url('/campaigns') }}">ADVERTISER CAMPAIGNS</a>
              </li>
              <li role="presentation"  class="{{ isActiveURL('/sites') }}">
                <a href="{{ url('/sites') }}">PUBLISHER SITES / APPS</a>
              </li>
              <li role="presentation"  class="{{ isActiveURL('/account') }}">
                <a href="{{ url('/account') }}">ACCOUNT</a>
              </li>
              <?php if(Auth::id() == env('ADMIN_ID', 'ADMIN_ID')) { 
              ?>
              <li role="presentation"  class="{{ isActiveURL('/admin') }}">
                <a href="{{ url('/admin') }}">ADMIN</a>
              </li>

              <?php
              }
              ?>

              @if(isActiveURL('/campaigns/create', true))
              <li role="presentation"  class="{{ isActiveURL('/campaigns/create') }}">
                <a href="{{ url('/campaigns/create') }}">CREATE CAMPAIGN</a>
              </li>
              @endif

               @if(isActiveURL('/widget/create', true))
              <li role="presentation"  class="{{ isActiveURL('/widget/create') }}">
                <a href="{{ url('/campaigns/create') }}">CREATE WIDGET</a>
              </li>
              @endif

              @if(isActiveURL('/sites/create', true))
              <li role="presentation"  class="{{ isActiveURL('/sites/create') }}">
                <a href="{{ url('/sites/create') }}">ADD SITE OR APP</a>
              </li>
              @endif

     <!--         @if(isActiveRoute('campaigns.show', true))
             
              <li role="presentation"  class="{{ isActiveRoute('campaigns.show') }}">
                <a href="#">CAMPAIGN DETAILS</a>
              </li>
              @endif -->


             @if(isActiveRoute('sites.show', true))
             
              <li role="presentation"  class="{{ isActiveRoute('sites.show') }}">
                <a href="#">SITE/APP PERFORMANCE</a>
              </li>
              @endif



             @if(isActiveRoute('ads.show', true))
             
              <li role="presentation"  class="{{ isActiveRoute('ads.show') }}">
                <a href="#">AD DETAIL</a>
              </li>
              @endif


            @if(isActiveRoute('widgets.show', true))
             
              <li role="presentation"  class="{{ isActiveRoute('widgets.show') }}">
                <a href="#">WIDGET DETAILS</a>
              </li>
              @endif



             @if(isActiveRoute('campaigns.show', true))
              <li role="presentation"  class="{{ isActiveRoute('campaigns.show') }}">
                <a href="#">CAMPAIGN PERFORMANCE</a>
              </li>
              @endif

              @if(isActiveRoute('campaign_content', true))
              <li role="presentation"  class="{{ isActiveRoute('campaign_content') }}">
                <a href="#">CAMPAIGN CONTENT</a>
              </li>
              @endif

             @if(isActiveRoute('campaign_settings', true))
              <li role="presentation"  class="{{ isActiveRoute('campaign_settings') }}">
                <a href="#">CAMPAIGN SETTINGS</a>
              </li>
              @endif


              @if(isActiveRoute('site_content', true))
              <li role="presentation"  class="{{ isActiveRoute('site_content') }}">
                <a href="#">SITE CONTENT</a>
              </li>
              @endif

             @if(isActiveRoute('site_settings', true))
              <li role="presentation"  class="{{ isActiveRoute('site_settings') }}">
                <a href="#">SITE SETTINGS</a>
              </li>
              @endif


             @if(isActiveRoute('ads.create', true))
             
              <li role="presentation"  class="{{ isActiveRoute('ads.create') }}">
                <a href="#">CREATE AD</a>
              </li>
              @endif
			  
              @if(isActiveRoute('site_targeting', true))
             
               <li role="presentation"  class="{{ isActiveRoute('site_targeting') }}">
                 <a href="#">SITE TARGETING</a>
               </li>
               @endif

                @if(isActiveRoute('campaign_targeting', true))
             
               <li role="presentation"  class="{{ isActiveRoute('campaign_targeting') }}">
                 <a href="#">CAMPAIGN TARGETING</a>
               </li>
               @endif

            </ul>

          </div>
          <?php

          }
          ?>







        </div>




        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            &nbsp;
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
<center>
<div>

@if(Auth::check())
<?php if($advertiser_balance <= 0) { 
  echo "<p>Low Account Balance. <a href='/account'>Deposit funds</a> to continue advertising.";
}
?>

<p>
Advertiser Balance: ${{ $advertiser_balance }} | 
Publisher Balance: ${{ money_format("%i", $publisher_balance * .7) }}
</p>

@endif


</div>
</center>
  @yield('content')
</div>

<style type="text/css">
  #footer {   
position:fixed;
   left:0px;
   bottom:0px;
   height:30px;
   width:100%;
}

/* IE 6 */
* html #footer {
   position:absolute;
   top:expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
}

</style>
<br>&nbsp;<br>&nbsp;

                <center>
                <div class="footer" id="footer" style='padding:5px; background-color:#f8f8f8; border-width: 1px; border-color: #e7e7e7; border-style: solid;' >
                    <a href="https://greenrobot.com/support">Support</a> &nbsp; | &nbsp; 
                    <a href="https://greenrobot.com/contact">Contact Us</a> &nbsp; | &nbsp; 
                    <a href="https://medium.com/@greenrobotllc">Blog</a> &nbsp; | &nbsp; 
                    <a href="https://greenrobot.com/dmca">DMCA</a> &nbsp; | &nbsp; 
                    <a href="https://greenrobot.com/privacy">Privacy</a> &nbsp; | &nbsp; 
                    <a href="https://greenrobot.com/terms">Terms</a>
                </div>
                </center>


</body>
</html>