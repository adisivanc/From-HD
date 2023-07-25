<!DOCTYPE html>
<html>
<head>
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

<body>
    <div data-role="page" id="home">
        <div data-role="content">
            <p><a href="#menu-items" data-role="button" data-rel="popup" data-inline="true">Open Popup</a></p>
            <p><a href="#menu-items" data-role="button" data-rel="dialog" data-transition="pop">Open Popup(dialog)</a></p>
        </div>
    </div>
    <div id="menu-items" data-role="popup">
        <ul data-role="listview">
            <li><a href="http://www.google.com">google.com</a></li>
            <li><a href="http://www.google.com">google.com</a></li>
        </ul>
    </div>
</body>
</html>