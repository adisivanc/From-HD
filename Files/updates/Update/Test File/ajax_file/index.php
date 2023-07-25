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
    
  <script src="js/index.js"></script>
    
    
</head>
<body>
    <div data-role="page" id="login" data-theme="b">
        <div data-theme="a" data-role="header">
            <h3>Login Page</h3>
        </div>
 
        <div data-role="content">
            <form id="check-user" class="ui-body ui-body-a ui-corner-all" data-ajax="false" method="post" action="#second">
                <fieldset>
                    <div data-role="fieldcontain">
                        <label for="username">Enter your username:</label>
                        <input type="text" value="" name="username" id="username"/>
                    </div>                                 
                    <div data-role="fieldcontain">                                     
                        <label for="password">Enter your password:</label>
                        <input type="password" value="" name="password" id="password"/>
                    </div>
                    <input type="button" data-theme="b" name="submit" id="submit" value="Submit">
                </fieldset>
            </form>                             
        </div>
 
        <div data-theme="a" data-role="footer" data-position="fixed">
 
        </div>
    </div>
    <div data-role="page" id="second">
        <div data-theme="a" data-role="header">
            <h3>Welcome Page</h3>
        </div>
 
        <div data-role="content">
            Welcome
        </div>
 
        <div data-theme="a" data-role="footer" data-position="fixed">
            <h3>Page footer</h3>
        </div>
    </div>
    
    
</body>
</html>