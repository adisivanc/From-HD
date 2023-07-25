<?
function main(){


if($_POST['act']=="loadFileList"){

	ob_clean();
	$gradeId = $_POST['gradeId'];
	$schoolId = $_POST['school_id'];
	
	include "download_list.php";
	exit();

}

if($_POST['act']=='loadFileNameExist') {
	ob_clean(); 
	$fileNameObj = new Download();
	$fileNameObj->filename=$_POST['filename'];
	$fileNameObj->file_id=$_POST['file_id'];
	$fileNameObj->school_id=$_POST['school_id'];
	$rsFileName = $fileNameObj->getAllFileDtls();	
	if(count($rsFileName)>0){
		echo 'already exist';
	} else{
		echo 'not exist';
	}
	exit();	
}

if($_POST['act']=='loadAllFile') {
	
	ob_clean();

	if($_POST['searchBy']=="All") {
		
		$fileObj = Download::getAllFiles();
	}
	exit();
}

if($_POST['act']=="loadFileListDtls"){
	
	ob_clean();
	
	$gradeId = $_POST['gradeId']; $school_id = $_POST['school_id']; $orderBy=$_POST['orderBy']; $sortBy=$_POST['sortBy']; $actionPage = $_POST['actionPage'];
	extract($_POST);
	$exportArr=array();
	if(!empty($_POST)) {
		foreach($_POST as $k1=>$v1) {
			if($k1!="act") $exportArr[] = $k1."=".$v1;
		}
	}
	$exportValues = implode("&", $exportArr);

	$file_obj = new Download();
	
	if($_POST['school_id']!='' && $_POST['school_id']!='undefined'){ $file_obj->school_id = $_POST['school_id']; } 
	
	if($_POST['searchBy']=="N") {
		if($_POST['searchByNameId']!="" && $_POST['searchByNameId']!="undefined") $file_obj->search_id=$_POST['searchByNameId']; 
		if($_POST['searchByName']!="" && $_POST['searchByName']!="undefined") $file_obj->name_search=$_POST['searchByName']; 
	}
	
	if($_POST['searchBy']=="Id") {
		if($_POST['searchById']!="" && $_POST['searchById']!="undefined") $file_obj->search_id=$_POST['searchById']; 
	}
	
	if($_POST['orderBy']!="") $order_by=$_POST['orderBy']; else $order_by='filename';
	if($_POST['sortBy']!="") $sort_by=$_POST['sortBy']; else $sort_by='ASC';
	
	$file_obj->orderby = $order_by;
	$file_obj->sortby = $sort_by;
	$rs_file = $file_obj->getAllFileDtls();
	//Pagination 
		
		if($_POST['page']=='')
		$page=1;
		else
		$page = $_POST['page'];
		$totalReg = count($rs_file);
		if($_POST['page_limit']=="" || $_POST['page_limit']=="undefined") $PageLimit = 20; else $PageLimit = $_POST['page_limit'];
		$adjacents = 1;
				
		$totalPages= ceil(($totalReg)/($PageLimit));
		if($totalPages==0) $totalPages=1;
		$StartIndex= ($page-1)*$PageLimit; 
			
		if(count($rs_file)>0) $rs_fileArr = array_slice($rs_file,$StartIndex,$PageLimit,true); 
		if(count($rs_file)>0 && $totalPages > 1){ 
			$rsPagination = generatePagination("fileList", $totalReg, count($rs_fileArr), $PageLimit, $adjacents, $page); 
		}
		
?>

<input type="hidden" name="school_id" id="school_id" value="<?=$_POST['school_id']?>" />
<input type="hidden" name="student_list_page" id="student_list_page" value="<?=$page?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl" id="grade_studentab">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" class="listtbl" bgcolor="<?=$GLOBALS['TableColor']['Table']?>">
                <tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>">
                    <th width="4%" align="center" scope="col">S.No</th>
                    <th width="14%" align="left" scope="col">File Name</th>
                    <th width="13%" align="left" scope="col">Grade</th>
                    <th width="20%" align="left" scope="col">Description</th>
                    <th width="20%" align="left" scope="col">Files</th>
                    <!--<th width="21%" align="left" scope="col">Added By</th>-->
                    <th width="9%" align="center" scope="col">Action</th>
                </tr>
            <?
            if(count($rs_fileArr)>0){
				foreach($rs_fileArr as $K=>$V){
				$rsSchoolName = School::getSchoolById($V->school_id);
				$gradeArr = explode(",", $V->grade_id);
				$gradeNameArr=array();
				if(!empty($gradeArr)){
					foreach($gradeArr as $kk=>$vv) {
						$rs_grade = Grade::getGradeById($vv);
						$gradeNameArr[] = $rs_grade->grade_name;
					}
				}
				$grade_names = implode(", ", $gradeNameArr);
				if($K%2==0) $bgColor = $GLOBALS['TableColor']['TR'];
				
				$usersDtls = User::getUserById($V->added_by);
				$user_name = stripslashes($usersDtls->user_name);
				?>
					<tr bgcolor="<?=$bgColor?>">
						<td align="center"><?=$K+1?></td>
						<td align="left"><?=$V->filename?></td>
						<td align="left"><?=$grade_names?></td>
						<td align="left"><?=stripslashes($V->description)?></td>
                        <? 
							$index = 1;	
							if($V->files!="") {
						?>
                            <td valign="top" style="padding:5px;">
                                <div style="border:0px solid #666; padding:10px; width:200px;">
                                    <div align="center">
                                    <?
									$files=array();
									$files=explode(",",$V->files);
									$i=0;
									foreach($files as $pk=>$pv)
									{
										if($pv!="")
										{
								   $i=$i+1;
									?>
                                    <a href="<?=DOWNLOAD_FILE_HREF.$pv?>" target="_blank"><?=$i?>. <?=$pv?></a><br />
                                    <?
										}
									}
									?>
                                    </div>
                                </div>
                            </td>
                        <? } else echo "<td><b><img src='../images/menu_arrow.png'>&nbsp;&nbsp;Photo not added</b></td>"; ?>
                        <!--<td align="left"></td>-->
						<td align="center">
						<div class="btn_group">
						<? if($GLOBALS['isUpdate']){ ?><img src="images/edit_icon.png" alt="Edit File" title="Edit File" onclick="showFilePopup(<?=$V->id;?>)" class="actionicons" /><? } ?> 
						<? if($GLOBALS['isDelete']){ ?><img src="images/delete_icon.png" alt="Delete File" title="Delete File" onclick="if(confirm('Are you sure want to delete the selected File?')) deleteFile(<?=$V->id;?>, '<?=$_POST['school_id']?>')" class="actionicons" /><? } ?>
						</div>
						</td>
					</tr>
				<?
				}
				if($rsPagination!=''){
				?>
					<tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>"><td colspan="5"><?=$rsPagination?></td></tr>
				<?
				}
            } else {
            ?>
            	<tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>"><td colspan="5">No Files are avaliable..!</td></tr>
            <?
            }
            ?>
            </table>
        </td>
    </tr>
</table>
<? echo "::::".count($rs_file); ?>
<? 	exit();
}

if($_POST['act']=='loadFileFrm'){
	ob_clean();
	
	$doc_files = array();
	$file_obj = new Download();
	$rs_files = Download::getFileById($_POST['file_id']);
	//print_r($rs_files);
	$rsSchool = School::getSchoolById($_POST['school_id']);
	$gradeIdsArr = explode(",", $rs_files->grade_id);
	$doc_files = unserialize($rs_files->files);
	
		
	
?>
<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

    <form name="fileFrm" id="fileFrm" method="post" enctype="multipart/form-data">
    <input type="hidden" name="file_id" id="file_id" value="<?=$_POST['file_id']?>" />
   <input type="hidden" name="act" value="saveFileFrm" />
    <input type="hidden" name="school_id" id="school_id" value="<?=$_POST['school_id']?>" />
    <input type="hidden" name="document_count" id="document_count" value="" />
    
    <table width="250" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;<?=($_POST['file_id']!='')?"Edit File":"Add File"?> for <?=$rsSchool->school_name?></strong>
            <span onclick="closeFilePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2" width="100%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                	  <tr>
                        <td id="gradeerr">Grades</td>
                        <td><?
							$index=1;
							$grade_obj = new Grade();
							$grade_obj->school_id = $_POST['school_id']; 
							$rs_grades = $grade_obj->getGradeDtls();
							
							if(count($rs_grades)>0) { ?>
                            <input type="checkbox" name="school_grades[]" id="school_grades" value="All" onclick="checkAllBox('All')" class="subclass1" /> All<br />
                            <?
								foreach($rs_grades as $k=>$v) {
							?>
                        	<input type="checkbox" name="school_grades[]" id="school_grades" class="school_grades" value="<?=$v->id?>" <?=(in_array($v->id, $gradeIdsArr))?"checked":""?> onclick="checkAllBox('<?=$v->id?>')" /> <?=$v->grade_name?>
                            <? 	if($index%3==0) echo "<br />"; $index++;
								} 
							} else { ?>
                            Grades are not available.. Please add Grade and then insert subject..!
                            <? } ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="33%">File Name</td>
                        <td width="67%"><input type="text" class="txtbox" name="filename" id="filename" onblur="chkFileNameExist()" value="<?=ucfirst($rs_files->filename)?>">
                        	<div style="color:#F00; display:none;" id="fileNameErr">File Name Already Exists!</div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Description</td>
                        <td><textarea class="msgbox" name="description" id="description"><?=$rs_files->description?></textarea></td>
                    </tr>
                    <tr>
                    	<td>Upload Files</td>
                         <td colspan="2">
                    
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                                <div id="DocumentLevelTop"></div>
                                         
<script>
defaultLoader();
	function defaultLoader(){
		
		// Stop for To School Starts Here..
		jQuery('#StudentLevelTop').empty().html('');
		var vhtm = new Array();
		var i = 0;
		<?
		if($rs_files->files!="" && $rs_files->files)
		{ 	
		$files=array();
		$files=explode(",",$rs_files->files);
		$i=0;
		foreach($files as $pk=>$pv){
			if($pv!="")
			{
			$i=$i+1;	
			?>
				addDocument({id:'<?=$rs_files->id?>', filetitle:'<?=$pv?>'});
		<?  
		} 
		} 
		}
		else { ?>addDocument(); <? } ?>
	}
</script>
                                <span class="spancursor" id="documentsLevel_a" style="cursor:pointer; padding-left:900px;" onclick="addDocument();">
                                <div class="pull_right txtbold f24 cursor">+</div>
                                </span> 
                                
                            </table>
                        </td>
                    </tr>
                     <tr>
                        <td id="isnewstderr">Send Notification</td>
                        <td>
                            <input type="radio" name="notification" id="notification" value="N" <?=($rs_files->notification=="N")?"checked":""?> /> No
                            <input type="radio" name="notification" id="notification" value="Y" <?=($rs_files->notification=="Y")?"checked":""?> /> Yes
                        </td>
                    </tr>
                    <tr>
                        <td id="isnewstderr">Visibility Type</td>
                        <td>
                            <input type="radio" name="visibility_type" id="visibility_type" value="I" <?=($rs_files->visibility_type=="I")?"checked":""?>/> Internals
                            <input type="radio" name="visibility_type" id="visibility_type" value="P" <?=($rs_files->visibility_type=="P")?"checked":""?>/> Parents
                            <input type="radio" name="visibility_type" id="visibility_type" value="PU" <?=($rs_files->visibility_type=="PU")?"checked":""?><?=($rs_files->visibility_type=="")?"checked":""?>/>Public
                            <input type="radio" name="visibility_type" id="visibility_type" value="S"  <?=($rs_files->visibility_type=="S")?"checked":""?>/>School
                       </td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">
                        <? if($_POST['file_id']!='') $actionName="Update"; else $actionName="Add"; ?>
                        <div class="combutton pull_right" id="saveImg" onClick="submitFile('<?=$rs_files->id?>')"><?=$actionName?></div>
                        <img src="images/loader.gif" alt="Loading.." title="Loading.." id="lodingImg" style="display:none;" />
                    	</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>
<?	
	exit();
}



if($_POST['act']=='saveFileFrm'){
	ob_clean(); 
	$school_grade_array=$_POST['school_grades'];
	$fname=$_POST['filename'];
	$visibility_type=$_POST['visibility_type'];
	print_r($fname);
	$_POST = array_map("trim", $_POST);
	extract($_POST);
	
	print_r($_POST);
	$cheack=1;
	//$school_grades_array=array();
	//$school_grades_array=implode(",",$_POST['school_grades']);
	foreach($school_grade_array as $K=>$V)
	{
		
		$school_grades=$V;
		if($V=="All")
		{
			$cheack=0;
		}
	
		print_r($school_grades);
	if($school_grades=="All") {
		//$cheack=1;
		$grade_obj = new Grade();
		$grade_obj->school_id = $school_id; 
		$rs_grades = $grade_obj->getGradeDtls();
		print_r($rs_grades);
		$gradeIdArr=array();
		if(count($rs_grades)>0) {
			foreach($rs_grades as $kk=>$vv) {
				$gradeIdArr[] = $vv->id;
			}
		}
		$gradeIds = implode(",", $gradeIdArr);
		} 
	}
		if($cheack==1) {
			//$cheack=1;
			$gradeIds = implode(',',$school_grade_array);
			//$gradeIds =$school_grades;
		}

		
		$file_db_id="";
		$con=0;
		$filepath_gallery_name_array=array();
		$docDtlsArr = array();
		$documentCount = trim($_POST['document_count']);
		for($i=0; $i<$documentCount; $i++) { 
			if($_FILES['event_photo_'.$i]['size'] > 0)
			{
				print_r($i);
				$up_fileArr = $_FILES['event_photo_'.$i]; 
				$rExt = array('jpg','jpeg','png','gif', 'pdf','txt');
				$FileObj = new FileUpload();
				$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>DOWNLOAD_FILE_PATH));
				if($FileResult['Type']==1) {
					$Err[]=$FileResult['Error'];
					$ErrFlag = false;
					if($FileResult['ErrorNo']==1) {
						$Err[] = "Valid file formats are ".implode(',',$rExt);
						$ErrFlag = true;
					}
				}
				elseif($FileResult['Type']==2) {
					$gallery_upload = true;
				}
			
			if($gallery_upload){
				$j=$i+1;
				$FileObj->AssignFileName($fname.$j);
				$filepath_gallery = $FileObj->Upload(); 
			}
			}
			?>
            <script>
			alert(<?=$filepath_gallery?>);
			</script>
            <?
			
			if($filepath_gallery!="") $filepath_gallery_name_array[$i]=$filepath_gallery; else  $filepath_gallery_name_array[$i]=$_POST['h_event_photo_'.$i];
			
			$file_db_id = $_POST['file_db_id'.$i]; 
		}
      $filepath_gallery_name=implode(",",$filepath_gallery_name_array);
		?>
            <script>
			alert(<?=$filepath_gallery_name?>);
			</script>
       <?
	if($_POST['file_id']!=''){
		
		$rsFileUpd = Download::updateFile($school_id, $gradeIds, check_input(ucwords($filename)), check_input($description), $filepath_gallery_name, $notification,$visibility_type, $file_id, $file_db_id);
		//$rsFileUpd = $file_db_id;
		print_r($rsFileUpd);
		print_r("\n".check_input($filename));
	} else {
		$rsFileIns = Download::insertFile($school_id, $gradeIds, check_input(ucwords($filename)), check_input($description), $filepath_gallery_name, $notification,$visibility_type);
		print_r($rsFileIns);
		print_r("\n".check_input($filename));
	}
	
	exit();
}


