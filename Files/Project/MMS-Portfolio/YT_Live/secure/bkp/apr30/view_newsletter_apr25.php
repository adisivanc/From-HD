<?

$modulesArr=array(); $termsArr=array(); $headerArr=array(); $welcomeArr=array(); $highlightArr=array();

if($_POST['circular_action']=="P") {
	//echo "<pre>"; print_r($_POST); echo "</pre>";
	//echo "<pre>"; print_r($_FILES); echo "</pre>";
	
	include "includes.php";
	if($_POST['newsletter_db_id']!="" && $_POST['newsletter_db_id']!="undefined") {
		$rs_circular = Circulars::getCircularById($_POST['newsletter_db_id']);
		if($rs_circular->id>0) foreach($rs_circular as $K=>$V) $$K = $V;
	}
	
	$ns_type = $_POST['ns_type'];
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
	$regards_from_text = $_POST['regards_from_text'];

	// Header Array
	$vheaderArr=array();
	if($header_type=="T") {
		$vheaderArr['Headline1']=trim($_POST['ns_header_text1']);
		$vheaderArr['Headline2']=trim($_POST['ns_header_text2']);
		$vheaderArr['HeadlineDesc']=trim($_POST['ns_header_description']);
	} else if($header_type=="I") { 
		if($_FILES['ns_header_img']['size']>0) {
			$header_file_name = "Header".".".end(explode(".", $_FILES['ns_header_img']['name']));
			$header_files = SITE_TMP_DIR.$header_file_name;
			if(is_file($header_files)) { unlink($header_files); }
			move_uploaded_file($_FILES['ns_header_img']['tmp_name'], $header_files);
		} else { 
			$tmpheaderArr = unserialize($rs_circular->header_details);
			$header_file_name=$tmpheaderArr['Img'];
			
			$files = scandir(NEWSLETTER_HEADER_PATH);
			$source = NEWSLETTER_HEADER_PATH;
			$destination = SITE_TMP_DIR;
			if (in_array($header_file_name, array(".",".."))) continue;
			copy($source.$header_file_name, $destination.$header_file_name);
		}
		
		if($_FILES['ns_header_img']['name']=="" || $_FILES['ns_header_img']['name']=="undefined") $filepath_header=$_POST['h_ns_header_img']; else $filepath_header=$header_file_name;
		$vheaderArr['Img']=$filepath_header;
	}
	if(!empty($vheaderArr)) $header_details = (serialize($vheaderArr));
	
	// Highlights Array
	$vhighlightArr=array();
	$highlights = $_POST['HighlightDtl'];
	$highlight_index=0;
	if(count($highlights)>0) {
		foreach($highlights['highlight_title'] as $tk=>$tv) {
			$vhighlightArr[$tk]['HighlightTitle']=trim($highlights['highlight_title'][$highlight_index]);
			$vhighlightArr[$tk]['HighlightDesc']=trim($highlights['highlight_desc'][$highlight_index]);
		$highlight_index++;
		}
	}
	if(!empty($vhighlightArr)) $highlight_details = (serialize($vhighlightArr)); 
	
	// Inner Images Array
	$vinnerImgArr=array();
	for($i=1; $i<=$no_of_inner_image; $i++) {
		
		if($_FILES['inner_image'.$i]['size']>0) {
			$inner_file_name = "Welcome_".($i).".".end(explode(".", $_FILES['inner_image'.$i]['name']));
			$inner_files = SITE_TMP_DIR.$inner_file_name;
			if(is_file($inner_files)) { unlink($inner_files); }
			move_uploaded_file($_FILES['inner_image'.$i]['tmp_name'], $inner_files);
		} else {
			$tmpinnerArr = unserialize($rs_circular->inner_images);
			$inner_file_name=$tmpinnerArr['Img'.$i];
			
			$source_inner = NEWSLETTER_WELCOME_HREF;
			$destination_inner = SITE_TMP_DIR;
			if (in_array($inner_file_name, array(".",".."))) continue;
			copy($source_inner.$inner_file_name, $destination_inner.$inner_file_name);
		}
		
		
		if($_FILES['inner_image'.$i]['name']=="" || $_FILES['inner_image'.$i]['name']=="undefined") $filepath_inner_img=$_POST['h_inner_image'.$i]; else $filepath_inner_img=$inner_file_name;
		$vinnerImgArr['Img'.$i]=$filepath_inner_img;
	}
	if(!empty($vinnerImgArr)) $inner_images = serialize($vinnerImgArr);
	
	// Term Calender Array
	$vtermsArr=array();
	if($term_calender=="Y") {
		$terms = $_POST['TermDtl'];
		$term_index=0;
		if(count($terms)>0) {
			foreach($terms['term_calender_date'] as $tk=>$tv) {
				$vtermsArr[$tk]['TDate']=date("Y-m-d", strtotime($terms['term_calender_date'][$term_index]));
				$vtermsArr[$tk]['TName']=trim($terms['term_calender_name'][$term_index]);
			$term_index++;
			}
		}
		if(!empty($vtermsArr)) $term_calender_details = (serialize($vtermsArr));
	}
	
	// Modules Array
	$modules = $_POST['ModuleDtl'];
	$vmodulesArr=array();
	$index=0;
	if(count($modules)>0) {
		foreach($modules['module_title'] as $mk=>$mv) { 
			
			$vmodulesArr[$mk]['MTitle']=trim($modules['module_title'][$index]);
			$vmodulesArr[$mk]['MSubTitle']=trim($modules['module_sub_title'][$index]);
			$vmodulesArr[$mk]['MDesc']=trim($modules['module_description'][$index]);
			$vmodulesArr[$mk]['MHBoxType']=$modules['module_highlight_box'][$index];
			if($vmodulesArr[$mk]['MHBoxType']=="T") {
				$vmodulesArr[$mk]['MHBoxDetails']['HeadLine']=trim($modules['module_highlight_text_head'][$index]);
				$vmodulesArr[$mk]['MHBoxDetails']['Desc']=trim($modules['module_highlight_text_desc'][$index]);
				
			} else if($vmodulesArr[$mk]['MHBoxType']=="I") {
				
				if($_FILES['module_highlight_img_'.$index]['size']>0) {
					$module_file_name = "Module_".($index+1).".".end(explode(".", $_FILES['module_highlight_img_'.$index]['name']));
					$module_files = SITE_TMP_DIR.$module_file_name;
					if(is_file($module_files)) { unlink($module_files); }
					move_uploaded_file($_FILES['module_highlight_img_'.$index]['tmp_name'], $module_files);	
				} 
				else {
					$tmpmoduleArr = unserialize($rs_circular->modules); 
					$module_file_name=$tmpmoduleArr[$index]['MHBoxDetails']['Image']; 
					
					$source_module = NEWSLETTER_MODULE_HREF;
					$destination_module = SITE_TMP_DIR;
					if (in_array($module_file_name, array(".",".."))) continue;
					copy($source_module.$module_file_name, $destination_module.$module_file_name);
				}
								
				if($_FILES['module_highlight_img_'.$index]['name']!="") $filepath_modules_name=$module_file_name; else $filepath_modules_name=$_POST['h_module_highlight_img_'.$index];
				$vmodulesArr[$mk]['MHBoxDetails']['Image']=$filepath_modules_name;
			}
			if($vmodulesArr[$mk]['MHBoxType']!="N") $vmodulesArr[$mk]['MHBoxPosition']=$modules['module_highlight_box_position'][$index];
		$index++;
		}
	}
	//echo "<pre>"; print_r($vmodulesArr); echo "</pre>";  
	$modules_details = (serialize($vmodulesArr));
	
	
	//echo "<hr><pre>"; print_r($vinnerImgArr); echo "</pre>";
	
	$ns_header_path = HREF_TMP_DIR;
	$ns_welcom_path = HREF_TMP_DIR;
	$ns_module_path = HREF_TMP_DIR;

	$headerArr = unserialize($header_details);

	$welcomeArr = unserialize($inner_images);
	if($is_highlight_text=="Y") $highlightArr = unserialize($highlight_details);
	$modulesArr = unserialize($modules_details);
	$termsArr = unserialize($term_calender_details);
	//echo "<hr><pre>"; print_r($modulesArr); echo "</pre>";
	
} else {
	if($rs_circular->id>0) foreach($rs_circular as $K=>$V) $$K = $V;
	
	$ns_header_path = NEWSLETTER_HEADER_HREF;
	$ns_welcom_path = NEWSLETTER_WELCOME_HREF;
	$ns_module_path = NEWSLETTER_MODULE_HREF;
	
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
								<p style="max-width:800px;"><img alt="<?=$title?>" title="<?=$title?>" border="0" src="<?=$ns_header_path.$headerArr['Img']?>" style="width:100%; float:left; " /></p>
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
                                    <td colspan="3" width="259" style="padding-left:10px;">
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
                                  <? if($no_of_inner_image!="" && $no_of_inner_image>0 && !empty($welcomeArr)) { $totalImage = $no_of_inner_image; 
								  		if($no_of_inner_image==3) { $width_style="width:252px; margin-right:7px; margin-left:7px;"; } 
										else if($no_of_inner_image==2) { $width_style="width:382px; margin-right:7px; margin-left:7px;"; }
										else if($no_of_inner_image==1) { $width_style="width:50%; margin-right:10px; margin-left:25%;"; } 
								  ?>
                                  <tr>
                                  	<? foreach($welcomeArr as $ik=>$iv) { ?>
                                    <td style="padding:10px 0px;"><img src="<?=$ns_welcom_path.$iv?>" alt="Sports Day" style="margin-right:2px; <?=$width_style?>" /></td>
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
                                                                                <img alt="<?=$mv['MTitle']?>" title="<?=$mv['MTitle']?>" border="0" src="<?=$ns_module_path.$mv['MHBoxDetails']['Image']?>" style="float:<?=$float_type1?>; margin:15px 15px 0 20px;" />
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
						
                        <? if($conclusion_text!="" && $conclusion_text!=" ") { ?>
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
                                             <p style="line-height:23px; text-align:justify; margin:0 auto; padding:0px 0 5px 0;">
                                <? if($regards_text!="") { ?><?=$regards_text?>,<? } ?> 
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
        
        
        <? if($fileFrom=="Mail") { ?>
        <tr>
        	<td align="center"><p>Would you like to unsubscribe from this newsletter. <a href='<?=$unsubscribe_details?>' target='_blank'>Click here</a></p></td>
        </tr>
        <? } ?>
        
	</tbody>
</table>