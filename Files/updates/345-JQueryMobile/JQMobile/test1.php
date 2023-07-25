<!DOCTYPE html>
<html>
<head>
  <!-- Include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Include jQuery Mobile stylesheets -->
  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.css">
  <!-- Include the jQuery library -->
  <script src="js/jquery.js"></script>
  <!-- Include the jQuery Mobile library -->
  <script src="js/jquery.mobile-1.4.js"></script>
</head>


<body>

<div data-role="page" id="pageone">
  <div data-role="header">
  	<h1>Welcome To My Homepage</h1>
  </div>

  <div data-role="main" class="ui-content">
  	<p>Welcome!</p>
  </div>

  <div data-role="footer">
  	<h1>Footer Text</h1>
  </div>
  
    <a href="#pagetwo" class="ui-btn">Anchor</a>
    <button class="ui-btn" style=" background:#cccccc;">Button</button>
  
</div> 



<div data-role="page" id="pagetwo">
  <div data-role="header">
  	<h1>Welcome To My Page2</h1>
  </div>

  <div data-role="main" class="ui-content">
  	<p>Welcome!</p>
  </div>

  <div data-role="footer">
  	<h1>Footer Text</h1>
  </div>
</div> 


</body>



</html>