if($_POST['act']=='delFile'){
	ob_clean();
	
	$rsFile = Download::getFileById($_POST['file_id']);
	
	
	if($rsFile->files!="") { 
			$delete_file = DOWNLOAD_FILE_PATH.$rsFile->files;
			@unlink($delete_file);
			$delete_file1 = DOWNLOAD_FILE_PATH."thumb_".$rsFile->files;
			@unlink($delete_file1);
		} 
		$rs_delete = Download::deleteFile($_POST['file_id']);
	exit();
}

?>

<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

<link rel="stylesheet" type="text/css" href="css/default_style.css" />

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
        
        	<table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>List <br/> <span class="f30"><strong>Downloads</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
            <? if($_SESSION['viewLog']) { ?><div class="combutton" onclick="showLogDetails('<?=TBL_DOWNLOAD?>', '')">Logs</div><? } ?>
        </div>
    </div>
    
</div>



<div class="fullsize">
    
    <div class="fullsize padtb15">

        <div class="newsletter_left"> <!-- Menu -->
            <div class="newsletter_submenu txtwhite">
                <div class="circular_outer">
                    <div class="newcircular_head" id="show_currentteacher">Downloads</div>
                    <? $rs_schools = School::getAccessedSchools($GLOBALS['schoolAccess']); ?>
                    <ul class="currentteacher_content txttheme" id="teachermenutab_A" style="padding-right:10px;">
                    <? foreach($rs_schools as $sk=>$sv) {  ?>
                    	<? if($GLOBALS['schoolAccess'][$sv->id]) {
							?>
                        	<li onclick="showFileDtls('<?=$sv->id?>', 'filename', 'ASC')" style="cursor:pointer;"><?=$sv->school_name?><span class="tabbtn" id="2tabbtn_<?=$sv->id?>"></span></li>
          				<? } ?>
                    <? } ?>
                    </ul>
                </div>
                
            </div>
        </div><!-- Menu -->
        
         <div class="newsletter_right border_theme bgwhite" id="hide_allgradelist" style="width:79%;" ><!--Grade -->
        	
        	<div class="fullsize lineht2 border_bottom" id="filecountdtls">
               <div class="pull_left padlr10 padtb10 txtbold letterspac f18">Download File List <span id="masterschoolname"></span></div>
                <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Files: <span id="filecount"></span></div>
                <? if($GLOBALS['isAdd']){ ?><div class="combutton pull_right" onclick="showFilePopup('')" style="clear:both;">Add Files</div><? } ?>
            </div>
     		
             <div class="fullsize">
                <div id="showFileList" style="padding:5px;"></div>
            </div>      

        </div>

    </div>
    
