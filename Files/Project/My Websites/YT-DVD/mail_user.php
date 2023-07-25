<?
$sessionArr = array();
if(count($rs_etss)>0) {
	foreach($rs_etss as $sk=>$sv) {
		$sessionArr[$sv->event_date][] = $sv->event_session_id."~".$sv->session_time;
	}
}
?>
<table width="640" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-size:16px; color:#000000;">
  <tr>
    <td align="center" ><a href="#"><img src="images/mail_header.jpg" border="0" /></a></td>
  </tr>
  <tr>
    <td align="justify" style="padding:10px;" colspan="2">
        <p>Dear <?=$rs_reg->reg_name?>,</p>
    	<p>Thank You for your registration for the <?=$rs_event->event_name?></p>
        <p>Please bring a printed copy of this email  to the event for registration check in.</p>
        <p>Your Registration details:</p>
        <table width="50%" border="0" cellspacing="0" cellpadding="5" align="center" style="border:2px solid #32A9D4;">
          <tr>
            <td align="right" width="56%" valign="top">Your Registration Code</td>
            <td width="3%" align="center" valign="top">:</td>
            <td width="42%" valign="top"><span>KID<?=$rs_reg->id?></span></td>
          </tr>
          <tr>
            <td align="right" width="37%" valign="top">Name</td>
            <td width="4%" align="center" valign="top">:</td>
            <td width="59%" valign="top"><span><?=$rs_reg->reg_name?></span></td>
          </tr>
          <tr>
            <td align="right" width="37%" valign="top">Email Address</td>
            <td width="4%" align="center" valign="top">:</td>
            <td width="59%" valign="top"><span><?=$rs_reg->reg_address?></span></td>
          </tr>
          <tr>
            <td align="right" valign="top">Sessions Registered</td>
            <td align="center" valign="top">:</td>
          </tr>
          <tr>
            <td valign="top" align="center" colspan="3">
                <table border="0" cellpadding="0" cellspacing="0">
                    <? 
                    if(count($sessionArr)>0) {
                        foreach($sessionArr as $esk=>$esv) { 
                    ?>
                        <tr>
                            <th><?=date("M d, Y", strtotime($esk))?></th>
                        </tr>
                        <? if(count($esv)>0) { 
                            foreach($esv as $k1=>$v1) { $v1Arr = explode("~", $v1); $rs_event_session = EventSession::getSessionById($v1Arr[0]); ?>
                        <tr>
                            <td><?=$rs_event_session->event_session_name?> : <?=$v1Arr[1]?></td>
                        <tr>
                        <? }
                        } ?>
                    <?
                        }
                    }
                    ?>
                </table>
                
            </td>
          </tr>
          <? if($rs_reg->total_amount=="" || $rs_reg->total_amount=="0.00") { ?>
          <tr>
            <td align="right" valign="top">Total Amount to be paid</td>
            <td align="center" valign="top">:</td>
            <td valign="top">
            	<? if($rs_reg->total_amount=="" || $rs_reg->total_amount=="0.00") { echo "FREE"; } else { ?>
            		Rs. <?=$rs_reg->total_amount?>/-
                <? } ?>
            </td>
          </tr>
          <? } else { ?>
          <tr>
            <td align="right" valign="top" colspan="3">FREE REGISTRATION</td>
          </tr>
          <? } ?>
        </table>
    </td>
  </tr>
  <tr>
  	<td align="justify" style="padding:10px;" colspan="2">
    	<p>Please email us at info@yellowtrainschool.com for any questions.</p>
        <!--<p>We look forward to seeing you on the event</p>-->
    </td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="background-color:#6d6d6d; padding:10px;"><a href="http://www.yellowtrainschool.com/" style="color:#ffffff; text-decoration:none;">Copyright &copy; 2015, yellowtrainschool.com</a></td>
  </tr>
</table>
