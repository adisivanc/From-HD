<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>jQuery UI Accordion Example </title>
      <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <script>
         $(function() {
            $( "#accordion-1" ).accordion(
				{ active: 1 , animate: "bounceslide"  }
				
			);
         });
      </script>
      <style>
         #accordion-1{font-size: 14px;}
      </style>
   </head>
<body>
   <div id="accordion-1">
      <h3>Tab 1</h3>
   <div>
      <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
         sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
         Ut enim ad minim veniam, quis nostrud exercitation ullamco 
         laboris nisi ut aliquip ex ea commodo consequat. 
      </p>
   </div>
   <h3>Tab 2</h3>
   <div>
      <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
         sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
         Ut enim ad minim veniam, quis nostrud exercitation ullamco 
         laboris nisi ut aliquip ex ea commodo consequat.     
      </p>
   </div>
   <h3>Tab 3</h3>
   <div>
      <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
         sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
         Ut enim ad minim veniam, quis nostrud exercitation ullamco 
         laboris nisi ut aliquip ex ea commodo consequat.     
      </p>
      
   </div>
   </div>

</body>
</html>