<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


  <!-- Include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Include jQuery Mobile stylesheets -->
  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.css">
  <!-- My Style sheet -->
  <link rel="stylesheet" href="css/mobile.css">
  
  <!-- Include the jQuery library -->
  <script src="js/jquery.js"></script>
  <!-- Include the jQuery Mobile library -->
  <script src="js/jquery.mobile-1.4.js"></script>
   <!-- My Style sheet -->
  <script src="js/mobile.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  
</head>

<body style="padding:0; margin:0;">


    <div data-url="map-page" data-role="page" id="map-page">
        <div data-role="header" data-theme="a" style="background:#35577a;">
        <h1 style="background:#35577a;"><img src="images/pc_logo.jpg" alt="" style="width:100%; float:left; max-width:347px;" /></h1>
        </div>
        <div role="main" class="ui-content" id="map-canvas" style="position:relative; z-index:2;">
        </div>
        <form style="position:absolute; z-index:3; top:80px; left:60px;">
            <input name="textinput-s" id="textinput-s" placeholder="JFK AIRPORT, NY" value="" data-clear-btn="true" type="text">
        </form>
        

        <div data-role="main" class="ui-content">
        
        <form>
            <input name="textinput-s" id="textinput-s" placeholder="JFK AIRPORT, NY" value="" data-clear-btn="true" type="text">
        </form>
        
            <div class="width50">
                <div class="ui-input-btn ui-btn " id="bggreen">
                    <span id="txtwhite">Input</span>
                    <input data-enhanced="true" value="Enhanced" type="button" id="">
                </div>
            </div>
            <div class="width50">        
                <div class="ui-input-btn ui-btn" id="bggreen">
                    <span id="txtwhite">Button2</span>
                    <input data-enhanced="true" value="Enhanced" type="button" id="">
                </div>   
            </div>     
        </div>     
        
        
    </div>


</body>
</html>