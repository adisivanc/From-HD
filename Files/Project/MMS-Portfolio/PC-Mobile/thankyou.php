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
                
                    <div class="full_width padtb3 lineht1_6 choosetravel_row1">
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="txtcenter txtblue1 txtsemibold f18 border_btmblue lineht2">Thanks for Riding Private Car</td>
                          </tr>
                          <tr>
                            <td class="txtcenter padtop5">Your booking confirmation has been sent to your email address kavitharjn@gmail.com. In case of any queries , please call our toll free number 844-646-1045</td>
                          </tr>
                        </table>
                        
                    </div>
                    
                    
                    <div class="full_width lineht2 bggray margintop">
						<table width="96%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="txtblue1 tbl">
                          <tr>
                            <td width="35%">Reservation #</td>
                            <td width="70%" class="txtsemibold">904</td>
                          </tr>
                          <tr>
                            <td>Billed To</td>
                            <td class="txtsemibold">Kavitha Rajan</td>
                          </tr>
                        </table>
                    </div>
                    
                    
                    <div class="full_width lineht2 choosetravel_row1 margintop" id="bgsblue">
                        
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
                    
                    
                    
                    
                    
                    <div class="full_width lineht2 bggray margintop">

						<table width="98%" border="0" cellspacing="0" cellpadding="0" class="tbl" style="margin:0 auto;">
                          <tr>
                            <td width="50%">FARE DETAILS</td>
                            <td class="txtright txtblue txtsemibold f18">Private Shuttle Van</td>
                          </tr>
                          <tr>
                            <td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="txtright">
                                  <tr>
                                    <td width="60%" >Fare Amount : </td>
                                    <td><span class="marginright10">85.00</span> </td>
                                  </tr>
                                  <tr>
                                    <td>Surchage Fee :</td>
                                    <td><span class="marginright10">15.00</span></td>
                                  </tr>
                                  <tr>
                                    <td>Gratuity :</td>
                                    <td><span class="marginright10">8.50</span></td>
                                  </tr>
                                  <tr>
                                    <td class="bgblue notxtshadow txtsemibold" id="txtwhite">Total Fare :</td>
                                    <td class="bgblue notxtshadow txtsemibold" id="txtwhite"><span class="marginright10">108.50</span></td>
                                  </tr>
                                </table>
                            </td>
                            <td class="txtright"><img src="images/10.jpg" alt="" class="border_gray1 marginright10" /></td>
                          </tr>
                        </table>

                    </div>
                    
                    
                    
                    
                
                </div>    <!-- Payment Content -->
                
        </div>     <!-- Main Content -->
        
        
      <div data-role="footer" style="position:relative; top:50px;">
        <div class="full_width_pad padtb10" style="background:#777777; position:absolute; bottom:-31px; ">
            <div id="txtwhite" class="pull_left" style="font-weight:300;"><span style="text-shadow:none; font-weight:lighter">Toll-Free</span> 844-646-1405</div>
            <div id="txtwhite" class="pull_right" style="text-shadow:none; font-weight:lighter">reservations@privatecarapp.com</div>
        </div>
      </div>
      
      
    </div>
    
    
</body>
</html>








