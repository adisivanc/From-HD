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
                
                <div class="payment_outer"><!-- Payment Content -->
                
                    <div class="full_width lineht2 choosetravel_row1" id="bgsblue">
                        
                        <div class="full_width txtcenter border_btmgray">
                            <div class="padtop5">
                                <table width="200" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                                  <tr>
                                    <td><img src="images/circle.png" alt="" /></td>
                                    <td>JFK AIRPORT, NY</td>
                                  </tr>
                                </table>
                            </div>
                            <div class="full_width">
                                <table width="180" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                                  <tr> <td colspan="2"><div style="border-left:1px solid #666666; height:15px"></div></td> </tr>
                                </table>
                            </div>
                            <div class="full_width padbtm5">
                                <table width="200" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                                  <tr>
                                    <td><img src="images/circle.png" alt="" /></td>
                                    <td>74, NEW YORK, NY</td>
                                  </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="full_width txtcenter txtblue f18">
                            <table width="340" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                              <tr>
                                <td><div class="padtop5" align="left">DATE : <span class="txtbold">12/03/2015</span></div></td>
                                <td><div class="padtop5 padbtm5" align="right">TIME : <span class="txtbold">03:30 PM</span></div></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left">DISTANCE : <span class="txtbold">35 MILES</span></td>
                              </tr>
                            </table>
                        </div>
                        
                    </div>
                    
                    
                    <div class="full_width margintop5 border_gray1" id="bggray">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="txtblue txtsemibold f18">Private Shuttle Van</td>
                            <td align="right"><button class="ui-btn ui-btn-inline fontwg1 f15" id="txtwhite" style=" padding:4px 5px; background-color:#999999;">Change Vehicle</button></td>
                          </tr>
                          <tr>
                            <td>
                            	
                                <table width="100%" border="0" cellspacing="4" cellpadding="0" class="txtcenter paytbl">
                                  <tr>
                                    <td class="border_rgtgray"><span class="txtblue">Base Fare</span> <br/> <span class="f21 txtsemibold">$20</span></td>
                                    <td><span class="txtblue">Per Mile</span> <br/> <span class="f21 txtsemibold">$3.50</span></td>
                                  </tr>
                                  <tr>
                                    <td class="border_rgtgray"><span class="txtblue">Min Fare</span> <br/> <span class="f21 txtsemibold">$85</span></td>
                                    <td><span class="txtblue">Max Size</span> <br/> <span class="f21 txtsemibold">10</span></td>
                                  </tr>
                                </table>
                            
                            </td>
                            <td align="right" class="padbtm10"><img src="images/10.jpg" alt="" class="border_gray1 marginright10" /></td>
                          </tr>
                          <tr>
                            <td class="bgblue txtright padtb10 notxtshadow txtsemibold" id="txtwhite">TOTAL FARE AMOUNT</td>
                            <td class="bgblue f28 padleft10 notxtshadow txtbold" id="txtwhite">$100</td>
                          </tr>
                        </table>
                    </div>
                    
                    
                    <div class="full_width_pad margintop5 border_gray1 bggray">
                    	<h3 class="txtblue txtsemibold">PASSENGER DETAILS </h3>
                    	<input name="textinput-s" id="customer_fname" placeholder="FIRST NAME" value="" data-clear-btn="true" type="text">
                        <input name="textinput-s" id="customer_lname" placeholder="LAST NAME" value="" data-clear-btn="true" type="text">
                        <input name="textinput-s" id="customer_phone" placeholder="CELL PHONE" value="" data-clear-btn="true" type="text">
                        <input name="textinput-s" id="customer_email" placeholder="EMAIL ADDRESS" value="" data-clear-btn="true" type="text">
                    </div>
                    
                    <div class="confirmridebtn">
                        <div class="ui-input-btn ui-btn ui-corner-all" id="bgred">
                            <span id="txtwhite">CONFIRM RIDE</span>
                            <input data-enhanced="true" value="CONFIRM RIDE" type="button" id="">
                        </div>
					</div>
                
                </div>    <!-- Payment Content -->
                
        </div>     <!-- Main Content -->
        
        
      <div data-role="footer">
        <div class="full_width_pad padtb10" style="background:#777777; position:absolute; bottom:-31px; ">
            <div id="txtwhite" class="pull_left" style="font-weight:300;"><span style="text-shadow:none; font-weight:lighter">Toll-Free</span> 844-646-1405</div>
            <div id="txtwhite" class="pull_right" style="text-shadow:none; font-weight:lighter">reservations@privatecarapp.com</div>
        </div>
      </div>
      
      
    </div>
    
    
</body>
</html>








