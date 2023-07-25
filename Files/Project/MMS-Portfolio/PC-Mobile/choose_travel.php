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
        
        
        
        
        
        

        <div data-role="main" class="ui-content" style="background-color:#FFFFFF;">
        
                                <div class="choose_travel">
                                
                                    <div class="full_width lineht2 margintop5 choosetravel_row1" id="bgsblue">
                                        
                                        <div class="full_width txtcenter border_btmgray">
                                            <div class="padtop10 padbtm5">
                                                <table width="200" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                                                  <tr>
                                                    <td><img src="images/circle.png" alt="" /></td>
                                                    <td>JFK AIRPORT, NY</td>
                                                  </tr>
                                                </table>
                                            </div>
                                            <div class="full_width">
                                                <table width="180" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                                                  <tr> <td colspan="2"><div style="border-left:1px solid #666666; height:17px"></div></td> </tr>
                                                </table>
                                            </div>
                                            <div class="padbtm10 padtop5">
                                                <table width="200" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
                                                  <tr>
                                                    <td><img src="images/circle.png" alt="" /></td>
                                                    <td>74, NEW YORK, NY</td>
                                                  </tr>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <div class="full_width txtcenter txtblue">
                                            <div class="padtop5">DATE : <span class="txtbold">12/03/2015</span></div>
                                            <div class="padbtm5">TIME : <span class="txtbold">03:30 PM</span></div>
                                        </div>
                                        
                                    </div>
                                
                                    <div class="full_width margintop">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="show_fare_details" class="bggray1 border_gray cartbl cursor">
                                          <tr>
                                            <td width="70%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td colspan="3" class="txtblue txtsemibold f24 padleft10 padbtm5">Private Shuttle Van</td>
                                                  </tr>
                                                  <tr>
                                                    <td width="37%" class="txtcenter"><img src="images/9.gif" alt="" class="full_width border_gray" style="max-width:115px; margin-left:5px; margin-bottom:5px;" /></td>
                                                    <td class="txtcenter txtblue txtsemibold">Min Fare <br/> <span class="txttheme f24">$85</span></td>
                                                    <td class="txtcenter txtblue txtsemibold">Max Size <br/> <span class="txttheme f24">10</span></td>
                                                  </tr>
                                                </table>
                                            </td>
                                            <td width="30%" class="txtcenter cost_bg f36" id="txtwhite">
                                                <span class="f18">$</span>100
                                            </td>
                                          </tr>
                                        </table>
                                        
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="" class="bggray1 border_gray cartbl margintop cursor">
                                          <tr>
                                            <td width="70%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td colspan="3" class="txtblue txtsemibold f24 padleft10 padbtm5">Private Shuttle Van</td>
                                                  </tr>
                                                  <tr>
                                                    <td width="37%" class="txtcenter"><img src="images/15.jpg" alt="" class="full_width border_gray" style="max-width:115px; margin-left:5px; margin-bottom:5px;" /></td>
                                                    <td class="txtcenter txtblue txtsemibold">Min Fare <br/> <span class="txttheme f24">$85</span></td>
                                                    <td class="txtcenter txtblue txtsemibold">Max Size <br/> <span class="txttheme f24">10</span></td>
                                                  </tr>
                                                </table>
                                            </td>
                                            <td width="30%" class="txtcenter cost_bg f36" id="txtwhite">
                                                <span class="f18">$</span>100
                                            </td>
                                          </tr>
                                        </table>
                                        
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="" class="bggray1 border_gray cartbl margintop cursor">
                                          <tr>
                                            <td width="70%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td colspan="3" class="txtblue txtsemibold f24 padleft10 padbtm5">Private Shuttle Van</td>
                                                  </tr>
                                                  <tr>
                                                    <td width="37%" class="txtcenter"><img src="images/10.jpg" alt="" class="full_width border_gray" style="max-width:115px; margin-left:5px; margin-bottom:5px;" /></td>
                                                    <td class="txtcenter txtblue txtsemibold">Min Fare <br/> <span class="txttheme f24">$85</span></td>
                                                    <td class="txtcenter txtblue txtsemibold">Max Size <br/> <span class="txttheme f24">10</span></td>
                                                  </tr>
                                                </table>
                                            </td>
                                            <td width="30%" class="txtcenter cost_bg f36" id="txtwhite">
                                                <span class="f18">$</span>100
                                            </td>
                                          </tr>
                                        </table>
                                        
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="" class="bggray1 border_gray cartbl margintop cursor">
                                          <tr>
                                            <td width="70%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td colspan="3" class="txtblue txtsemibold f24 padleft10 padbtm5">Private Shuttle Van</td>
                                                  </tr>
                                                  <tr>
                                                    <td width="37%" class="txtcenter"><img src="images/14.jpg" alt="" class="full_width border_gray" style="max-width:115px; margin-left:5px; margin-bottom:5px;" /></td>
                                                    <td class="txtcenter txtblue txtsemibold">Min Fare <br/> <span class="txttheme f24">$85</span></td>
                                                    <td class="txtcenter txtblue txtsemibold">Max Size <br/> <span class="txttheme f24">10</span></td>
                                                  </tr>
                                                </table>
                                            </td>
                                            <td width="30%" class="txtcenter cost_bg f36" id="txtwhite">
                                                <span class="f18">$</span>100
                                            </td>
                                          </tr>
                                        </table>
                                        
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="" class="bggray1 border_gray cartbl margintop cursor">
                                          <tr>
                                            <td width="70%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td colspan="3" class="txtblue txtsemibold f24 padleft10 padbtm5">Private Shuttle Van</td>
                                                  </tr>
                                                  <tr>
                                                    <td width="37%" class="txtcenter"><img src="images/8.jpeg" alt="" class="full_width border_gray" style="max-width:115px; margin-left:5px; margin-bottom:5px;" /></td>
                                                    <td class="txtcenter txtblue txtsemibold">Min Fare <br/> <span class="txttheme f24">$85</span></td>
                                                    <td class="txtcenter txtblue txtsemibold">Max Size <br/> <span class="txttheme f24">10</span></td>
                                                  </tr>
                                                </table>
                                            </td>
                                            <td width="30%" class="txtcenter cost_bg f36" id="txtwhite">
                                                <span class="f18">$</span>100
                                            </td>
                                          </tr>
                                        </table>
                                    </div>
                                
                                </div>

        </div>    
        
        
      <div data-role="footer">
        <div class="full_width_pad padtb10" style="background:#777777; position:absolute; bottom:-31px; ">
            <div id="txtwhite" class="pull_left" style="font-weight:300;"><span style="text-shadow:none; font-weight:lighter">Toll-Free</span> 844-646-1405</div>
            <div id="txtwhite" class="pull_right" style="text-shadow:none; font-weight:lighter">reservations@privatecarapp.com</div>
        </div>
      </div>
      
      
    </div>
    


	<script type="text/javascript">
    
	$("#show_fare_details").click(function() {
		
	   window.location.href='payment.php';
	   
    });
	
    </script>    
    
    
    
</body>
</html>








