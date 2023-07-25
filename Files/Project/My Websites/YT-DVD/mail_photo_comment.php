<table width="640" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-size:16px; color:#000000;">
  <tr>
    <td align="center" ><a href="#"><img src="images/mail_header.jpg" border="0" /></a></td>
  </tr>
  <tr>
    <td align="justify" style="padding:10px;" colspan="2">
        <p>Dear <?=$rs_event->contact_person?>,</p>
    	<p>New comment has been submitted for the event of <?=$rs_event->event_name?></p>
        <table width="70%" border="0" cellspacing="0" cellpadding="5" align="center" style="border:2px solid #32A9D4;">
          <tr>
            <td align="right" width="22%" valign="top"><b>Name</b> </td>
            <td width="3%" align="center" valign="top">:</td>
            <td width="75%" valign="top"><span><?=$rs_comment->name?></span></td>
          </tr>
          <tr>
            <td align="right" width="22%" valign="top"><b>Email</b> </td>
            <td width="3%" align="center" valign="top">:</td>
            <td width="75%" valign="top"><span><?=$rs_comment->email?></span></td>
          </tr>
          <tr>
            <td align="right" width="22%" valign="top"><b>Message</b> </td>
            <td width="3%" align="center" valign="top">:</td>
            <td width="75%" valign="top"><span><?=$rs_comment->comments?></span></td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="background-color:#6d6d6d; padding:10px;"><a href="http://www.yellowtrainschool.com/" style="color:#ffffff; text-decoration:none;">Copyright &copy; 2015, yellowtrainschool.com</a></td>
  </tr>
</table>
