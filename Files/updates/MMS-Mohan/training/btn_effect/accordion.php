<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    
    <script type="text/javascript" src="js/default.js"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>

<style type="text/css">


#container { width:960px; margin:0 auto; }
#content { width:960px; float:left; }

#accordion { width:960px; float:left; }

#accordion div{ 	
	width:250px; 
	height:50px; 
	float:left;
}


#accordion div > div { 

	background:#333; 
	border:1px solid #ccc; 
	line-height:50px;
	cursor: pointer; 
	padding:10px 10px 10px 30px; 
	font-size:14px; 
	color:#FFF; 
	font-family:Georgia, serif; 
	font-weight: bold;
	text-align:center; 
	transition: all 0.5s; 
	
	-webkit-transform: rotate(270deg);
	-moz-transform: rotate(270deg);
	-o-transform: rotate(270deg);
	writing-mode: bt-rl;

}

#accordion div > div:hover { background:#666; color:#000; border:1px solid #333; }

</style>


</head>
<body bgcolor="#e0e0e0">


<div id="container">

<div id="content">

<div id="accordion">
    <div><div>DUMMY TEXT 1</div></div>
    <div><div>DUMMY TEXT 2</div></div>
    <div><div>DUMMY TEXT 3</div></div>
    <div><div>DUMMY TEXT 4</div></div>
    <div><div>DUMMY TEXT 5</div></div>
    <div><div>DUMMY TEXT 6</div></div>
</div>

</div>


</div>


</body>
</html>