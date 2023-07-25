<?
function main(){

if($_REQUEST['act']==''){
	unset($_SESSION['BlogPreview']);
	unset($_SESSION['SesMoreBlog']);
	$_SESSION['SesMoreBlog']=array();
	unset($_SESSION['SesBlogFeatured']);
	$_SESSION['SesBlogFeatured']=array();
}

if($_POST['act']=="loadBlogsList"){
	ob_clean();
	if($_POST['type']=="BL") include "blog_list.php";
	if($_POST['type']=="BC") include "blog_category.php";
	exit();
}

if($_POST['act']=='deleteBlogPost'){
	ob_clean();
	
	$blogIds = explode(',',$_POST['blog_post_id']);
	
	foreach($blogIds as $M=>$N){
		$deleteBlogPostPic = Blog::getBlogPostById($N);
		$deleteBlogPostFile = BLOG_PATH.$deleteBlogPostPic->blog_image;
		unlink($deleteBlogPostFile);
		$deleteBlogPostFile1 = BLOG_PATH."thumb_".$deleteBlogPostPic->blog_image;
		unlink($deleteBlogPostFile1);
		$rsDeleteBlogPost = Blog::deleteBlogPost($N);
	}

	exit();
}

if($_POST['act']=='blogPostSubmit'){
	
	//echo "<pre>"; print_r($_POST); echo "</pre>"; exit();
	if($_FILES['blog_image']['size'] > 0)
	{
		$blog_fileArr = $_FILES['blog_image']; 
		$rExt = array('jpg','jpeg','png','gif');
		$blogFileObj = new FileUpload();
		$FileResult = $blogFileObj->AssignAndCheck(array('FileRef'=>$blog_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>BLOG_PATH));
		if($FileResult['Type']==1)
		{
		$Err[]=$FileResult['Error'];
		$ErrFlag = false;
		if($FileResult['ErrorNo']==1 )
		{
			$Err[] = "Valid file formats are ".implode(',',$rExt);
			$ErrFlag = true;
		}
		}
		elseif($FileResult['Type']==2)
		{
			$blogUploadup_file = true;
		}
	}
	if($_FILES['featured_image']['size'] > 0)
	{
		$article_fileArr = $_FILES['featured_image']; 
		$rExt = array('jpg','jpeg','png','gif');
		$articleFileObj = new FileUpload();
		$FileResult = $articleFileObj->AssignAndCheck(array('FileRef'=>$article_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>ARTICLE_PATH));
		if($FileResult['Type']==1)
		{
		$Err[]=$FileResult['Error'];
		$ErrFlag = false;
		if($FileResult['ErrorNo']==1 )
		{
			$Err[] = "Valid file formats are ".implode(',',$rExt);
			$ErrFlag = true;
		}
		}
		elseif($FileResult['Type']==2)
		{
			$featuredimage_Uploadup_file = true;
		}
	}
		
	$school_id = $_POST['school_id'];
	  
	$categoryArr = array();
	$categoryVal = implode(',',$_POST['category_id']);
	
	if($_POST['buttonValue']=="Publish"){
		$status = "P";
	}else if($_POST['buttonValue']=="Save"){
		$status = "D";
	}
	
	if($_POST['publish_date']=="" || $_POST['publish_date']=="0000-00-00") $publish_date=""; else $publish_date=date("Y-m-d", strtotime($_POST['publish_date']));
	
	if($_POST['buttonValue']=="Publish" || $_POST['buttonValue']=="Save"){
		if($_POST['blog_db_id']!='' && $_POST['blog_db_id']!='undefined'){
			$rsBlogUpd = Blog::updateBlogPost($_POST['blog_db_id'], $school_id, $categoryVal, $_POST['blog_title'], $_POST['featured_article'], $_POST['blog_content'], $_POST['blog_subtitle'], $publish_date, $_POST['labels'], $_POST['comment_options'], $_POST['compose_mode'], $_POST['video_url'], $status, $_POST['blog_db_id'], $_SESSION['YTUserId']);
		$blog_id = $_POST['blog_db_id'];
		} else {
			$rsBlogIns = Blog::insertBlogPost($school_id, $categoryVal, $_POST['blog_title'], $_POST['featured_article'], $_POST['blog_content'], $_POST['blog_subtitle'], $publish_date, $_POST['labels'], $_POST['comment_options'], $_POST['compose_mode'], $_POST['video_url'], $status, $_SESSION['YTUserId']);
			$blog_id = $rsBlogIns;
		}	
		
		if($blog_id>0) {
			if($blogUploadup_file){
				$blogFileObj->AssignFileName($blog_id);
				$Blogfilepath = $blogFileObj->Upload();
				$rsBlogImg = Blog::updateBlogPostByField('blog_image',$Blogfilepath,$blog_id);
			}
			if($featuredimage_Uploadup_file){
				$articleFileObj->AssignFileName($blog_id);
				$articlefilepath = $articleFileObj->Upload();
				$rsArticleImg = Blog::updateBlogPostByField('featured_image',$articlefilepath,$blog_id);
			}
			
			?>
            <script type="text/javascript">window.location.href="blogs.php";</script>
            <?
			//header('location:blogs.php');
		}
		//exit();
	}
	
}

if($_POST['act']=="publishBlog"){
	ob_clean();
	$blogIds = explode(',',$_POST['blogIds']);
	if($_POST['val']=='P'){
		$status ="P";
	}else if($_POST['val']=='D'){ 
		$status ="D";
	}
	foreach($blogIds as $M=>$N){
		$blogUpdate =Blog::updateBlogPostByField('status',$status,$N);
	}
	exit();
}

if($_POST['act']=="manageLabel"){
	ob_clean();
	if($_POST['labelid']=='A')
	{	
		$rs_getlabel = Blog::getAllLabel(); 
		if(count($rs_getlabel)>0)
			{
			?>		
			<div id="label_newt" style="width:135px;float:left; line-height:30px; background-color:#fff; color:#000; position:absolute; margin:0px; font-family:'Trebuchet MS'; border:1px solid #333;">
			
                <div style="width:120px; float:left;padding-left:15px; cursor:pointer;" onClick="showNewLabel('N')">
                   New Label
                </div>
                <div  style="width:120px; float:left;padding-left:15px;">
                	<?
						foreach($rs_getlabel as $vs)
						{
							$labelarr[]=$vs->labels;			
							$implode=implode(',',$labelarr);			
							$explode=explode(',',$implode);			
							$unique = array_unique($explode);
							$implodearray=implode(',',$unique);
						}
                    ?>
                    <? foreach($unique as $kk=>$vv) { ?>
               		<div onclick="submitLabel('<?=$vv?>')" style="cursor:pointer;"><?=$vv?></div>
                <? } ?>
                </div>
		   </div>
				
				<?
			}
	}
	exit();
}

if($_POST['act']=="showNewLable") {
	ob_clean();
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>Add New Label</strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
                    <tr>
                    <td>Label Name</td>
                    <td colspan="3"><input type="text" class="txtbox" name="new_label" id="new_label" value=""></td>
                    </tr>
                </table>
			</td>
        </tr>
        <tr>
        	<td style="padding-left:380px;">
            	<div class="combutton pull_right" onClick="submitLabel(new_label.value)">Save</div>
            </td>
        </tr>
    </table>
	<?
	exit();
}

if($_POST['act']=="saveNewLabel"){
	ob_clean();
	$blogIds = explode(',',$_POST['blog_post_id']);
	foreach($blogIds as $M=>$N){
		$result_selectlabel = Blog::getBlogPostById($N);
		if($result_selectlabel->id>0) {
			if($result_selectlabel->labels=='') { $updatelables=$_POST['labels']; }
			else { $updatelables=$result_selectlabel->labels.",".$_POST['labels']; }
			$blogUpdate =Blog::updateBlogPostByField('labels', $updatelables, $N);
		}
	}
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
                <td>List <br/> <span class="f30"><strong>Blogs &nbsp;&nbsp;</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
            
        </div>
    </div>
    
</div>



<div class="fullsize">
    
    <div class="fullsize padtb15">

        <div class="newsletter_left"> <!-- Menu -->
            <div class="newsletter_submenu txtwhite">
                <div class="circular_outer">
                    <div class="newcircular_head" id="show_currentteacher">Blogs</div>
                    <ul class="currentteacher_content txttheme" id="teachermenutab_A">
                        <li onclick="showBlogDtls('BL')" class="cursor">Blog List<span class="tabbtn" id="1tabbtn_BL"></span></li>
                        <li onclick="showBlogDtls('BC')" class="cursor">Blog Category<span class="tabbtn" id="1tabbtn_BC"></span></li>
                    </ul>
                </div>
                
            </div>
        </div><!-- Menu -->
        
        <div class="newsletter_right border_theme bgwhite" style="width:78.8%;" id="blogaddtab"> <!-- Grade -->
        </div>

    </div>
    
</div>


<div id="blog_popup" style="display:none; padding:0px; margin:0px;"></div>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

function popupDtls(){
	
  	$("#blog_popup").dialog({
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

function closePopup(){ $("#blog_popup").dialog('close');  }

function checkAll(isGroup) {
	set = document.getElementsByName(isGroup.name);
	isState = isGroup.checked;
	for (i=0; i<set.length; i++){
		set[i].checked = isState;
	}
}

showBlogDtls('BL');

function showBlogDtls(type){ // alert(type);
	
	$('.tabbtn').removeClass('arrow');
	$('#1tabbtn_'+type).addClass('arrow');
	var grade_id = $('#search_grade').val();
	$('#blogcountdtls').show();
	
	$("#blogaddtab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
  	ajax({
		a:'blogs',
		b:'act=loadBlogsList&gradeId='+grade_id+'&type='+type,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#blogaddtab").html(data);
 		}			
	});
}

$("html").click( function(){
	
	$("#labelresults").hide();
	
});


</script>

<?
}
include "template.php";
?>