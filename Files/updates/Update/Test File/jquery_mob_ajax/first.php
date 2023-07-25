<!DOCTYPE html>
<html>
<head>
    <title>jQM Complex Demo</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script> 
</head>
<body>


    <div data-role="page" id="first" data-theme="b">
        <div data-role="header" data-theme="a">
            <h3>Login Page</h3>
        </div>
 
        <div data-role="content">
            <form id="check-user" class="ui-body ui-body-a ui-corner-all" data-ajax="true" method="post" action="second.php">
                <fieldset>
                    <div data-role="fieldcontain">
                        <label for="username">Enter your username:</label>
                        <input type="text" value="" name="username" id="username"/>
                    </div>                                  
                    <div data-role="fieldcontain">                                      
                        <label for="password">Enter your password:</label>
                        <input type="password" value="" name="password" id="password"/> 
                    </div>
                    <input type="submit" data-theme="b" name="submit" id="submit" value="Submit">
                </fieldset>
            </form>                              
        </div>
    </div>
    
    
</body>
</html>