</div>

<div id="file_popup" style="display:none; padding:0;"></div>


<script type="text/javascript">

showFileDtls('<?=$rs_schools[0]->id?>');

function showFileDtls(school_id) { //alert(school_id);
//	$('.tabbtn').removeClass('arrow');
	//$('#2tabbtn_'+school_id).addClass('arrow');
	
  	ajax({
		a:'downloads',
		b:'act=loadFileList&school_id='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$('#showFileList').html(data);
			
			
 		}			
	});
}

function showFilePopup(file_id){ 
	
	var school_id = $.trim($('#school_id').val());
	//alert(school_id);
	$("#file_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
  	ajax({
		a:'downloads',
		b:'act=loadFileFrm&file_id='+file_id+'&school_id='+school_id,		
		c:function(){},
		d:function(data){// alert(data);
			$("#file_popup").html(data);
		//	$('#filecountdtls').hide();
			popupDtls();
		}			
	});
}

function popupDtls(){
	
  	$("#file_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true,
		position: { 'my': 'center', 'at': 'top' }
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

function closeFilePopup(){ $("#file_popup").dialog('close');  }


function FilePaging(page) {
	
	var school_id = $.trim($('#school_id').val());
	$("#showFileList").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'downloads',
		b:'act=loadFileList&page='+page+'&school_id='+school_id,
		c:function(){},
		d:function(data){
			var dataArr = data.split('::::');
			$("#showFileList").html(dataArr[0]);
		//	$("#filecount").html(dataArr[1]);
		}
	});
}

function submitFile(file_id) { 

	var err = 0; 
	var school_id = $.trim($('#school_id').val());
	var description = escape($.trim($('#description').val()));
	var filename = escape($.trim($('#filename').val()));
	//var files = escape($.trim($('#files').val()));
	var notification = escape($.trim($('#notification').val()));
	var school_grades = escape($.trim($('#school_grades').val()));

	
	if($('#filename').val()==''){ err =1; $('#filename').addClass('boxerror');}else{ $('#filename').removeClass('boxerror');}
	if($('#description').val()==''){ err =1; $('#description').addClass('boxerror');}else{ $('#description').removeClass('boxerror');}
	if($('input[name=notification]:checked').val()=='' || $('input[name=notification]:checked').val()==undefined){ err=1; $('#isnewstderr').addClass('txterror'); } else { $('#isnewstderr').removeClass('txterror'); }
	/*var school_grades = $('input[name=school_grades]:checked').map(function() {
		return this.value;
	}).get();*/
		//alert(school_grades);
	if(school_grades=='' || school_grades==undefined){ err =1; $('#gradeerr').addClass('txterror');}else{ $('#gradeerr').removeClass('txterror');}
//alert(school_grades);
	var file_count = $('#document_count').val();
	//alert(file_count);
	for(var i=0; i<file_count;i++) {
		if($("#event_photo"+i).val()=='' && $("#h_event_photo"+i).val()=='') { err=1; $("#event_photo"+i).addClass("boxerror"); } else $("#event_photo"+i).removeClass("boxerror");
	}
	//alert($("#event_photo"+i).val());	
	if(err==0){
		
		//alert('called');
		$('#savebtn').hide();
		$('#loadingbtn').show();
		var myfrm = document.getElementById('fileFrm');
		$.ajax({
			url: "downloads.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(myfrm), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
			cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
			{
				closeFilePopup();
				 return false;
				$('#savebtn').show();
				$('#loadingbtn').hide();
				$("#file_popup").dialog('close');
				showFileDtls(school_id);
			}	        
		});
		
		
	}
}

function deleteFile(file_id, school_id) { 
	ajax({
		a:'downloads',
		b:'act=delFile&file_id='+file_id+'&school_id='+school_id,		
		c:function(){},
		d:function(data) { //alert(data); return false;
			alert('Deleted Successfully');
			showFileDtls(school_id);
		}			
	});
}


function addDocument(a){
	
	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	//if(a.files==undefined) a.files='';
	//if(a.file_name==undefined) a.file_name='';
	if(a.filetitle==undefined) a.filetitle='';

	if(a.Value==undefined) a.Value='';
	var row = jQuery('div.Documentclvltop').length;
	
	var vhtml = '';
	vhtml += '<div id="spDocumentLevel_'+row+'" class="Documentclvltop" style="margin-top:0px; text-align:left; ">';
	vhtml += '	<div style="padding-top:0px; padding-bottom:10px;" id="spDocumentLevel_'+row+'" class="dimage" >';
	vhtml += '		<div><input type="hidden" name="file_db_id'+row+'" value="'+a.id+'" />';
	vhtml += '			<table border="0" cellpadding="4" cellspacing="0" align="center" width="98%">';
	vhtml += '				<tr>';
	vhtml += '					<td valign="top" align="left"><div><span style="float:left; padding-left:5px; padding:right:5px;"><input type="file" class="" id="event_photo'+row+'" name="event_photo_'+row+'" value="'+a.filetitle+'" /> '+a.filetitle+' <input type="hidden" class="" id="h_event_photo'+row+'" name="h_event_photo_'+row+'" value="'+a.filetitle+'" /></span>';
	vhtml += '					</td>'; 	
	vhtml += '				</tr>';
	vhtml += '			</table></div>';
	vhtml += '		<div style="float:right; position:relative;right:5px; bottom:5px" class="spancursor" id="documentsLevel_r" onclick="removeDocumentTopLevel('+row+', &quot;'+a.id+'&quot;);"><div class="pull_right txtbold f24 cursor">-</div></div>';
	vhtml += '		</div>';
	vhtml += '	</div>';
	vhtml += '</div>';
	
	jQuery('#DocumentLevelTop').append(vhtml);
	
	$('#document_count').val(jQuery('div.Documentclvltop').length);	
	
}
 
 
/* Documents Known */
function removeDocumentTopLevel(r){
	var i1;
	if(r==undefined){
		var row = jQuery('div.Documentclvltop').length-1;
		jQuery('#spDocumentLevel_'+row).remove();
	}
	else
	{
		
		row1 = jQuery('div.clvltopfile').length-1;
		jQuery('#spDocumentLevel_'+r).remove();
		$('#document_count').val(row1);
			
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				if(jQuery('Documentclvltop').length>0)
					jQuery('#spDocumentLevel_'+i1).remove();
				else
					i1 = 101;
			}
			addDocument();
		}
	}
	if(jQuery('div.Documentclvltop').length==0)
		addDocument();
}

