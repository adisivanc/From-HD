<?

$modulesArr=array(); $termsArr=array(); $headerArr=array(); $welcomeArr=array(); $highlightArr=array();

if($_POST['ns_submit_action_type']=="P") {
	//echo "<pre>"; print_r($_POST); echo "</pre>";
	/*$ns_type = $_POST['ns_type'];
	$ns_date = $_POST['ns_date'];
	$title = $_POST['ns_title'];
	$subject = $_POST['ns_subject'];
	$header_type = $_POST['ns_header_type'];

	$welcome_note = $_POST['welcome_note'];
	$welcome_text = $_POST['welcome_text'];
	$no_of_inner_image = $_POST['inner_image_types'];
	
	$welcome_description = $_POST['welcome_description'];
	$is_highlight_text = $_POST['highlight_text'];
	
	$term_calender = $_POST['term_calender_position'];

	$conclusion_text = $_POST['conclusion_text'];
	$regards_text = $_POST['regards_text'];
	$regards_from_text = $_POST['regards_from_text'];*/
	include "includes.php";
	$rs_circular = Circulars::getCircularById($_POST['newsletter_db_id']);
	if($rs_circular->id>0) foreach($rs_circular as $K=>$V) $$K = $V;
	
	$headerArr = unserialize($rs_circular->header_details);
	$welcomeArr = unserialize($rs_circular->inner_images);
	if($rs_circular->is_highlight_text=="Y") $highlightArr = unserialize($rs_circular->highlight_text_details);
	$modulesArr = unserialize($rs_circular->modules);
	$termsArr = unserialize($rs_circular->term_calender_details);
	
	
} else {
	if($rs_circular->id>0) foreach($rs_circular as $K=>$V) $$K = $V;
	
	if($rs_circular->id>0) {
		$modulesArr = unserialize($rs_circular->modules);
		$termsArr = unserialize($rs_circular->term_calender_details);
		if($rs_circular->is_highlight_text=="Y") $highlightArr = unserialize($rs_circular->highlight_text_details);
		$headerArr = unserialize($rs_circular->header_details);
		$welcomeArr = unserialize($rs_circular->inner_images);
	}
	
}

$key = "rEgIsTrAtIoN";
$rs_Link = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $id, MCRYPT_MODE_CBC, md5(md5($key))));

$logoAdminPath = BASE_ADMIN_URL;
$urlPath = BASE_URL;
?>

