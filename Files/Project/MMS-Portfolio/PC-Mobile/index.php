<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Private Car App</title>


  <!-- Include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Include jQuery Mobile stylesheets -->
  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.css">
  <!-- My Style sheet -->
  <link rel="stylesheet" href="css/style.css">
  
  
  
	<link rel="stylesheet" href="datepicker/jquery.mobile.datepicker.css" />
	<link rel="stylesheet" href="datepicker/jquery.mobile.datepicker.theme.css" />
  
  
  <!-- Include the jQuery library -->
  <script src="js/jquery.js"></script>
  <!-- Include the jQuery Mobile library -->
  <script src="js/jquery.mobile-1.4.js"></script>
   <!-- My Style sheet -->
  <script src="js/map.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  
  <!--Date Picker-->  
  <script src="datepicker/datepicker.js"></script>

  <script src="datepicker/jquery.mobile.datepicker.js"></script>
  <script>
	$(function(){ $( ".date-input-css" ).datepicker(); })
  </script>
  
  
</head>

<body style="padding:0; margin:0;">

    
    <div data-url="map-page" data-role="page" id="map-page">
        
        
          <div data-role="header" data-theme="a" style="background:#2585d6;">
            <div class="full_width" style="background:#2585d6; text-align:center;">
                <div style="max-width:347px; width:100%; margin:0 auto;"><img src="images/pc_logo.png" alt="" style="width:100%; float:left; padding:10px 0;" /></div>
            </div>
          </div>
        
        
        
        
        
        <div role="main" class="ui-content" id="map-canvas" style="position:relative; z-index:2;">  </div>
        <form style="position:absolute; z-index:3; top:150px; left:40px;">
            <input name="textinput-s" id="textinput-s" placeholder="JFK AIRPORT, NY" value="" data-clear-btn="true" type="text">
        </form>
        

		<div data-role="main" class="ui-content" style="background-color:#eeeeee;">
        
            <form>
                <div style="width:10%; float:left; text-align:right;"><label for="textinput-s"><div style="margin-top:15px; float:left; margin-left:10px;" class="txtsemibold">TO:</div></label></div>
                <div style="width:90%; float:left;"><input name="textinput-s" id="textinput-s" placeholder="" value="" data-clear-btn="true" type="text"></div>
            </form>
        
        	<!-- Book Now Button -->
            <div class="width50" id="booknowbtn">
                <a href="#myPopup" data-role="button" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all" id="bgred" data-position-to="window"><span id="txtwhite" class="notxtshadow">Book for Now</span></a>
                
                <div data-role="popup" id="myPopup" class="ui-content">
                    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><span class="marginright10">DATE</span></td>
                        <td><input data-role="date" type="text" /> </td>
                      </tr>
                      <tr>
                        <td><span class="marginright10">TIME</span></td>
                        <td>
                            
                                <form>
                                    <div class="time_outer">
                                    <select name="select-native-11" id="select-native-11" class="marginleft10">
                                        <option value="#">1</option>
                                        <option value="#">2</option>
                                        <option value="#">3</option>
                                    </select>
                                    </div>
                                    
                                    <div class="time_outer2 txtbold">:</div>
                                    
                                    <div class="time_outer">
                                        <select name="select-native-12" id="select-native-12" class="marginleft10">
                                            <option value="#">1</option>
                                            <option value="#">2</option>
                                            <option value="#">3</option>
                                        </select>
                                    </div>
                                    
                                    <div class="time_outer1">
                                    <fieldset data-role="controlgroup" data-type="horizontal" style="margin-left:10px;">
                                        <input name="radio-choice-1" id="radio-choice-1" value="choice-1" checked="checked" type="radio">
                                        <label for="radio-choice-1">AM</label>
                                        <input name="radio-choice-1" id="radio-choice-2" value="choice-2" type="radio">
                                        <label for="radio-choice-2">PM</label>
                                    </fieldset>
                                    </div>
                                </form>                                                       
                            
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                                <!-- Continue Button -->
                                <div id="boollaterbtn" align="center">        
                                    <a href="choose_travel.php" data-role="button" class="ui-btn ui-btn-inline ui-corner-all" id="bgred" data-position-to="window"><span id="txtwhite" class="notxtshadow">Continue</span></a>
                                </div>   
                                <!-- Continue Button -->  
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
            <!-- Book Now Button -->
            
            <!-- Book Later Button -->
            <div class="width50" id="boollaterbtn">        
                <a href="#booklater_popup" data-role="button" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all" id="bgred" data-position-to="window"><span id="txtwhite" class="notxtshadow">Book Later</span></a>
                
                <div data-role="popup" id="myPopup1" class="ui-content">
                    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>


                <div data-role="popup" id="booklater_popup" class="ui-content">
                    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><span class="marginright10">DATE</span></td>
                        <td><input data-role="date" type="text" /> </td>
                      </tr>
                      <tr>
                        <td><span class="marginright10">TIME</span></td>
                        <td>
                            
                                <form>
                                    <div class="time_outer">
                                    <select name="select-native-11" id="select-native-11" class="marginleft10">
                                        <option value="#">1</option>
                                        <option value="#">2</option>
                                        <option value="#">3</option>
                                    </select>
                                    </div>
                                    
                                    <div class="time_outer2 txtbold">:</div>
                                    
                                    <div class="time_outer">
                                        <select name="select-native-12" id="select-native-12" class="marginleft10">
                                            <option value="#">1</option>
                                            <option value="#">2</option>
                                            <option value="#">3</option>
                                        </select>
                                    </div>
                                    
                                    <div class="time_outer1">
                                    <fieldset data-role="controlgroup" data-type="horizontal" style="margin-left:10px;">
                                        <input name="radio-choice-5" id="radio-choice-5" value="choice-1" checked="checked" type="radio">
                                        <label for="radio-choice-5">AM</label>
                                        <input name="radio-choice-5" id="radio-choice-6" value="choice-2" type="radio">
                                        <label for="radio-choice-6">PM</label>
                                    </fieldset>
                                    </div>
                                </form>                                                       
                            
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                                <!-- Continue Button -->
                                <div id="boollaterbtn" align="center">        
                                    <a href="choose_travel.php" data-role="button" class="ui-btn ui-btn-inline ui-corner-all" id="bgred" data-position-to="window"><span id="txtwhite" class="notxtshadow">Continue</span></a>
                                </div>   
                                <!-- Continue Button -->  
                        </td>
                      </tr>
                    </table>
                </div>

                </div>
            </div>   
            <!-- Book Later Button -->  
              
        </div>        
        
      <div data-role="footer">
        <div class="full_width_pad padtb10" style="background:#777777; position:absolute; bottom:-31px; ">
            <div id="txtwhite" class="pull_left" style="font-weight:300;"><span style="text-shadow:none; font-weight:lighter">Toll-Free :</span> 844-646-1405</div>
            <div id="txtwhite" class="pull_right" style="text-shadow:none; font-weight:lighter">reservations@privatecarapp.com</div>
        </div>
      </div>
      
      
    </div>
    
    
</body>
</html>