jQuery(function(){
	
	jQuery('#documentsLevel_r').show();
	jQuery('#documentsLevel_a').show();
	defaultLoader();
	
});


function chkFileNameExist() { 
	var filename = $('#filename').val();
	var school_id = $.trim($('#school_id').val());
	var param = 'act=loadFileNameExist&filename='+filename+'&school_id='+school_id;
	
	if($('#file_id').val()>0)
		param += '&file_id='+$('#file_id').val();
	
	if(filename!=''){
		ajax({
			a:'downloads',
			b:param,
			c:function(){},
			d:function(data){
				//alert(data);
				if($.trim(data)=='already exist'){
					$('#fileNameErr').show();
					$('#filename').val('');
					$('#filename').focus();
				}
				else{
					$('#fileNameErr').hide();
				}
			}
		});
	}
}

function checkAllBox(type){ 
//alert('method called'); 
	if(type=='All'){
		if($('.subclass1').is(":checked")) { 
			//alert('inner method called');
			$("input[name='school_grades[]']").not($('.subclass1')).attr('disabled', 'true');
			$("input[name='school_grades[]']").not($('.subclass1')).attr('checked', false);
		}else{
		$("input[name='school_grades[]']").not($('.subclass1')).removeAttr('disabled', 'true');
		}
	}
}
</script>

<?
}
include "template.php";
?>