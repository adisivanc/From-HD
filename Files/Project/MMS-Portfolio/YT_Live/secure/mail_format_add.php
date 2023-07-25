<style>
.boxerror {border:1px solid #F00;}
.txterror {color: #F00;}
</style> 

<?
$rs_circular = Circulars::getCircularById($_REQUEST['nsId']);
$modulesArr=array(); $termsArr=array(); $headerArr=array(); $welcomeArr=array(); $highlightArr=array();
if($rs_circular->id>0) {
$modulesArr = unserialize($rs_circular->modules);
$termsArr = unserialize($rs_circular->term_calender_details);
if($rs_circular->is_highlight_text=="Y") $highlightArr = unserialize($rs_circular->highlight_text_details);
$headerArr = unserialize($rs_circular->header_details);
$welcomeArr = unserialize($rs_circular->inner_images);
}

//echo "<pre>"; print_r($highlightArr); echo "</pre>";
?>
 
<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>

<form name="circular_frm" id="circular_frm" method="post" enctype="multipart/form-data">
<input type="hidden" name="act" value="saveCircular" />
<input type="hidden" name="circular_action" id="circular_action" value="" />
<input type="hidden" name="newsletter_db_id" id="newsletter_db_id" value="<?=$rs_circular->id?>" />
<input type="hidden" name="newsletter_db_status" id="newsletter_db_status" value="<?=$rs_circular->status?>" />

<h3>Add Circular Two Column</h3>
<div class="fullsize_pad padtb10 lineht1_8">
    <? $nsTypes = $GLOBALS['CircularTypes']; ?>
    <div class="pull_left marginright20">Mail Template Type
    <select class="listbox" name="ns_type" id="ns_type" onChange="showNSOptions()">
        <option value="">Choose Type</option>
        <?
        if(count($nsTypes)>0) {
            foreach($nsTypes as $kk=>$vv) {
            ?>
            <option value="<?=$kk?>" <?=($rs_circular->ns_type==$kk || $kk=="P")?"selected":""?>><?=$vv?></option>
            <?
            }
        }
        ?>
    </select>
    </div>
    <div class="pull_right marginright20">Newsletter Date
    	<input type="text" class="txtbox datepicker" id="ns_date" name="ns_date" value="<?=($rs_circular->ns_date!="" && $rs_circular->ns_date!="0000-00-00" && $rs_circular->ns_date!="1970-01-01")?date("m/d/Y", strtotime($rs_circular->ns_date)):""?>" />
    </div>
</div>
<div class="newsletter_cntr">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="newsheadertbl border_bottom">
      <tr>
        <td width="30%" valign="top" class="txtright"><span class="marginright20">Newsletter title</span></td>
        <td width="70%"><input type="text" style="width:70%;" class="txtbox" id="ns_title" name="ns_title" value="<?=stripslashes($rs_circular->title)?>" /></td>
      </tr>
      <tr>
        <td valign="top" class="txtright"><span class="marginright20">Subject</span></td>
        <td><input type="text" style="width:70%;" class="txtbox" id="ns_subject" name="ns_subject" value="<?=stripslashes($rs_circular->subject)?>" /></td>
      </tr>
      <tr>
        <td valign="top" class="txtright"><span class="marginright20">Newsletter Header Type</span></td>
        <td>
            <input type="radio" class="" id="ns_header_type" name="ns_header_type" value="I" onclick="showHeaderOptions()" <?=($rs_circular->header_type=="I")?"checked":""?> /> Image
            <input type="radio" class=" marginleft20" id="ns_header_type" name="ns_header_type" value="T" onclick="showHeaderOptions()" <?=($rs_circular->header_type=="T")?"checked":""?> /> Text
            <input type="radio" class=" marginleft20" id="ns_header_type" name="ns_header_type" value="N" onclick="showHeaderOptions()" <?=($rs_circular->header_type=="N"  || $rs_circular->header_type=="")?"checked":""?> /> None
            
            <div class="fullsize padtb10" id="showimg_headertype"> 
                <input type="file" class="" id="ns_header_img" name="ns_header_img" value="<?=$headerArr['Img']?>" /> 
                <input type="hidden" class="" id="h_ns_header_img" name="h_ns_header_img" value="<?=$headerArr['Img']?>" />
                <?=$headerArr['Img']?>
                <span id="hs_header_img_error" class="txterror"></span>
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="padtb10" id="showtext_headertype">
              <tr>
                <td width="26%" valign="top">Head Line1</td>
                <td><input type="text" style="width:80%;" class="txtbox" id="ns_header_text1" name="ns_header_text1" maxlength="40" value="<?=stripslashes($headerArr['Headline1'])?>" /></td>
              </tr>
              <tr>
                <td valign="top">Head Line2</td>
                <td><input type="text" style="width:90%;" class="txtbox" id="ns_header_text2" name="ns_header_text2" maxlength="20" value="<?=stripslashes($headerArr['Headline2'])?>" /></td>
              </tr>
              <tr>
                <td valign="top" id="headerdesctxt">Description</td>
                <td><textarea style="width:90%; height:100px;" class="ckeditor msgbox" id="ns_header_description" maxlength="100" name="ns_header_description"><?=stripslashes($headerArr['HeadlineDesc'])?></textarea></td>
              </tr>
            </table>
            
        </td>
      </tr>
    </table>
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="newsheadertbl border_bottom">
      <tr>
        <td width="30%" valign="top" class="txtright"><span class="marginright20">Welcome Note</span></td>
        <td>
        <? if($rs_circular->id=="") $dearParents="Dear Parents,"; else if($rs_circular->id!="") $dearParents=stripslashes($rs_circular->welcome_note); ?>
        	<input type="text" style="width:70%;" class="txtbox" id="welcome_note" name="welcome_note" value="<?=$dearParents?>" />
        </td>
      </tr>
      <tr>
        <td valign="top" class="txtright"><span class="marginright20" id="welcometext">Text</span></td>
        <td><textarea style="width:90%; height:100px;" class="ckeditor msgbox" id="welcome_text" name="welcome_text"><?=stripslashes($rs_circular->welcome_text)?></textarea></td>
      </tr>
      <tr>
        <td valign="top" class="txtright"><span class="marginright20">Inner Images</span></td>
        <td>
            <select style="width:80px;" class="listbox" id="inner_image_types" name="inner_image_types" onchange="showInnerImageOptions()">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <script type="text/javascript">
			$('#inner_image_types').val('<?=$rs_circular->no_of_inner_image?>');
			</script>
            Image Size: 745px X 210px
            <div class="fullsize padtb10">
                <input type="file" class="inner_image" id="inner_image1" name="inner_image1" value="" style="display:none;" /> <?=$welcomeArr['Img1']?>
                <input type="hidden" class="" id="h_inner_image1" name="h_inner_image1" value="<?=$welcomeArr['Img1']?>" />
                <span id="welcome_img_error1" class="txterror"></span><br />
                
                <input type="file" class="inner_image" id="inner_image2" name="inner_image2" value="" style="display:none;" /> <?=$welcomeArr['Img2']?>
                <input type="hidden" class="" id="h_inner_image2" name="h_inner_image2" value="<?=$welcomeArr['Img2']?>" />
                <span id="welcome_img_error2" class="txterror"></span><br />
                
                <input type="file" class="inner_image" id="inner_image3" name="inner_image3" value="" style="display:none;" /> <?=$welcomeArr['Img3']?>
                <input type="hidden" class="" id="h_inner_image3" name="h_inner_image3" value="<?=$welcomeArr['Img3']?>" />
                <span id="welcome_img_error3" class="txterror"></span>
            </div>
        </td>
      </tr>
      <tr>
        <td valign="top" class="txtright"><span class="marginright20">Decription</span></td>
        <td><textarea style="width:90%; height:100px;" class="ckeditor msgbox" id="welcome_description" name="welcome_description"><?=stripslashes($rs_circular->welcome_description)?></textarea></td>
      </tr>
    </table>
    
    
    <div class="fullsize" id="highlighttexttab">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl border_bottom">
          <tr>
            <td width="30%" class="txtright"><span class="marginright20 txtbold">Highlight Text</span></td>
            <td><div id="highlightradiooptions">
                <input type="radio" class="" id="highlight_text1" name="highlight_text" value="Y" onclick="showHighlightOptions();" <?=($rs_circular->is_highlight_text=="Y")?"checked":""?> /> Yes
                <input type="radio" class="" id="highlight_text2" name="highlight_text" value="N" onclick="showHighlightOptions();" <?=($rs_circular->is_highlight_text=="N" || $rs_circular->is_highlight_text=="")?"checked":""?> /> No
                </div>
            </td>
          </tr>
          <tr id="highlightoptions" style="display:none;">
            <td class="bgtheme" colspan="2">
            	<div id="HighlightLevelTop"></div>
                <div style="float:right; margin-right:0px;">
                    <span class="spancursor" id="HighlightLevel_a" style="cursor:pointer; padding-left:15px;" onclick="addHighlightTopLevel();">
                        <div class="fullsize"><div class="pull_right txtbold f24 cursor">+</div></div>
                    </span>
                </div>
            </td>
          </tr>
        </table>
    </div>
    
    <div class="fullsize_pad margintb15" id="moduletab">
        <h4 class="newslt_modulehead">Modules</h4>
        
        <div id="ModuleLevelTop"></div>
        <div style="float:right; margin-right:0px;">
            <span class="spancursor" id="ModuleLevel_a" style="cursor:pointer; padding-left:15px;" onclick="addModuleTopLevel();">
                <div class="fullsize"><div class="pull_right txtbold f24 cursor">+</div></div>
            </span>
        </div>
        
    </div>
    
    
    <div class="fullsize border_top" id="termcalendertab">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl border_bottom">
          <tr>
            <td width="30%" class="txtright"><span class="marginright20">Term Calender</span></td>
            <td>
                <input type="radio" class="" id="term_calender" name="term_calender_position" value="Y" onclick="showTermCalender()" <?=($rs_circular->term_calender=="Y" || $rs_circular->term_calender=="")?"checked":""?> /> Yes
                <input type="radio" class="" id="term_calender" name="term_calender_position" value="N" onclick="showTermCalender()" <?=($rs_circular->term_calender=="N")?"checked":""?> /> No
            </td>
          </tr>
          <tr id="termcalenderoption" style="display:none;">
            <td class="bgtheme">&nbsp;</td>
            <td class="bgtheme">
            	<div id="TermLevelTop"></div>
                <div style="float:right; margin-right:0px;">
                    <span class="spancursor" id="TermLevel_a" style="cursor:pointer; padding-left:15px;" onclick="addTermTopLevel();">
                        <div class="fullsize"><div class="pull_right txtbold f24 cursor">+</div></div>
                    </span>
                </div>
            </td>
          </tr>
        </table>
    </div>
    
    <div class="fullsize margintb15" id="conclustiontab">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl border_bottom">
          <tr>
            <td width="40%" class="txtright" valign="top"><span class="marginright10">Conclusion Text</span></td>
            <td><textarea style="width:95%; height:100px;"  class="ckeditor msgbox" id="conclusion_text" name="conclusion_text"><?=stripslashes($rs_circular->conclusion_text)?></textarea></td>
          </tr>
        </table>
    </div>
    
    <div class="fullsize margintb15">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl">
          <tr>
            <td width="30%" class="txtright" valign="top"><span class="marginright10">Regards Text</span></td>
            <td><input type="text" class="txtbox" id="regards_text" name="regards_text" value="<?=($rs_circular->regards_text=="")?"Warm Regards":stripslashes($rs_circular->regards_text)?>" /></td>
          </tr>
          <tr>
            <td class="txtright" valign="top"><span class="marginright10">From text</span></td>
            <td><input type="text" class="txtbox" id="regards_from_text" name="regards_from_text" value="<?=($rs_circular->regards_from_text=="")?"YT Communications Team":stripslashes($rs_circular->regards_from_text)?>" /></td>
          </tr>
        </table>
    </div>
    
    <div class="fullsize bgtheme">
    	<? $rs_categories = Circulars::getAllMailCategory(); ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl">
          <tr>
            <td colspan="2"><strong>Other Options</strong></td>
          </tr>
          <tr>
            <td width="30%" class="txtright" valign="top"><span class="marginright10">File</span></td>
            <td><input type="file" class="" id="ns_file" name="ns_file" value="<?=$rs_circular->ns_file?>" /> <?=$rs_circular->ns_file?>
            	<span class="txterror" id="nsfileerror"></span>
            </td>
          </tr>
          <tr>
            <td width="30%" class="txtright" valign="top" id="sendtoerror"><span class="marginright10">Action</span></td>
            <td>
            	<select name="mail_template_action" id="mail_template_action" class="listbox" onchange="checkTemplateExists()">
                	<option value="">Select Action</option>
                    <? if(count($rs_categories)>0) { foreach($rs_categories as $K=>$V) { ?><option value="<?=$V->id?>"><?=$V->category_name?></option><? } } ?>
                </select>
            	<!--<input type="radio" name="mail_template_action" id="mail_template_action" value="NT" <?=($rs_circular->mail_template_action=="NT")?"checked":""?> /> New Teacher
                <input type="radio" name="mail_template_action" id="mail_template_action" value="NS" <?=($rs_circular->mail_template_action=="NS")?"checked":""?>/> New Admission Student
                <input type="radio" name="mail_template_action" id="mail_template_action" value="MS" <?=($rs_circular->mail_template_action=="MS")?"checked":""?> /> Middle School Student-->
            </td>
          </tr>
          <tr id="mailexisttr" style="display:none;">
            <td width="30%" class="txtright" valign="top" id="mailexisttab" colspan="2" style="color:#093;"></td>
          </tr>
        </table>
    </div>
    
    <div class="fullsize txtwhite txtcenter f18">
    	<? if($rs_circular->id!=NULL) { $buttonName = "UPDATE"; $buttonAction = "U"; } else { $buttonName = "ADD"; $buttonAction = "N"; } ?>
        <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitNSForm('P');"><strong>PREVIEW</strong></div>
        <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="submitNSForm('C');"><strong>CANCEL</strong></div>
        <div class="bgbrown pull_right margintb10 cursor padlr20 padtb10" onclick="submitNSForm('<?=$buttonAction?>');"><strong><?=$buttonName?></strong></div>
    </div> 
    <input type="hidden" name="ns_submit_action_type" id="ns_submit_action_type" value="<?=$rs_circular->status?>" />
    
<input type="hidden" name="module_plus_count" id="module_plus_count" value="" />
<input type="hidden" name="term_plus_count" id="term_plus_count" value="" />
<input type="hidden" name="highlight_plus_count" id="highlight_plus_count" value="" />

</div>
</form>

<script type="text/javascript">
CKEDITOR.replace('conclusion_text');

$(function() {
   $(".datepicker").datepicker({
		changeMonth: true,
		minDate: new Date()
   });  
});

showNSOptions();
function showNSOptions() { 
	var type = $('#ns_type').val();
	$('#moduletab').show();
	$('#termcalendertab').show();
	$('#highlighttexttab').hide(); 
	$('#conclustiontab').show(); 
	$('#highlightradiooptions').show();
	if(type=="P") {
		$('#moduletab').hide();
		$('#termcalendertab').hide();
		$('#highlighttexttab').show();
	}
	if(type=="DC") {
		$('#conclustiontab').hide();
		$('#moduletab').hide();
		$('#termcalendertab').hide();
		$('#highlighttexttab').show();
		$('#highlight_text1').attr("checked", true);
		$('#highlightradiooptions').hide();
		showHighlightOptions();
	}
}

showHeaderOptions();
function showHeaderOptions() {
	
	var type = $('input[name=ns_header_type]:checked').val(); 
		
	$("#showimg_headertype").hide();
    $("#showtext_headertype").hide(); 
   
	if(type=="I") $("#showimg_headertype").show();
	if(type=="T") $("#showtext_headertype").show();
}

showTermCalender();
function showTermCalender() {
	var type = $('input[name=term_calender_position]:checked').val(); 
	$("#termcalenderoption").hide();
	if(type=="Y") $("#termcalenderoption").show();
}

showSendDateDtl();
function showSendDateDtl() {
	var type = $('input[name=send_date_position]:checked').val(); 
	$(".senddatetab").hide();
	if(type=="Y") $(".senddatetab").show();
}

function showModuleHighlight(row) { 
	
	var type = $('input[id=module_highlight_box'+row+']:checked').val();
	$("#showimg_highlight"+row).hide();
    $("#showtxt_highlight"+row).hide(); 
	$("#modulehightlightpositiontab"+row).hide(); 
	$('#module_img_error'+row).html('');

	if(type=="I") { $("#showimg_highlight"+row).show(); $("#modulehightlightpositiontab"+row).show();  }
	if(type=="T") { $("#showtxt_highlight"+row).show(); $("#modulehightlightpositiontab"+row).show();  }
}

function uncheckList(type, action_id, action) {
	if(action=="P") {
		var list = $('input[class=parent_'+type+']:checked').val(); 
		if((list!="" && list!=undefined) || (action=="New")) { $('.parent_child_'+type).attr("checked", true); $('.child_'+type).attr("checked", true); } 
		else { $('.parent_child_'+type).attr("checked", false); $('.child_'+type).attr("checked", false); }
	} 
	else {
		var sub_list = $('input[id=sub_parent_'+type+'_'+action_id+']:checked').val();
		if((sub_list!="" && sub_list!=undefined) || (action=="New")) { $('.parent_'+type).attr("checked", true); $('.child_'+type+'_'+action_id).attr("checked", true); } 
		else { $('.child_'+type+'_'+action_id).attr("checked", false); }
	}
}

showInnerImageOptions();
function showInnerImageOptions() {
	var value = $('#inner_image_types').val();
	$('#inner_image1').hide();
	$('#inner_image2').hide();
	$('#inner_image3').hide();
	if(value==1) {
		$('#inner_image1').show();
	}
	if(value==2) {
		$('#inner_image1').show(); $('#inner_image2').show();
	}
	if(value==3) {
		$('#inner_image1').show(); $('#inner_image2').show(); $('#inner_image3').show();
	}
}

showHighlightOptions();
function showHighlightOptions() {
	var option = $('input[name=highlight_text]:checked').val();
	$('#highlightoptions').hide();
	if(option=="Y") $('#highlightoptions').show();
}


showConfigureDtls();
function showConfigureDtls() {
	var option = $('input[name=is_configure_url]:checked').val();
	$('.configureurloption').hide();
	if(option=="Y") $('.configureurloption').show();
	else $('#configure_url').val('');
}

showConfigureBtn();
function showConfigureBtn() {
	var option = $('input[name=button_type]:checked').val();
	$('.buttonoption').hide();
	$('#buttonoption_'+option).show();
}


function defaultLoader() {
	
	jQuery('#ModuleLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
	<? 
		if(count($modulesArr)>0 && !empty($modulesArr)){
			foreach($modulesArr as $MK => $MV){
	?>
		//alert('<?=$MV['MTitle']?>'); 
				addModuleTopLevel({m_title:unescape('<?=rawurlencode(htmlentities(stripslashes($MV['MTitle'])))?>'), m_subtitle:unescape('<?=rawurlencode(htmlentities(stripslashes($MV['MSubTitle'])))?>'), m_desc:unescape('<?=rawurlencode(htmlentities(stripslashes($MV['MDesc'])))?>'), mhbox_type:unescape('<?=rawurlencode(htmlentities(stripslashes($MV['MHBoxType'])))?>'), mbbox_position:unescape('<?=rawurlencode(htmlentities(stripslashes($MV['MHBoxPosition'])))?>'), mhbox_headline:unescape('<?=rawurlencode(htmlentities($MV['MHBoxDetails']['HeadLine']))?>'), mhbox_desc:unescape('<?=rawurlencode(htmlentities(stripslashes($MV['MHBoxDetails']['Desc'])))?>'), mhbox_image:unescape('<?=rawurlencode(htmlentities(stripslashes($MV['MHBoxDetails']['Image'])))?>') });
				i++;
	<?
			}
		}
		else {
	?> 
		addModuleTopLevel();
	<?
		}
	?>
	
	jQuery('#TermLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
	<? 
		if(count($termsArr)>0 && !empty($termsArr)){
			foreach($termsArr as $TK => $TV){
	?>
		//alert('<?=$TV['TPosition']?>');
				addTermTopLevel({term_date:unescape('<?=rawurlencode(htmlentities(stripslashes($TV['TDate'])))?>'), term_name:unescape('<?=rawurlencode(htmlentities(stripslashes($TV['TName'])))?>') });
				i++;
	<?
			}
		}
		else {
	?>
		addTermTopLevel();
	<?
		}
	?>
	
	jQuery('#HighlightLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
	<? 
		if(count($highlightArr)>0 && !empty($highlightArr)){
			foreach($highlightArr as $HK => $HV){
	?>
		//alert('<?=$TV['TPosition']?>');
				addHighlightTopLevel({highlight_title:unescape('<?=rawurlencode(htmlentities(stripslashes($HV['HighlightTitle'])))?>'), highlight_desc:unescape('<?=rawurlencode(htmlentities(stripslashes($HV['HighlightDesc'])))?>') });
				i++;
	<?
			}
		}
		else {
	?>
		addHighlightTopLevel();
	<?
		}
	?>
	
}

function addModuleTopLevel(a) { 
		
	if(a==undefined) a={};
	
	if(a.m_title==undefined) a.m_title='';
	if(a.m_subtitle==undefined) a.m_subtitle='';
	if(a.m_desc==undefined) a.m_desc='';
	if(a.mhbox_type==undefined) a.mhbox_type='';
	if(a.mbbox_position==undefined) a.mbbox_position='';
	if(a.mhbox_headline==undefined) a.mhbox_headline='';
	if(a.mhbox_desc==undefined) a.mhbox_desc='';
	if(a.mhbox_image==undefined) a.mhbox_image='';
	
	if(a.Value==undefined) a.Value='';
	
	var row = jQuery('div.mlvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spLevel_'+row+'" class="mlvltop" style="margin:5px 0px;">';
	vhtml += '	<div style="width:100%;" id="spLevel1_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '			 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl bgtheme">';
	vhtml += '				<tr>';
    vhtml += '					<td width="30%" valign="top" class="txtright">Module Title</td>';
    vhtml += '				    <td><input type="text" style="width:70%;" class="txtbox" id="module_title'+row+'" name="ModuleDtl[module_title]['+row+']" value="'+a.m_title+'" /></td>';
    vhtml += '				</tr>';
	
	vhtml += '				<tr>';
    vhtml += '					<td valign="top" class="txtright">Sub Title</td>';
    vhtml += '				    <td><input type="text" style="width:70%;" class="txtbox" id="module_sub_title'+row+'" name="ModuleDtl[module_sub_title]['+row+']" value="'+a.m_subtitle+'" /></td>';
    vhtml += '				</tr>';

	vhtml += '				<tr>';
    vhtml += '					<td valign="top" class="txtright" id="modultedesc'+row+'">Description</td>';
    vhtml += '				    <td><textarea style="width:90%; height:100px;" class="msgbox" id="module_description'+row+'" name="ModuleDtl[module_description]['+row+']">'+a.m_desc+'</textarea></td>';
    vhtml += '				</tr>';

	vhtml += '				<tr>';
    vhtml += '					<td valign="top" class="txtright">Highlight Box</td>';
    vhtml += '				    <td><input type="radio" class="module_highlight_box" id="module_highlight_box'+row+'" name="ModuleDtl[module_highlight_box]['+row+']" value="I" onclick="showModuleHighlight('+row+')" '+(a.mhbox_type=='I'?'checked':'')+' /> Image <input type="radio" class="" id="module_highlight_box'+row+'" name="ModuleDtl[module_highlight_box]['+row+']" value="T" onclick="showModuleHighlight('+row+')" '+(a.mhbox_type=='T'?'checked':'')+' /> Text <input type="radio" class="" id="module_highlight_box'+row+'" name="ModuleDtl[module_highlight_box]['+row+']" value="N" onclick="showModuleHighlight('+row+')" '+((a.mhbox_type=='N' || a.mhbox_type=='')?'checked':'')+' /> None';
	vhtml += '						<div class="fullsize padtb10"> <input type="file" class="" id="showimg_highlight'+row+'" name="module_highlight_img_'+row+'" value="'+a.mhbox_image+'" /> '+a.mhbox_image+' <input type="hidden" class="" id="h_showimg_highlight'+row+'" name="h_module_highlight_img_'+row+'" value="'+a.mhbox_image+'" /> <span id="module_img_error'+row+'" class="txterror"></span></div>';
	vhtml += '						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="padtb10" id="showtxt_highlight'+row+'"> <tr> <td valign="top" width="26%">Head Line</td> <td><input type="text" style="width:90%;" class="txtbox" id="module_highlight_text_head'+row+'" name="ModuleDtl[module_highlight_text_head]['+row+']" value="'+a.mhbox_headline+'" /></td> </tr> <tr> <td valign="top">Description</td><td><textarea style="width:90%; height:100px;" class="ckeditor msgbox" id="module_highlight_text_desc'+row+'" name="ModuleDtl[module_highlight_text_desc]['+row+']">'+a.mhbox_desc+'</textarea></td></tr></table>';
    vhtml += '					</td>';
	vhtml += '				</tr>';

	vhtml += '				<tr id="modulehightlightpositiontab'+row+'">';
    vhtml += '					<td class="txtright" valign="top">Highlight Box Position</td>';
    vhtml += '					<td><input type="radio" class="" id="module_highlight_box_position'+row+'" name="ModuleDtl[module_highlight_box_position]['+row+']" value="L" '+((a.mbbox_position=='L' || a.mbbox_position=='')?'checked':'')+' /> Left <input type="radio" class="" id="module_highlight_box_position'+row+'" name="ModuleDtl[module_highlight_box_position]['+row+']" value="R" '+((a.mbbox_position=='R')?'checked':'')+' /> Right ';
    vhtml += '					</td>';
	vhtml += '				</tr>';
	vhtml += '				<tr>';
    
	vhtml += '				<tr>';
	//if(row!=0) {
	vhtml += '					<td align="right" colspan="4"><span class="spancursor" id="ModuleLevel_r" style="display: block; text-align:right;"><div class="fullsize"><div class="pull_right txtbold f24 cursor" onclick="removeModuleTopLevel('+row+');">-</div></div> </span></td>';
	//} else {
	//vhtml += '					<td align="right" colspan="4">&nbsp;</td>';
	//}
	vhtml += '				</tr>';
	vhtml += '			</table>';
	vhtml += '		<hr style="margin-top:8px; background:#e0e0e0; border:0; height:2px; outline:0;"/>';
	vhtml += '		</div>';
		
	vhtml += '	</div>';
	vhtml += '</div>';

	//alert(vhtml);
	jQuery('#ModuleLevelTop').append(vhtml);
	
	$('#module_plus_count').val(jQuery('div.mlvltop').length);
	showModuleHighlight(row);
	
	CKEDITOR.replace('module_description'+row);
	CKEDITOR.replace('module_highlight_text_desc'+row);
	
}

function removeModuleTopLevel(r){ 
	var i1;
			
	var msg = confirm("Are you sure want to delete..?");
	
	if(msg==true) {
		
		var row = jQuery('div.mlvltop').length-1;
		//alert(row);
		jQuery('#spLevel_'+r).remove();
			 
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				
				if(jQuery('mlvltop').length>0){
					jQuery('#spLevel_'+i1).remove();
				}
				else
					i1 = 101;
			}
			addModuleTopLevel();
		}
	
		if(jQuery('div.mlvltop').length==0) {
			addModuleTopLevel();
		}
	
	}
}

function addTermTopLevel(a) { 
		
	if(a==undefined) a={};
	
	if(a.term_date==undefined) a.term_date='';
	if(a.term_name==undefined) a.term_name='';
	
	if(a.Value==undefined) a.Value='';
	
	var row = jQuery('div.tlvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spLevel_'+row+'" class="tlvltop" style="margin:5px 0px;">';
	vhtml += '	<div style="width:100%;" id="spLevel1_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '			 <table width="100%" border="0" cellspacing="0" cellpadding="0">';
	vhtml += '				<tr>';
    vhtml += '					<td valign="top" width="26%">Date</td>';
    vhtml += '				    <td style="position:relative;"><input type="text" style="width:50%;" class="txtbox datepicker" id="term_calender_date'+row+'" name="TermDtl[term_calender_date]['+row+']" value="'+a.term_date+'" /> <img src="images/cal_icon.png" alt="" style="position:absolute; right:49%; bottom:11px;" /> </td>';
    vhtml += '				</tr>';
	
	vhtml += '				<tr>';
    vhtml += '					<td valign="top">Event Name</td>';
    vhtml += '				    <td><input type="text" class="txtbox" id="term_calender_name'+row+'" name="TermDtl[term_calender_name]['+row+']" value="'+a.term_name+'" /></td>';
    vhtml += '				</tr>';

	vhtml += '				<tr>';
	//if(row!=0) {
	vhtml += '					<td align="right" colspan="4"><span class="spancursor" id="TermLevel_r" style="display: block; text-align:right;"><div class="fullsize"><div class="pull_right txtbold f24 cursor" onclick="removeTermTopLevel('+row+');">-</div></div> </span></td>';
	//} else {
	//vhtml += '					<td align="right" colspan="4">&nbsp;</td>';
	//}
	vhtml += '				</tr>';
	vhtml += '			</table>';
	vhtml += '		<hr style="margin-top:8px; background:#e0e0e0; border:0; height:2px; outline:0;"/>';
	vhtml += '		</div>';
		
	vhtml += '	</div>';
	vhtml += '</div>';

	//alert(vhtml);
	jQuery('#TermLevelTop').append(vhtml);
	
	$('#term_plus_count').val(jQuery('div.tlvltop').length);
	
	$("#term_calender_date"+row).datepicker({
		changeMonth: true
    }); 
	
}

function removeTermTopLevel(r){ 

	var i1;
			
	var msg = confirm("Are you sure want to delete..?");
	
	if(msg==true) {
		
		var row = jQuery('div.tlvltop').length-1;
		//alert(row);
		jQuery('#spLevel_'+r).remove();
			 
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				
				if(jQuery('tlvltop').length>0){
					jQuery('#spLevel_'+i1).remove();
				}
				else
					i1 = 101;
			}
			addTermTopLevel();
		}
	
		if(jQuery('div.tlvltop').length==0) {
			addTermTopLevel();
		}
	
	}
}

function addHighlightTopLevel(a) { 
		
	if(a==undefined) a={};
	
	if(a.highlight_title==undefined) a.highlight_title='';
	if(a.highlight_desc==undefined) a.highlight_desc='';
	
	if(a.Value==undefined) a.Value='';
	
	var row = jQuery('div.hlvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spLevel_'+row+'" class="hlvltop" style="margin:5px 0px;">';
	vhtml += '	<div style="width:100%;" id="spLevel1_'+row+'" class="dimage" >';
	vhtml += '		<div>';
	vhtml += '			 <table width="100%" border="0" cellspacing="0" cellpadding="0">';
	vhtml += '				<tr>';
    vhtml += '					<td valign="top" width="26%" align="right">Title</td>';
    vhtml += '				    <td style="position:relative;"><input type="text" style="width:50%;" class="txtbox" id="highlight_title'+row+'" name="HighlightDtl[highlight_title]['+row+']" value="'+a.highlight_title+'" /></td>';
    vhtml += '				</tr>';
	
	vhtml += '				<tr>';
    vhtml += '					<td valign="top" align="right">Description</td>';
    vhtml += '				    <td><textarea style="width:90%; height:100px;" class="ckeditor msgbox" id="highlight_desc'+row+'" name="HighlightDtl[highlight_desc]['+row+']">'+a.highlight_desc+'</textarea> <span id="highlighterr'+row+'" class="txterror"></span></td>';
    vhtml += '				</tr>';

	vhtml += '				<tr>';
	//if(row!=0) {
	vhtml += '					<td align="right" colspan="4"><span class="spancursor" id="HighlightLevel_r" style="display: block; text-align:right;"><div class="fullsize"><div class="pull_right txtbold f24 cursor" onclick="removeHighlightTopLevel('+row+');">-</div></div> </span></td>';
	//} else {
	//vhtml += '					<td align="right" colspan="4">&nbsp;</td>';
	//}
	vhtml += '				</tr>';
	vhtml += '			</table>';
	vhtml += '		<hr style="margin-top:8px; background:#e0e0e0; border:0; height:2px; outline:0;"/>';
	vhtml += '		</div>';
		
	vhtml += '	</div>';
	vhtml += '</div>';

	//alert(vhtml);
	jQuery('#HighlightLevelTop').append(vhtml);
	
	$('#highlight_plus_count').val(jQuery('div.hlvltop').length);
	CKEDITOR.replace('highlight_desc'+row);
	
}

function removeHighlightTopLevel(r){ 

	var i1;
			
	var msg = confirm("Are you sure want to delete..?");
	
	if(msg==true) {
		
		var row = jQuery('div.hlvltop').length-1;
		//alert(row);
		jQuery('#spLevel_'+r).remove();
			 
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				
				if(jQuery('hlvltop').length>0){
					jQuery('#spLevel_'+i1).remove();
				}
				else
					i1 = 101;
			}
			addHighlightTopLevel();
		}
	
		if(jQuery('div.hlvltop').length==0) {
			addHighlightTopLevel();
		}
	
	}
}


jQuery(function(){
	
	jQuery('#ModuleLevel_r').show();
	jQuery('#ModuleLevel_a').show();
	
	jQuery('#TermLevel_r').show();
	jQuery('#TermLevel_a').show();
	
	jQuery('#HighlightLevel_r').show();
	jQuery('#HighlightLevel_a').show();
	
	defaultLoader();
})

function submitNSForm(action) { 

	if(action=="C") {
		showCircular('N');
		return false;
	}
	
	if(action!="P") $('#ns_submit_action_type').val(action);
	
	var err=0, nsType="";
	nsType = $('#ns_type').val();
	
	if($('#ns_type').val()==''){ err=1; $('#ns_type').addClass('boxerror'); } else { $('#ns_type').removeClass('boxerror'); }
	if($('#ns_title').val()==''){ err=1; $('#ns_title').addClass('boxerror'); } else { $('#ns_title').removeClass('boxerror'); }
	if($('#ns_subject').val()==''){ err=1; $('#ns_subject').addClass('boxerror'); } else { $('#ns_subject').removeClass('boxerror'); }
	if($('input[id="ns_header_type"]:checked').val()==''){ err=1; $('#ns_header_type').addClass('boxerror'); } else { $('#ns_header_type').removeClass('boxerror'); }
	if($('input[id="ns_header_type"]:checked').val()=='T'){ 
		if($('#ns_header_text1').val()==''){ err=1; $('#ns_header_text1').addClass('boxerror'); } else { $('#ns_header_text1').removeClass('boxerror'); }
	} else if($('input[id="ns_header_type"]:checked').val()=='I'){ 
		if($('#ns_header_img').val()=='' && $('#h_ns_header_img').val()==''){ err=1; $('#hs_header_img_error').html('Please upload image'); } else { $('#hs_header_img_error').html(''); }
		if($('#ns_header_img').val()=='' && $('#h_ns_header_img').val()==''){
			if($('#ns_header_img').val()!='') {
				var headerimage = $('#ns_header_img').val();
			} else {
				var headerimage = $('#h_ns_header_img').val();
			}
			var extension1 = headerimage.split('.').pop().toUpperCase();
			if (extension1!="PNG" && extension1!="JPG" && extension1!="GIF" && extension1!="JPEG") { err=1; $('#hs_header_img_error').html('Please upload valid format of image'); } else { $('#hs_header_img_error').html(''); }
		}
		
	}
	
	if($('#inner_image_types').val()==1){ 
		if($('#inner_image1').val()=='' && $('#h_inner_image1').val()==''){ err=1; $('#welcome_img_error1').html('Please upload image'); } else { $('#welcome_img_error1').html(''); }
	}
	if($('#inner_image_types').val()==2){ 
		if($('#inner_image1').val()=='' && $('#h_inner_image1').val()==''){ err=1; $('#welcome_img_error1').html('Please upload image'); } else { $('#welcome_img_error1').html(''); }
		if($('#inner_image2').val()=='' && $('#h_inner_image2').val()==''){ err=1; $('#welcome_img_error2').html('Please upload image'); } else { $('#welcome_img_error2').html(''); }
	}
	if($('#inner_image_types').val()==3){ 
		if($('#inner_image1').val()=='' && $('#h_inner_image1').val()==''){ err=1; $('#welcome_img_error1').html('Please upload image'); } else { $('#welcome_img_error1').html(''); }
		if($('#inner_image2').val()=='' && $('#h_inner_image2').val()==''){ err=1; $('#welcome_img_error2').html('Please upload image'); } else { $('#welcome_img_error2').html(''); }
		if($('#inner_image3').val()=='' && $('#h_inner_image3').val()==''){ err=1; $('#welcome_img_error3').html('Please upload image'); } else { $('#welcome_img_error3').html(''); }
		
		if($('#inner_image1').val()=='' && $('#h_inner_image1').val()==''){
			if($('#inner_image1').val()!="") {
				var inner_image1 = $('#inner_image1').val();
			} else {
				var inner_image1 = $('#h_inner_image1').val();
			}
			var extension2 = inner_image1.split('.').pop().toUpperCase();
			if (extension2!="PNG" && extension2!="JPG" && extension2!="GIF" && extension2!="JPEG") { err=1; $('#welcome_img_error1').html('Please upload valid format of image'); } else { $('#welcome_img_error1').html(''); }
		}
		
		if($('#inner_image2').val()=='' && $('#h_inner_image2').val()==''){
			if($('#inner_image2').val()!='') {
				var inner_image2 = $('#inner_image2').val();
			} else {
				var inner_image2 = $('#h_inner_image2').val();
			}
			var extension3 = inner_image2.split('.').pop().toUpperCase();
			if (extension3!="PNG" && extension3!="JPG" && extension3!="GIF" && extension2!="JPEG") { err=1; $('#welcome_img_error2').html('Please upload valid format of image'); } else { $('#welcome_img_error2').html(''); }
		}
		
		if($('#inner_image3').val()=='' && $('#h_inner_image3').val()==''){
			if($('#inner_image3').val()!='') {
				var inner_image3 = $('#inner_image3').val();
			} else {
				inner_image3 = $('#h_inner_image3').val();
			}
			var extension4 = inner_image3.split('.').pop().toUpperCase();
			if (extension4!="PNG" && extension4!="JPG" && extension4!="GIF" && extension4!="JPEG") { err=1; $('#welcome_img_error3').html('Please upload valid format of image'); } else { $('#welcome_img_error3').html(''); }
		}
		
	}
	
	if(nsType=="TE") {
		var moduleCount = $('#module_plus_count').val();
		for(var i=0; i<moduleCount; i++) {
			if($('input[id="module_highlight_box'+i+'"]:checked').val()==''){ err=1; $('#module_highlight_box'+i).addClass('boxerror'); } else { $('#ns_header_type'+i).removeClass('boxerror'); }
			if($('input[id="module_highlight_box'+i+'"]:checked').val()=="T") { 
				if($('#module_highlight_text_head'+i).val()==''){ err=1; $('#module_highlight_text_head'+i).addClass('boxerror'); } else { $('#module_highlight_text_head'+i).removeClass('boxerror'); }
			}
			if($('input[id="module_highlight_box'+i+'"]:checked').val()=="I") {
				if($('#showimg_highlight'+i).val()=='' && $('#h_showimg_highlight'+i).val()==''){ err=1; $('#module_img_error'+i).html('Please upload image'); } else { $('#module_img_error'+i).html(''); }
				
				if($('#showimg_highlight'+i).val()=='' && $('#h_showimg_highlight'+i).val()==''){
					if($('#showimg_highlight'+i).val()!='') {
						var module_image = $('#showimg_highlight'+i).val();
					} else {
						var module_image = $('#h_showimg_highlight'+i).val();
					}
					var extension5 = module_image.split('.').pop().toUpperCase();
					if (extension5!="PNG" && extension5!="JPG" && extension5!="GIF" && extension5!="JPEG") { err=1; $('#module_img_error'+i).html('Please upload valid format of image'); } else { $('#module_img_error'+i).html(''); }
				}
			}
			
		}
		if($('input[name="term_calender_position"]:checked').val()=='Y'){
			var termCount = $('#term_plus_count').val();
			for(var i=0; i<termCount; i++) {
				if($('#term_calender_date'+i).val()==''){ err=1; $('#term_calender_date'+i).addClass('boxerror'); } else { $('#term_calender_date'+i).removeClass('boxerror'); }
				if($('#term_calender_name'+i).val()==''){ err=1; $('#term_calender_name'+i).addClass('boxerror'); } else { $('#term_calender_name'+i).removeClass('boxerror'); }
			}
		}
	}
	
	if($('input[name="highlight_text"]:checked').val()=="Y" && (nsType=="P" || nsType=="DC")) { 
		var highlightCount = $('#highlight_plus_count').val();
		for(var i=0; i<highlightCount; i++) {
			if($('#highlight_title'+i).val()=='' && $('#highlight_desc'+i).val()==''){ err=1; $('#highlighterr'+i).html('Please fill up above anyone'); } else { $('#highlighterr'+i).html(''); }
		}
	}
	
	if($('#regards_text').val()==''){ err=1; $('#regards_text').addClass('boxerror'); } else { $('#regards_text').removeClass('boxerror'); }
	if($('#regards_from_text').val()==''){ err=1; $('#regards_from_text').addClass('boxerror'); } else { $('#regards_from_text').removeClass('boxerror'); }
	
	var ns_file = $('#ns_file').val();
	if($('#ns_file').val()!="") {
		var extension6 = ns_file.split('.').pop().toUpperCase();
		if (extension6!="PNG" && extension6!="JPG" && extension6!="GIF" && extension6!="JPEG") { err=1; $('#nsfileerror').html('Please upload valid format of image'); } else { $('#nsfileerror').html(''); }
	}

	if($('#mail_template_action').val()==''){ err=1; $('#mail_template_action').addClass('boxerror'); } else { $('#mail_template_action').removeClass('boxerror'); }
	
	if(err==1) alert('Please fill the red marked fields..!');
	
	if(err==0) {
		var myForm = document.getElementById('circular_frm');
		if(action=="P") {
			$('#circular_action').val(action);
			myForm.setAttribute("method", "post");
			myForm.setAttribute("action", "view_newsletter.php");
			myForm.setAttribute("target", "formresult");
			window.open("view_newsletter.php", 'formresult', 'scrollbars=yes, menubar=no, height=600, width=1000, resizable=yes, toolbar=no, status=no');
			myForm.submit();
		} 
		else { 
			$("#circular_action").val('');
			myForm.removeAttribute("action", "");
			myForm.removeAttribute("target", "");
			document.circular_frm.submit();
		}
	}
	
	
}


</script>