<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style> 
div {
    width: 100px;
    height: 50px;
    background: red;
    color: white;
    font-weight: bold;
   -webkit-transition: 2s; /* Safari */
    transition: 2s;
	
    /* Shorthand Property
   
   	 transition: width 1s linear 2s;
	 1s- transition seconds
	 2s- transition delay
	 
	*/
	
}

/* For Safari 3.1 to 6.0 */
#div1 {-webkit-transition-timing-function: cubic-bezier(0,0.5,1,1);}
#div2 {-webkit-transition-timing-function: cubic-bezier(0.25,0.1,0.25,1);}
#div3 {-webkit-transition-timing-function: cubic-bezier(0.42,0,1,1);}
#div4 {-webkit-transition-timing-function: cubic-bezier(0,0,0.58,1);}
#div5 {-webkit-transition-timing-function: cubic-bezier(0.42,0,0.58,1);}

/* Standard syntax */
#div1 {transition-timing-function: cubic-bezier(0,0.5,1,1);  }
#div2 {transition-timing-function: cubic-bezier(0.25,0.1,0.25,1);}
#div3 {transition-timing-function: cubic-bezier(0.42,0,1,1);}
#div4 {transition-timing-function: cubic-bezier(0,0,0.58,1);}
#div5 {transition-timing-function: cubic-bezier(0.42,0,0.58,1);}

div:hover {
    width: 300px; transform: rotate(360deg);
}
</style>
</head>
<body>

<p><b>Note:</b> This example does not work in Internet Explorer 9 and earlier versions.</p>

<div id="div1" style="top:100px">linear</div>
<div id="div2" style="top:150px">ease</div>
<div id="div3" style="top:200px">ease-in</div>
<div id="div4" style="top:250px">ease-out</div>
<div id="div5" style="top:300px">ease-in-out</div>

<p>Hover over the div elements above, to see the different transition effects.</p>



</body>
</html>