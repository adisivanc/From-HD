<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    
    <script type="text/javascript" src="js/default.js"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>

<style type="text/css">

.btn{ 

	background:#666; 
	color:#fff; 
	padding:0px 10px; 
	border:1px solid #000; 
	cursor: pointer; 
	width:125px;  	
	-webkit-transition: all 0.3s ease-in;
	-moz-transition: all 0.3s ease-in;
	transition: all 0.3s ease-in;
	margin:50px auto;
	height:50px; 
	line-height:50px;
	font-family:Georgia, serif;
	border-radius:7px;
}

.btn:hover{  background-color:#333; }

</style>



</head>

<body bgcolor="#aaaaaa">


<div class="btn">
    <img src="img/mail-icon.png" border="0" id="im" style="margin: 12px 0px 0 0; width:30px; height:30px; vertical-align:middle; float: left;" />
    <span style="float:right;"><strong>Send Mail</strong></span>
</div>


<script type="text/javascript">

	$('.btn').click(function(){
		
		//$(this).children('img').effect('puff', 900 , function(){ $('#im').show(); });
		$('#im').addClass('box_rotate box_transition').hide('slow',function(){ $('#im').show(); });
	});

</script>

</body>
</html>












