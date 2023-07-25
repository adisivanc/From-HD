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


<script type="text/javascript">

var closeBtn = $('<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>').button();

// text you get from Ajax
var content = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing. Morbi convallis sem et dui sollicitudin tincidunt.</p>";

// Popup body - set width is optional - append button and Ajax msg
var popup = $("<div/>", {
    "data-role": "popup"
}).css({
    "width": "150px"
}).append(closeBtn).append(content);

// Append it to active page
$(".ui-page-active").append(popup);

// Create it and add listener to delete it once it's closed
// add listener to change its' position if you want
$("[data-role=popup]").on("popupafterclose", function () {
    $(this).remove();
}).on("popupafteropen", function () {
    $(this).popup("reposition", {
        "positionTo": "window"
        /* or set custom position */
        x: 150,
        y: 200
    });
// enhance popup and open it
}).popup().popup("open");

</script>



</body>
</html>