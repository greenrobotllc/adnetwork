<body style='margin:3px; padding:3px; vertical-align: middle; background-color: white'>
     <div width:'310px'; height:'40px' style='border: 0px; vertical-align: middle; '>
     <center>
        <table border = 0>
        <tr>

       <td style='vertical-align: middle' >
        
       <center>  <a target="_blank" href="/ads/click?url={{$ad->url}}&wid={{ $wid }}&aid={{ $ad->id }}&cid={{ $ad->campaign_id }}">

       <img src="https://s3.amazonaws.com/gradnetwork/{{ $ad->image_url }}" width=30 height=30/>
       </a>
       </center>
       </td><td>
<center> 
       <a target="_blank" href="/ads/click?url={{$ad->url}}&wid={{ $wid }}&aid={{ $ad->id }}&cid={{ $ad->campaign_id }}">

       {{ $ad->headline }}
       </a>
</center>
        </td>
        </tr></table>

        </center>
        </div>
        </body>