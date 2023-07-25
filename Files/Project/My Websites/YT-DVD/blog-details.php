<?
function main(){

	/*if($_REQUEST['BlogId']=="") { ?><script type="text/javascript">window.location.href="<?=getSeoUrl(array('pn'=>'blog.php'))?>";</script><? } */

?>

<link type="text/css" rel="stylesheet" href="css/captcha.css" />

<div class="full_width" id="bloglist_outer"><!-- All Blog List-->
<? 
	$blog_obj = new Blog;
	$blog_obj->id = $_REQUEST['BlogId'];
	$rs_blog = $blog_obj->getAllBlogPostDtls();
	
	
	$title = $rs_blog->blog_title;
	$blog_subtitle = $rs_blog->blog_subtitle;
	$posted_date = date('l F d, Y',strtotime($rs_blog->publish_date));
	$blog_content = $rs_blog->blog_content;
	$blog_image = $rs_blog->blog_image;
?>
<div class="full_width blog_cntr" style="padding-top:180px;">
	<div class="content">

        <div class="full_width subject_head"  style="background-color:#ca9863; margin-top:0px;">
        	<h3 style="float:left; padding-left:10px;"><?=$title?></h3>
            <div style="float:right; padding-right:10px;"><?=$posted_date?></div>
        </div>
        <div class="full_width">
            <div class="blog_cntr12">
				<img src="<?=BLOG_REL.'thumb_'.$blog_image?>" alt="<?=ucwords($title)?>" title="<?=ucwords($title)?>" />
            	<h4><?=$blog_subtitle?></h4>	
                <p><?=$blog_content?></p>
            </div>
        </div>
    </div>
</div>

<script>

function show_blogdetail()
{
	document.getElementById('bloglist_outer').style.display = "none";
	document.getElementById('blog_details').style.display = "block";
}

function showBlogDtls(id) {
	$('#blog_limit_content').show();
	
	if($('#blog_limit_content'+id).is(':visible')){
		$('#blog_limit_content'+id).hide();
		$('#blog_extra_content'+id).show();
	} else {
		$('#blog_limit_content'+id).show();
		$('#blog_extra_content'+id).hide();
	}
}

</script>	

<? 	
}
include "template.php";
?>
