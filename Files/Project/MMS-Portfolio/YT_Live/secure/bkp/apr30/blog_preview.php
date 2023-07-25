<?
include "includes.php";
ini_set("display_errors", 1);

if($_POST['buttonValue']=="Preview"){
	$postArr = array('category_id', 'blog_title', 'blog_subtitle', 'blog_content', 'labels', 'comment_options', 'compose_mode', 'video_url', 'featured_article', 'featured_image', 'blog_image');
	
	foreach($postArr as $v) $$v=$_POST[$v];
	if(is_array($category_id)){
		$cat=implode(',',$category_id);
	}
	
	$_SESSION['BlogPreview']['category_id'] = $cat;
	$_SESSION['BlogPreview']['blog_title'] = $blog_title;
	$_SESSION['BlogPreview']['blog_subtitle'] = $blog_subtitle;
	$_SESSION['BlogPreview']['blog_content'] = $blog_content;
	$_SESSION['BlogPreview']['labels'] = $labels;
	$_SESSION['BlogPreview']['comment_options'] = $comment_options;
	$_SESSION['BlogPreview']['compose_mode'] = $compose_mode;
	$_SESSION['BlogPreview']['video_url'] = $video_url;
	$_SESSION['BlogPreview']['featured_article'] = $featured_article;
	if($_FILES['featured_image']['name']!="" && $_FILES['featured_image']['name']!="undefined") {
		$_SESSION['BlogPreview']['featured_image'] = $_FILES['featured_image']['name'];
	} else {
		$_SESSION['BlogPreview']['featured_image'] = $_POST['h_featured_image'];
	}
	if($_FILES['featured_image']['name']!="" && $_FILES['featured_image']['name']!="undefined") {
		$_SESSION['BlogPreview']['blog_image'] = $_FILES['blog_image']['name'];
	} else {
		$_SESSION['BlogPreview']['blog_image'] = $_POST['h_blog_image'];
	}
	 
}

//echo "<pre>"; print_r($_FILES); echo "</pre>";
if($_POST['blog_db_id']!='' && $_POST['blog_db_id']!='undefined'){ $imagePath = BLOG_REL; }else{ $imagePath = SITE_TMP_DIR; }
	//get blog comments
$rs_BlogComments=Blog::getAllBlogCommentsByBlogId($_POST['blog_db_id']);

if($_POST['blog_db_id']!='' && $_POST['blog_db_id']!='undefined'){
	if($_SESSION['BlogPreview']['blog_image']!="") {
		$blog_photo=(BLOG_HREF.$_SESSION['BlogPreview']['blog_image']);
		/*$thumb_blog_photo_name=(BLOG_REL.'thumb_'.$_SESSION['BlogPreview']['blog_image']);
		if(!file_exists($thumb_blog_photo_name)) {
			smart_resize_image($blog_photo, null, 385, 282, true, $thumb_blog_photo_name, false, false, 100);
		}*/
		$imagePath = $blog_photo;
	}
} else { 
	$blog_files = SITE_DOCUMENT_ROOT.'uploads1/tmp/'.$_FILES['blog_image']['name'];
	if(is_file($blog_files)) { unlink($blog_files); }
	move_uploaded_file($_FILES['blog_image']['tmp_name'], $blog_files);
	$imagePath = HREF_TMP_DIR.$_FILES['blog_image']['name'];
	/*$blog_photo=(SITE_DOCUMENT_ROOT.'uploads1/tmp/'.$_FILES['blog_image']['name']);
	$thumb_blog_photo_name=('uploads1/tmp/'.'thumb_'.$_FILES['blog_image']['name']);
	if(!file_exists($thumb_blog_photo_name)) {
		smart_resize_image($blog_photo, null, 385, 282, true, $thumb_blog_photo_name, false, false, 100);
	}*/
}

$rs_user = User::getUserById($_SESSION['YTUserId']);

?>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/default_style.css" />
<div class="fullsize" style="">

<form name="previewblogfrm" id="previewblogfrm" method="post" enctype="multipart/form-data">
<input type="hidden" name="Submit" id="Submit" value="Submit" />

<table width="99%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
  <tr>
    <td width="81%">
    	<h2 style=" font-weight:bold; letter-spacing:-1.5; line-height:40px;"><?=$_SESSION['BlogPreview']['blog_title']?></h2>
        <h3 style="color:#049fd7; font-weight:bold; letter-spacing:-1.5; line-height:30px;"><?=$_SESSION['BlogPreview']['blog_subtitle']?></h3>
        <h4 style="line-height:30px;">Posted By - <?=$rs_user->email_address?></h4>
    </td>
    <td width="19%" valign="bottom" style="line-height:30px;">
    	<?=($_SESSION['BlogPreview']['added_date'])?date('M d, Y',strtotime($_SESSION['BlogPreview']['added_date'])):date('M d, Y')?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
    	<div style="text-align:justify; margin-top:10px; line-height:24px;">
        <? if($imagePath!="") { ?>
            <img onclick="showimg()" src="<?=$imagePath?>" alt="<?=ucwords($_SESSION['BlogPreview']['blog_title'])?>" title="<?=ucwords($_SESSION['BlogPreview']['blog_title'])?>" border="0" vspace="5" hspace="5" style="max-width:50%; float:left; margin:0 10px 10px 0;" width="385" height="282" />
        <? } ?>
            <p><?=$_SESSION['BlogPreview']['blog_content']?></p>
        </div>
    </td>
  </tr>
  <tr>
    <td colspan="2">
    	<h3 style=" font-weight:bold; letter-spacing:-1.5; line-height:35px;"><?=count($rs_BlogComments)?> Comments</h3>
        <p style="text-align:justify; line-height:27px; width:30%; float:left; clear:right;">
        	
        </p>
    </td>
  </tr>
  <tr>
    <td colspan="2">
        <div class="blog_previewpop" onclick="fun_publish('E')">Edit</div>
        <div class="blog_previewpop" onclick="closePreview()">Cancel</div>
    </td>
  </tr>
</table>

</form>
</div>

<script language="javascript">

function fun_publish(action){
	/*$('#action').val('Preview');*/
	var param="";
	if(action=="E") {
		//param = "?act=preview_edit";
	}
	else if(action=="P") {
		document.getElementById('action').value = 'Preview';
		document.previewblogfrm.submit();
		opener.location.href = 'blogs.php'+param;
	}
	close();
}

function closePreview() {
opener.location.href = 'blogs.php';
close();
}

</script>



