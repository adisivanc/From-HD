<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

<style>

div { width:60px; height:60px; margin:5px; float:left; }
#result { width:100%; float:left; }

</style>


</head>
<body>

      <p>Click on any square:</p>
      
		
      <div style="background-color:blue; font-size:15px;"></div>
      <div style="background-color:rgb(15,99,30); font-size:25px;"></div>
      <div style="background-color:#123456; font-size:45px;"></div>
      <div style="background-color:#f11; font-size:75px;"></div>
		
        <div id="result"> </div>
        
      <script type="text/javascript" language="javascript">
         $(document).ready(function() {
            $("div").click(function () {
               var color = $(this).css("background-color");
			   var size=$(this).css("font-size");
			   
               $("#result").html("That div is <span style='color:" + color + "; font-size:"+size+"'>" + color + "</span>.");
			   $("#result").css( {"color":color}, {"font-weight":bold} ); // Multiple CSS
            });
         });
      </script>

</body>
</html>
