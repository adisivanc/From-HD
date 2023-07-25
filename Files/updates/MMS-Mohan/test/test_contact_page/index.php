<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Page</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<body>

<!-- Header -->

<div id="header">
<div class="box-mid">
	<div id="logo">COMPANY LOGO</div>
</div>
</div>


<!-- Content  -->

<div id="conatiner">
<div class="box-mid">

	<form id="contactfrm" name="contactfrm" method="post">
    <div id="contact_tbl">
    
    	<div class="tbl_row">
            <div class="tbl_td_left">Name</div>
            <div class="tbl_td_right"><input type="text" class="txtbox" id="Name" name="Name" /></div>
        </div>
    	<div class="tbl_row">
            <div class="tbl_td_left">Email Address</div>
            <div class="tbl_td_right"><input type="text" class="txtbox" id="Emailaddress" name="Emailaddress" /></div>
        </div>
    	<div class="tbl_row">
            <div class="tbl_td_left">Gender</div>
            <div class="tbl_td_right">
            	<input type="radio" id="Gender1" name="Gender" value="M" /> Male
                <input type="radio" id="Gender2" name="Gender" value="F" /> Female
            </div>
        </div>
    	<div class="tbl_row">
            <div class="tbl_td_left">City</div>
            <div class="tbl_td_right">
            	<select class="listbox" id="city" name="city">
                  <option value="">-- Select --</option>
                  <option value="Chennai">Chennai</option>
                  <option value="Coimbatore">Coimbatore</option>
                </select>
            </div>
        </div>
    	<div class="tbl_row">
            <div class="tbl_td_left">Comments</div>
            <div class="tbl_td_right"><textarea class="msgbox" id="Comments" name="Comments"></textarea></div>
        </div>
    	<div class="tbl_row">
            <div class="tbl_td_btn"><input type="button" class="submit_btn" value="Submit" /></div>
        </div>
    
    </div>
	</form>
    
</div>
</div>


<!-- Footer  -->

<div id="footer">
<div class="box-mid">
	<div id="copyright">Copyright &copy; by Mohan. All Rights Reserved.</div>
</div>
</div>


</body>
</html>