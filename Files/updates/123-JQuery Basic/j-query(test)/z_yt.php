<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style>

#slideshow { margin: 50px auto;  position: relative;  width: 240px;  height: 240px;  padding: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.4);  }
#slideshow > div { position: absolute; top: 10px; left: 10px; right: 10px; bottom: 10px; }

</style>



</head>
<body>



<div id="slideshow">
   <div>
     <img src="//farm6.static.flickr.com/5224/5658667829_2bb7d42a9c_m.jpg">
   </div>
   <div>
     <img src="//farm6.static.flickr.com/5230/5638093881_a791e4f819_m.jpg">
   </div>
   <div>
     Pretty cool eh? This slide is proof the content can be anything.
   </div>
</div> 
 
<script type="text/javascript">

$("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow');
},  3000);

</script>

</body>
</html>