<table border="0" cellpadding="0" cellspacing="0" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#333333; margin:0 auto; padding:0;" width="860">
	<tbody>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#333333; margin:0 auto; padding:0; border:10px solid #666666; background:#fcf4df;" width="800">
					<tbody>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="800" style="box-shadow:1px 1px 4px #666666; -moz-box-shadow:1px 1px 4px #666666; -webkit-box-shadow:1px 1px 4px #666666;">
									<tbody>
										<tr>
											<td>
												<a href="<?=$urlPath?>"><img alt="Yellow Train School" border="0" src="<?=$logoAdminPath?>/newsletter/images/logo.jpg" /></a></td>
											<td>
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="height:66px;" valign="top"><img alt="Yellow Train School" border="0" src="<?=$logoAdminPath?>/newsletter/images/header1.jpg" /></td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
                        <? if($header_type!="N" && $header_type!="") { ?>
						<tr>
							<td>
                            <? if($header_type=="I" && $headerArr['Img']!="") { ?>
								<img alt="<?=$title?>" title="<?=$title?>" border="0" src="<?=NEWSLETTER_HEADER_HREF.$headerArr['Img']?>" />
							<? } ?>
                            <? if($header_type=="T") { ?>
                            	<? if($headerArr['Headline1']!="") { ?>
								<div style="color:#32a9d4; font-size:32px; text-transform:uppercase; margin:0; text-align:center; padding:15px 0 5px 0;"><?=stripslashes($headerArr['Headline1'])?></div>
                                <? } ?>
                                <? if($headerArr['Headline2']!="") { ?>
                                <div style="font-size:28px; text-transform:uppercase; margin:0; text-align:center; padding:15px 0 5px 0;"><?=stripslashes($headerArr['Headline2'])?></div>
                                <? } ?>
                                <? if($headerArr['HeadlineDesc']!="") { ?>
                                <div style="padding:15px 28px; text-align:justify; margin:0; font-weight:normal; font-size:17px;"><?=stripslashes($headerArr['HeadlineDesc'])?></div>
                                <? } ?>
							<? } ?>
                            </td>
						</tr>
						<? } ?>
                        
						<tr>
							<td>
								<table width="745" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:12px 0;">
                                  <tr>
                                    <td colspan="3">
                                        <? if($welcome_note!="") { ?><div><?=$welcome_note?></div><? } ?>
                                        <? if($welcome_text!="") { ?><br /><div style="line-height:22px; text-align:justify;"><?=$welcome_text?></div> <? } ?>
                                    </td>
                                    
                                    <? if($is_highlight_text=="Y" && !empty($highlightArr) && ($ns_type=="DC")) { ?>
                                    <td rowspan="3" width="259" style="padding-left:10px;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#f2d5b5; margin:10px 0; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;">
                                      <tr>
                                        <td style="padding-left:10px;">
                                        <? 
                                        if(count($highlightArr)>0 && !empty($highlightArr)) { 
                                            foreach($highlightArr as $hk=>$hv) {
                                        ?>
                                            <div style="line-height:23px; text-align:justify; margin:0; padding:17px 0 17px 0; text-align:center; font-size:18px; border-bottom:1px solid #FFFFFF;">
                                                <? if($hv['HighlightTitle']!="") { ?><b><?=$hv['HighlightTitle']?></b><? } ?>
                                                <? if($hv['HighlightDesc']!="") { ?>
                                                <div style="padding:10px; text-align:justify; margin:0; text-align:center; font-weight:normal; font-size:14px;"><?=$hv['HighlightDesc']?></div>
												<? } ?>
                                            </div>
                                        <?
                                            }
                                        }
                                        ?>
                                        </td>
                                      </tr>
                                    </table>
                                    </td>
                                    <? } ?>

                                  </tr>
                                  <? if($no_of_inner_image!="" && $no_of_inner_image>0 && !empty($welcomeArr)) { $totalImage = $no_of_inner_image; ?>
                                  <tr>
                                  	<? foreach($welcomeArr as $ik=>$iv) { ?>
                                    <td style="padding:10px 0px;"><img src="<?=NEWSLETTER_WELCOME_HREF.$iv?>" alt="Sports Day" style="margin-right:2px;" /></td>
                                    <? } ?>
                                    
                                   <!-- <td><img src="images/sports/sportsday_img2.png" alt="Sports Day" style="margin-right:2px;" /></td>
                                    <td><img src="images/sports/sportsday_img3.png" alt="Sports Day" /></td>-->
                                  </tr>
                                  <? } ?>
                                  <? if($welcome_description!="") { ?>
                                  <tr>
                                    <td colspan="3"><div style="line-height:23px; padding:10px 0 3px 0; text-align:justify;"><?=$welcome_description?></div></td>
                                  </tr>
                                  <? } ?>
                                </table>
							</td>
						</tr>
                        
                        <tr>
                        	<td>
								<? if($is_highlight_text=="Y" && !empty($highlightArr) && ($ns_type=="P")) { ?>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#cba370; margin:10px 0;">
                                  <tr>
                                    <td>
                                    <? 
									if(count($highlightArr)>0 && !empty($highlightArr)) { 
										foreach($highlightArr as $hk=>$hv) {
									?>
                                        <div style="line-height:23px; text-align:justify; margin:0; padding:17px 0 17px 0; text-align:center; font-size:19px; border-bottom:1px solid #FFFFFF;"">
                                        	<? if($hv['HighlightTitle']!="") { ?><b><?=$hv['HighlightTitle']?></b><? } ?>
                                            <? if($hv['HighlightDesc']!="") { ?><div style="padding:15px 0 0px 0; text-align:justify; margin:0; text-align:center; font-weight:normal; font-size:17px;"><?=$hv['HighlightDesc']?></div><? } ?>
                                        </div>
                                    <?
										}
									}
									?>
                                    </td>
                                  </tr>
                                </table>
								<? } ?>
                                
                                <? if($ns_type=="TE") { ?>
                                <? if(count($modulesArr)>0 && !empty($modulesArr)) { 
									foreach($modulesArr as $mk=>$mv) {  
								?>
                                <table border="0" cellpadding="0" cellspacing="0" width="745" style="margin:0 auto;">
                                        <tbody>
                                            <? if($mv['MTitle']!="") { ?>
                                            <tr>
                                                <td>
                                                    <h2 style="color:#666666; font-size:24px; font-weight:bold; padding:20px 0 5px 0; margin:0;"><?=stripslashes($mv['MTitle'])?></h2>
                                                </td>
                                            </tr>
                                            <? } ?>
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c7c7c7; background:#f7e4ca; margin-top:20px;" width="100%">
                                                        <tbody>
                                                        	<? if($mv['MSubTitle']!="") { ?>
                                                            <tr>
                                                                <td>
                                                                    <div style="color:#ca9963; font-size:22px; text-align:center; padding:10px 10px 7px 10px; margin:0; line-height:30px;">
                                                                        <?=stripslashes($mv['MSubTitle'])?></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">
                                                                    <img border="0" src="<?=$logoAdminPath?>/newsletter/images/hr.jpg" style="width:94%; margin:0 auto;" /></td>
                                                            </tr>
															<? } ?>
                                                            <tr>
                                                                <td style="padding-bottom:10px;"> 
																<? 
																if(trim($mv['MHBoxPosition'])=="L") { $float_type1="left"; $float_type2="right"; } 
																else if(trim($mv['MHBoxPosition'])=="R") { $float_type1="right"; $float_type2="left"; }
																else { $float_type1="none"; $float_type2="none";  } 
																$div_width="94%";
																?>
                                                                    <table border="0" cellpadding="0" cellspacing="0" style=" margin:0 auto;" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td colspan="3" valign="top">
                                                                                <? if($mv['MHBoxType']=="I") { ?>
                                                                                <img alt="<?=$mv['MTitle']?>" title="<?=$mv['MTitle']?>" border="0" src="<?=NEWSLETTER_MODULE_HREF.$mv['MHBoxDetails']['Image']?>" style="float:<?=$float_type1?>; margin:15px 15px 0 20px;" />
                                                                                <? } else if($mv['MHBoxType']=="T") { $div_width = "57%"; ?>
                                                                                	<div style="width:270px; float:right; background-color:#f7e4ca; border:1px solid #cccccc; padding:10px 0 10px 0; margin:10px 10px 0 0;">
                                                                                    	<? if($mv['MHBoxDetails']['HeadLine']!="") { ?>
                                                                                        <div style="padding:0 0 10px 0; margin:0; text-align:center; font-size:20px;"><strong><?=$mv['MHBoxDetails']['HeadLine']?></strong></div> 
                                                                                        <? } ?>
                                                                                        <? if($mv['MHBoxDetails']['Desc']!="") { ?>
                                                                                        <br /><div style="line-height:20px; width:94%; padding:15px 3% 15px 3%; margin:0 0 0 0; text-align:justify;"><?=$mv['MHBoxDetails']['Desc']?></div>
                                                                                        <? } ?>
                                                                                    </div>
                                                                                <? } ?>
                                                                                	
                                                                                    <? if($mv['MDesc']!="") { ?>
                                                                                    <div style="line-height:27px; width:<?=$div_width?>; padding:15px 3% 10px 3%; margin:0 0 0 0; text-align:justify;">
                                                                                        <?=stripslashes($mv['MDesc'])?>
                                                                                    </div>
                                                                                    <? } ?>
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                  </table>
                                  <? 
									}
								  } 
								  ?>
                                  
                                  <? if(count($termsArr)>0 && !empty($termsArr) && $term_calender=="Y") { ?>
                                  <table border="0" cellpadding="0" cellspacing="0" width="745" style="margin:0 auto;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2 style="color:#666666; font-size:24px; font-weight:bold; padding:20px 0 5px 0; margin:0;">
                                                        TERM CALENDAR</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="7" cellspacing="0" style="background:#f7e4ca; border:1px solid #c7c7c7; border-collapse:collapse;" width="100%">
                                                        <tbody>
                                                        	<? foreach($termsArr as $tk=>$tv) { ?>
                                                            <tr>
                                                                <td style="border-bottom:1px solid #c7c7c7; border-right:1px solid #c7c7c7; padding:5px;" width="30%">
                                                                    <?=date("d", strtotime($tv['TDate']))?><sup><?=date("S", strtotime($tv['TDate']))?></sup>
                                                                    <?=date("F, l", strtotime($tv['TDate']))?>
                                                                </td>
                                                                <td style="border-bottom:1px solid #c7c7c7; padding:10px;" width="70%">
                                                                    <strong><?=$tv['TName']?></strong></td>
                                                            </tr>
                                                            <? }  ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <? } ?>
                                <? } ?>
                                
                            </td>
                        </tr>
						
                        <? if($conclusion_text!="") { ?>
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0" width="745" style="margin:0 auto;">
                                    <tr>
                                        <td>
                                            <p style="line-height:23px; text-align:justify; margin:0; padding:5px 0;"><?=$conclusion_text?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <? } ?>
						
                        <? if($regards_text!="" || $regards_from_text!="") { ?>
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0" width="745" style="margin:0 auto;">
                                    <tr>
                                        <td>
                                            <p style="line-height:23px; text-align:justify; margin:0; padding:23px 0 5px 0;">
											<? if($regards_text!="") { ?><br /> <?=$regards_text?>,<? } ?> 
                                            <? if($regards_from_text!="") { ?><br /> <?=$regards_from_text?>.<? } ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <? } ?>

						<tr>
							<td style="background:#cfa871;">
								<table border="0" cellpadding="0" cellspacing="0" style="color:#FFFFFF; font-size:14px; margin:0 auto; padding:17px 0;" width="745">
									<tbody>
										<tr>
											<td align="left">
												<a href="<?=$urlPath?>" style="text-decoration:none; color:#FFFFFF;">www.yellowtrainschool.com</a></td>
											<td align="right">
												Copyright 2015. All Rights Reserved</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>