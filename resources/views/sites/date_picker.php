

<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<script type="text/javascript">
$(function() {

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  //$('#daterange').val('');
    //alert(picker.startDate);
    //alert(picker.endDate);
    window.location="?start=" + picker.startDate.format('Y-MM-DD') + "&end=" + picker.endDate.format('Y-MM-DD') ;

});

    //var start = moment().subtract(29, 'days');
    //var end = moment();


           <?php

        if(isset($_REQUEST['start'])) {
            //echo("WTF");
        $start = $_REQUEST['start']; ?>
           var mydate = new Date("<?php echo $start; ?> EDT");
            //mydate.setDate(mydate.getDate() + 1);
            var day = mydate.getDate();
            var monthIndex = mydate.getMonth() + 1;
            var year = mydate.getFullYear();


          <?php echo("var start="); ?>  monthIndex + '/' + day + '/' + year;

                   //alert(start);
          <?php
        }
        else {
         //echo("OKGOOD");
         echo("var start = moment(); ");
        

        }

?>

<?php

        if(isset($_REQUEST['end'])) {
        $end = $_REQUEST['end']; ?>
            var mydate = new Date("<?php echo $end; ?> EDT");
            //mydate.setDate(mydate.getDate() + 1);
            var day = mydate.getDate();
            var monthIndex = mydate.getMonth() + 1;
            var year = mydate.getFullYear();


          <?php echo("var end="); ?>  monthIndex + '/' + day + '/' + year;
          //alert(end);
          <?php
        }
        else {
         
         echo("var end = moment();\n");
        

        }
        ?>




    function cb(start, end) {
    if(typeof(start) != "object") {
        $('#daterange span').html(start + ' - ' + end);

      }
      else {
    
      }
    }


    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});
</script>


<script>



$('input[name="daterange"]').daterangepicker();






           <?php

        if(isset($_REQUEST['start'])) {
            //echo("WTF");
        $start = $_REQUEST['start']; ?>
           var mydate = new Date("<?php echo $start; ?> EDT");
            //mydate.setDate(mydate.getDate() + 1);
            var day = mydate.getDate();
            var monthIndex = mydate.getMonth() + 1;
            var year = mydate.getFullYear();


          <?php echo("var start="); ?>  monthIndex + '/' + day + '/' + year;

                   //alert(start);
          <?php
        }
        else {
         //echo("OKGOOD");
         echo("var start = moment().startOf('month');\n");
        

        }

?>

<?php

        if(isset($_REQUEST['end'])) {
        $end = $_REQUEST['end']; ?>
            var mydate = new Date("<?php echo $end; ?> EDT");
            //mydate.setDate(mydate.getDate() + 1);
            var day = mydate.getDate();
            var monthIndex = mydate.getMonth() + 1;
            var year = mydate.getFullYear();


          <?php echo("var end="); ?>  monthIndex + '/' + day + '/' + year;
          //alert(end);
          <?php
        }
        else {
          
         echo("var end = moment().endOf('month');\n");
        

        }
        ?>
        

   
 

</script>

