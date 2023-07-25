<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hover Effects</title>

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>


<style type="text/css">

body { background-color:#a0a0a0; }

#container { width:1300px; margin:50px auto; border:2px dashed #333; height:630px; }
#row1 { width:1300px; float:left; padding:15px; }
/*.row1_img { width:400px; height:300px; float:left; border:5px solid #333; margin-right:20px; cursor: pointer; position:relative; float:left; z-index:99; }
.row1_bg { background: #333; opacity:0.6; width:400px; height:300px; position:relative; float:left; z-index:100; margin:0; padding:0;  }
*/

.row1_img {
    padding: 7px;
    background: #f6f6f6;
    -webkit-box-shadow:  0px 0px 3px 1px rgba(0, 0, 0, 0.15);
    box-shadow:  0px 0px 3px 1px rgba(0, 0, 0, 0.15);
    float: left;
    margin-right: 15px;
}


.row1_bg {
    position: relative;
    overflow: hidden;
}


.block_2 .hover_info { background: rgba(0, 0, 0, 0.8); top: -100%;  transition: top 200ms linear; -webkit-transition: top 200ms linear; -moz-transition: top 200ms linear; }
.block_2:hover .hover_info { top: 0; }


.hover_info {
    width: 400px;
    height: 300px;
    position: absolute;
    top: 0;
    left: 0;
}

.mover_info {
    width: 400px;
    height: 280px;
	background: rgb(0, 0, 0);
	background: rgba(0, 0, 0, 0.8);
    position: absolute;
    top: 0;
    left: 0;
	color:#FFF;
	font-size:14px;
	padding:10px 0 10px 0;
	display: none;
	font-family:Georgia, "Times New Roman", Times, serif;
	filter:alpha(opacity=80);
}



/*.block_holder {
    padding: 7px;
    background: #f6f6f6;
    -webkit-box-shadow:  0px 0px 3px 1px rgba(0, 0, 0, 0.15);
    box-shadow:  0px 0px 3px 1px rgba(0, 0, 0, 0.15);
    float: left;
    margin: 15px;
}


.hover_block {
    position: relative;
    overflow: hidden;
}


.block_2 .hover_info { background: rgba(0, 0, 0, 0.8); top: -100%;  transition: top 200ms linear; -webkit-transition: top 200ms linear; -moz-transition: top 200ms linear; }
.block_2:hover .hover_info { top: 0; }


.hover_info {
    width: 350px;
    height: 250px;
    position: absolute;
    top: 0;
    left: 0;
}
*/



</style>

</head>

<body>

<div id="container">

<div id="row1">

    <div class="row1_img">
        <div class="row1_bg block_2">
        	<img src="images/Cartoon.jpg" border="0" />
            <div class="hover_info">
            	<div style="height:50px; line-height:50px; padding:0 10px; color:#fff; background:#09F;">Information</div>
            
            </div>
        </div>

    </div>
    
    <div class="row1_img" id="img2">
        <div class="row1_bg">
        	<img src="images/mickey.jpg" border="0" />
            <div class="mover_info">
            <div id="in2" style="height:auto; width:370px; float:left; line-height:30px; padding:0 7px; color:#fff; background:#09F; position:relative; left:-100%; ">
            jQuery animate function is very powerful API to manipulate html elements and add animation functionality.</div>
            
            <div id="in2_desc" style="float:left; margin:15px 0 5px 0; padding:20px 15px; text-align: justify; font-size:14px; font-family:Arial; font-weight: bold; line-height:22px; display: none;">
            Query animate function is very powerful API to manipulate html elements and add animation functionality. The use of animate function is very simple. Write less, Domore.
            </div>               
            
            <div id="in2_1" style="height:auto; width:370px;margin-top:10px;float:right;line-height:30px; padding:0 7px; color:#fff; background:#09F; position:relative; right:-100%;">
            jQuery animate function is very powerful API to manipulate html elements and add animation functionality.</div>
            </div>
        </div>

    </div>
    
    <div class="row1_img">
        <div class="row1_bg"><img src="images/Cartoon1.jpg" border="0" />
            <div></div>
        </div>
    </div>

</div>


</div>

<script type="text/javascript">


$('#img2').mouseenter(function(){
	  $('.mover_info').slideDown(250, function(){ $('#in2').animate({"left":"0"},200,function(){ $('#in2_desc').fadeIn(500, function(){ $('#in2_1').animate({"right":"0"},200); });  });  }); });
	  
	  
$('#img2').mouseleave(function(){  
	$('.mover_info').hide("explode", {pieces: 40 }, 500, function(){ $('#in2').css({"left":"-100%"}); 	$('#in2_1').css({"right":"-100%"});  $('#in2_desc').css('display','none');	}); 
});

</script>
</body>
</html>