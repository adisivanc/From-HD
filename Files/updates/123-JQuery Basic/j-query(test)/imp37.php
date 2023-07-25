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

		<script type="text/javascript" language="javascript">
         $(document).ready(function() {
            $("div").click(function () {
               var position = $(this).position();
               $("#lresult").html("left position: <span>" + position.left + "</span>.");
               $("#tresult").html("top position: <span>" + position.top + "</span>.");
			   $("#bresult").html("top position: <span>" + position.right + "</span>.");
            });
         });
        </script>		
	
	
      <p>Click on any square:</p>
      <span id="lresult"> </span>
      <span id="tresult"> </span>
       <span id="bresult"> </span>
		
      <div style="background-color:blue; height:50px;"></div>
      <div style="background-color:pink;height:30px;"></div>
      <div style="background-color:#123456;height:100px;"></div>
      <div style="background-color:#f11; height:75px;"></div>
      
</body>
</html>
