<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<style type="text/css">
ul { list-style: none; width:200px; float:left; margin:0; padding:0; margin-left:30px; }
ul li { background-color:#09F; padding:5px 15px;  margin-right:10px; display: inline; cursor: pointer; transition:all ease-in 0.2s; }
ul li:hover { background-color:#FFF; }
#rating { width:150px; float:left; margin-top:7px; font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight: bold; }
#noRating { width:30px; height:25px; line-height:25px; text-align:center; font-size:36px; float:left; background:#F00; cursor: pointer; margin:0; padding:0; }
</style>
</head>

<body bgcolor="#ccc">
<div id="noRating" title="No Rating"> - </div>
<ul>
	<li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>

<div id="rating">Rating: &nbsp;<span></span></div>


    
<script type="text/javascript">


$('li').mouseover(function(){  // $('span').text($('li').index(this)+1);   
});

$('li').click(function(){
	
	var rat = $('li').index(this);
	var len = $('li').length;
	
	for(i=0; i<len; i++){
		if(i<=rat)
		$('li').eq(i).css('background-color','#FFFFFF');
		else
		$('li').eq(i).css('background-color','#09F');
	}
	
	$('span').text(rat+1);
	
});
	
$('#noRating').click(function(){   $('li').css('background-color','#09F'); $('span').text(0);   });	
	


</script>



</body>
</html>