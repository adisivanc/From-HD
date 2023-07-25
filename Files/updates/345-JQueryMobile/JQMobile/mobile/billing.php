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
  
  <!-- Include the jQuery library -->
  <script src="js/jquery.js"></script>
  <!-- Include the jQuery Mobile library -->
  <script src="js/jquery.mobile-1.4.js"></script>
   <!-- My Style sheet -->
  <script src="js/map.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  
</head>

<body style="padding:0; margin:0;">

    
    <div data-url="map-page" data-role="page" id="map-page">
        
        
          <div data-role="header" data-theme="a" style="background:#2585d6;">
            <div class="full_width" style="background:#2585d6; text-align:center;">
                <div style="max-width:347px; width:100%; margin:0 auto;"><img src="images/pc_logo.png" alt="" style="width:100%; float:left; padding:10px 0;" /></div>
            </div>
          </div>
        
        

        <div data-role="main" class="ui-content"> <!-- Main Content -->
                
                <div class="billing_outer"><!-- Billing Content -->
                
                    <div class="full_width lineht2 bggray">
                         <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="40%" class="padleft10 txtblue1 txtright">ADD GRATUITY</td>
                            <td width="60%">
                            	<div id="add_gratuity"><input name="textinput-s" id="gratuity" placeholder="" value="" data-clear-btn="true" type="text"></div>
                            </td>
                          </tr>
                        </table>
                    </div>
                    
                    <div class="full_width lineht2 bggray margintop">
                         <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="40%" class="padleft10 txtblue1 txtright">PROMOCODE</td>
                            <td width="60%">
                                    <fieldset data-role="controlgroup" data-type="horizontal" style="margin-left:10px;">
                                            <input name="radio-choice-1" id="radio-choice-1" value="choice-1" checked="checked" type="radio">
                                            <label for="radio-choice-1">Yes</label>
                                            <input name="radio-choice-1" id="radio-choice-2" value="choice-2" type="radio">
                                            <label for="radio-choice-2">No</label>
                                    </fieldset>
                            </td>
                          </tr>
                        </table>
                    </div>
                    
                    <div class="full_width lineht2 bggray margintop">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl txtblue1">
                          <tr>
                            <td colspan="2" class="txtblue1 txtsemibold"><span class="marginleft10">FARE DETAILS</span></td>
                          </tr>
                          <tr>
                            <td align="right" width="50%">Fare Amount :</td>
                            <td align="left" width="50%"><span class="marginleft10">$ 85.00</span></td>
                          </tr>
                          <tr>
                            <td align="right">Surchage Fee :</td>
                            <td align="left"><span class="marginleft10">$ 15.00</span></td>
                          </tr>
                          <tr>
                            <td align="right">Gratuity :</td>
                            <td align="left"><span class="marginleft10">$ 8.50</span></td>
                          </tr>
                          <tr>
                            <td align="right" class="bgblue notxtshadow txtsemibold" id="txtwhite">Total Fare :</td>
                            <td align="left" class="bgblue notxtshadow txtsemibold" id="txtwhite"><div class="marginleft10 padtb3">$ 108.50</div></td>
                          </tr>
                        </table>
                    </div>
                    
                    <div class="full_width lineht2 bggray margintop">
                         <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                          	<td colspan="2" class="txtblue1 txtsemibold">
                            	<span class="marginleft10">PAYMENT DETAILS</span>
                            </td>
                          </tr>
                          <tr>
                            <td width="20%" class="padleft10 txtblue1 txtright">Pay By:</td>
                            <td width="80%">
                                    <fieldset data-role="controlgroup" data-type="horizontal" style="margin-left:10px;">
                                            <input name="radio-choice-3" id="radio-choice-3" value="choice-3" checked="checked" type="radio">
                                            <label for="radio-choice-3">Cash/Credit to Driver</label>
                                            <input name="radio-choice-3" id="radio-choice-4" value="choice-4" type="radio">
                                            <label for="radio-choice-4">Prepay</label>
                                    </fieldset>
                            </td>
                          </tr>
                        </table>
                    </div>
                    
                    <div class="full_width margintop">
                    	<p class="txtblue1">By Clicking Book this Ride below you agree to Private Car's <span class="txtunderline">terms and conditions</span> and <span class="txtunderline">privacy policy</span>.</p>
                        <div class="confirmridebtn margintop">
                            <div class="ui-input-btn ui-btn ui-corner-all" id="bgred">
                                <span id="txtwhite">BOOK THIS RIDE</span>
                                <input data-enhanced="true" value="CONFIRM RIDE" type="button" id="">
                            </div>
                        </div>
                    </div>
                    
                
                </div>    <!-- Billing Content -->
                
        </div>     <!-- Main Content -->
        
        
      <div data-role="footer" style="position:relative; top:88px;">
        <div class="full_width_pad padtb10" style="background:#777777; position:absolute; bottom:-31px; ">
            <div id="txtwhite" class="pull_left" style="font-weight:300;"><span style="text-shadow:none; font-weight:lighter">Toll-Free</span> 844-646-1405</div>
            <div id="txtwhite" class="pull_right" style="text-shadow:none; font-weight:lighter">reservations@privatecarapp.com</div>
        </div>
      </div>
      
      
    </div>
    
    
</body>
</html>


