<?
include "includes.php";	

if($_REQUEST['blog_post_id']!='' || ($blogId!="" && $blogId!="undefined")){

	if(($blogId!="" && $blogId!="undefined")) $blog_id = $blogId; else $blog_id = $_REQUEST['blog_post_id'];
	$rs_BlogDtl = Blog::getBlogPostById($blog_id);
	$Category=explode(',',$rs_BlogDtl->category_id);
	
	$_SESSION['BlogPreview']['created_date'] = $rs_BlogDtl->created_date;
	$_SESSION['BlogPreview']['category_id'] = $rs_BlogDtl->category_id;
	$_SESSION['BlogPreview']['blog_title'] = $rs_BlogDtl->blog_title;
	$_SESSION['BlogPreview']['blog_subtitle'] = $rs_BlogDtl->blog_subtitle;
	$_SESSION['BlogPreview']['blog_content'] = $rs_BlogDtl->blog_content;
	$_SESSION['BlogPreview']['blog_image'] = $rs_BlogDtl->blog_image;
	$_SESSION['BlogPreview']['labels'] = $rs_BlogDtl->labels;
	$_SESSION['BlogPreview']['comment_options'] = $rs_BlogDtl->comment_options;
	$_SESSION['BlogPreview']['compose_mode'] = $rs_BlogDtl->compose_mode;
	$_SESSION['BlogPreview']['video_url'] = $rs_BlogDtl->video_url;
	$_SESSION['BlogPreview']['featured_article'] = $rs_BlogDtl->featured_article;
	$_SESSION['BlogPreview']['featured_image'] = $rs_BlogDtl->featured_image;
	
}


?>

<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
createEditor();
function createEditor() { var editor, html = ''; 
	var name = 'blog_content';
	var editor = CKEDITOR.instances[name];
	if (editor) { editor.destroy(true); }
	CKEDITOR.replace(name);	
}
</script>

<div class="fullsize">

<form name="blogPostFrm" id="blogPostFrm" method="post" enctype="multipart/form-data">
<input type="hidden" id="act" name="act" value="blogPostSubmit"/>
<input type="hidden" id="blog_db_id" name="blog_db_id" value="<?=$blog_id?>" /> 
<!--<input type="hidden" id="school_id" name="school_id" value="<?=$schoolId?>" /> -->
<input type="hidden" id="buttonValue" name="buttonValue"/>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
    <tr>
        <td colspan="2" align="right">
            <div class="combutton pull_right marginright10" onclick="window.location.href='blogs.php'">Close</div>
            <div class="combutton pull_right marginright10" onclick="submitBlogPost('<?=$blog_id?>', 'Preview')">Preview</div>
            <div class="combutton pull_right marginright10" onclick="submitBlogPost('<?=$blog_id?>', 'Save')">Save</div>
            <div class="combutton pull_right marginright10" onclick="submitBlogPost('<?=$blog_id?>', 'Publish')">Publish</div>
        </td>
    </tr>
    
    <tr>
        <td width="70%" style="padding:10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td width="26%" id="CategoryErr">Category</td>
                    <td width="74%"> 
                    <? 
                    $category_idArr = explode(",", $_SESSION['BlogPreview']['category_id']);
                    $blogCategory = Blog::getAllBlogCategory(); 
                    if(count($blogCategory)>0){ 
                    	foreach($blogCategory as $M=>$N){
                    ?>
                    <input type="checkbox" name="category_id[]" id="category_id[]" value="<?=$N->id?>" <?=(is_array($category_idArr) && in_array($N->id, $category_idArr))?"checked":""?> />
						<?=$N->category_name?>
                    <? }
					} else {?>
                    	No Category Found..!
                    <? } ?>
                    </td>
                </tr>
           
                <tr>
                    <td id="blog_titleErr">Title</td>
                    <td><input type="text" class="txtbox"  name="blog_title" id="blog_title" value="<?=stripslashes($_SESSION['BlogPreview']['blog_title'])?>"/></td>
                </tr>
                
                <tr>
                    <td>Sub Title</td>
                    <td><input type="text" class="txtbox"  name="blog_subtitle" id="blog_subtitle" value="<?=stripslashes($_SESSION['BlogPreview']['blog_subtitle'])?>"/></td>
                </tr>
                
                <tr>
                    <td>Publish Date</td>
                    <td><input type="text" class="txtbox datepicker"  name="publish_date" id="publish_date" value="<?=($_SESSION['BlogPreview']['publish_date']=="")?date("M d, Y"):stripslashes($_SESSION['BlogPreview']['publish_date'])?>"/></td>
                </tr>
                
                <tr>
                    <td>Featured Article?</td>
                    <td><input type="checkbox" name="featured_article" style="padding-right:250px;" id="featured_article" value="Y" <? if($_SESSION['BlogPreview']['featured_article']=='Y') { ?> checked="checked" <? } ?>  onClick="func_showHideFeatured()"/></td>
                    </tr>
                
                <tr id="tr_featured_article" style="display:<?=($_SESSION['BlogPreview']['featured_article']=='Y')?"":"none"?>;">
                    <td>&nbsp;</td>
                    <td>
                    	<input type="file" class="txtbox" name="featured_image" id="featured_image" value="<?=$_SESSION['BlogPreview']['featured_image']?>" /> 
                        <input type="file" class="txtbox" name="h_featured_image" id="h_featured_image" value="<?=$_SESSION['BlogPreview']['featured_image']?>" /> 
						<? if($_SESSION['BlogPreview']['featured_image']!='' && $blog_id!=''){?>
                        <img src="<?=ARTICLE_HREF.$_SESSION['BlogPreview']['featured_image']?>" width="90"  height="90"/><? } ?>
                        <? if($blog_id==""){?><?=$_SESSION['BlogPreview']['featured_image']?><? }?>
                    </td>
                </tr>
                
                <tr>
                    <td id="ContentErr" valign="top">Content</td>
                    <td><textarea class="ckeditor" name="blog_content" id="blog_content"><?=$_SESSION['BlogPreview']['blog_content']?></textarea></td>
                </tr>
                
                <tr>
                	<td>Blog Image</td>
                    <td>
                    	<input type="file" class="txtbox" name="blog_image" id="blog_image" value="<?=$_SESSION['BlogPreview']['blog_image']?>" />
                        <input type="hidden" class="txtbox" name="h_blog_image" id="h_blog_image" value="<?=$_SESSION['BlogPreview']['blog_image']?>" />
						<? if($_SESSION['BlogPreview']['blog_image']!='' && $blog_id!=''){?>
                        <img src="<?=BLOG_HREF.$_SESSION['BlogPreview']['blog_image']?>" width="90"  height="90"/><? } ?>
                        <? if($blog_id==""){?><?=$_SESSION['BlogPreview']['blog_image']?><? }?>
                    </td>
                </tr>

                <tr>
                    <td>Youtube Url</td>
                    <td><input type="text" class="txtbox"  name="video_url"  id="video_url" size="40" value="<?=($_SESSION['BlogPreview']['video_url'])?>"><span style="font-size:12px;"><br/>Eg : (http://www.youtube.com/watch?v=nYAU57gQJIY)</span></td>
                </tr>
            
            </table>
        </td>

        <td valign="top" width="30%" style="padding-left:10px; padding-right:10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" style="border:1px solid #dab791; margin:0px; padding-top:0px;">
                <tr bgcolor="#dab791">
                	<td colspan="2" onClick="post_setting()" style="cursor:pointer; padding:10px;" align="left"><img src="images/arrow_close.png"/>&nbsp;Post Settings</td>
                </tr>
                
                <tr id="postsettinsdiv">
                    <td valign="top" align="left" style="padding:10px;">	
                        <table width="100%" border="0" cellpadding="0"  cellspacing="0" >	  
                            <tr>
                            	<span style="cursor:pointer" onclick="rightmenu('L')"><img src="images/labal1.png" style="vertical-align:middle" border="0" /> labels</span>
                            </tr>
                            <tr style="display:<?=($blog_id=='')?"none":""?>; background-color:#F8F8F8; " id="labelsblock" >
                            	<td><textarea name="labels" id="labels" cols="32" class="msgbox"><?=$_SESSION['BlogPreview']['labels']?></textarea><br/><span style="padding-left:10px; color:#999999"> Separate labels with commas </span></td>
                            </tr>
                            
                            <tr>
                            <td><span style="cursor:pointer" onclick="rightmenu('O')"><img src="images/option.png" style="vertical-align:middle" border="0" /> Option</span></td>
                            </tr>
                            
                            <tr <? if($blog_id==''){?> style="display:none; <? }?> background-color:#F8F8F8; " id="optionblock" >
                                <td>
                                    <table width="90%"  cellpadding="0" cellspacing="0" border="0" style="padding-left:15px; padding-bottom:10px;">
                                        <tr>
                                        	<td  style="padding-top:5px; padding-bottom:10px;"><strong>Reader Comments</strong></td>
                                        </tr>
                                        
                                    <? if($blog_id==''){  ?>
                                        <tr>
                                            <td valign="top">
                                            <input name="comment_options"  type="radio" value="A" id="comment_options" <? if($_SESSION['BlogPreview']['comment_options']=='A') { ?> checked="checked" <? } ?>/><label for="A" style="cursor:pointer">Allow</label> </td>
                                        </tr>
                                    
                                        <tr>
                                        	<td valign="top"><input name="comment_options" id="DH" type="radio" value="DH" <? if($_SESSION['BlogPreview']['comment_options']=='DH') { ?> checked="checked" <? } ?>/><label for="DH" style="cursor:pointer">Don't Allow</label> </td>
                                        </tr>
                                    <? }else{ ?>
                                    
                                        <tr>
                                        	<td valign="top"><input name="comment_options"  type="radio" value="A" id="comment_options" <? if($_SESSION['BlogPreview']['comment_options']=='A') { ?> checked="checked" <? } ?>/>Allow </td></tr>
                                       
                                        <tr>
                                            <td valign="top">
                                            <input name="comment_options" id="comment_options" type="radio" <? if($_SESSION['BlogPreview']['comment_options']=='DS') { ?> checked="checked" <? } ?>value="DS" /> Don't allow, show existing   </td>
                                        </tr>
                                        
                                        <tr>
                                        	<td valign="top"><input name="comment_options" id="comment_options" type="radio" <? if($_SESSION['BlogPreview']['comment_options']=='DH') { ?> checked="checked" <? } ?> value="DH" /> Don't allow, hide existing   </td>
                                        </tr>
                                    <?
                                    }
                                    ?>	
                                    
                                        <tr>
                                        	<td style="padding-top:15px;" class="font_12"><strong>Compose mode</strong></td>
                                        </tr>	    
                                    
                                        <tr>
                                        	<td style="padding-top:5px;" class="font_12">
                                        <input name="compose_mode"  onclick="CKEDITOR.tools.callFunction(6,this)"  type="radio"  id="content-tmce"  value="EDITOR" <? if($_SESSION['BlogPreview']['compose_mode']=='EDITOR') { ?> checked="checked" <? } ?>/> <label for="content-tmce" style="cursor:pointer;">Interpret typed HTML</label>  </td>
                                        </tr>
                                    
                                        <tr>
                                        	<td style="padding-top:5px;" class="font_12">
                                        <input name="compose_mode" type="radio" value="HTML" id="content-html" onClick="CKEDITOR.tools.callFunction(6,this)"<? if($_SESSION['BlogPreview']['compose_mode']=='HTML') { ?> checked="checked" <? } ?>  /> <label for="content-html" style="cursor:pointer;">Show HTML literally</label>  </td></tr>
                                    
                                    </table>
                                
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
        </td>
    
    </tr>

</table>

</form>	 

</div>

<script type="text/javascript">

		
$(function() {
	$(".datepicker").datepicker({
 	});  
});

function submitBlogPost(id, value) {  
	var err=0; 
	if($.trim($('input[name=category_id[]]:checked').val())==''){ err=1; $('#CategoryErr').addClass('txterror'); } else { $('#CategoryErr').removeClass('txterror'); }
	if($('#blog_title').val()==''){ err=1; $('#blog_titleErr').addClass('txterror'); } else { $('#blog_titleErr').removeClass('txterror'); }
	if($('#featured_article').val()==''){ err=1; $('#featured_article').addClass('boxerror'); } else { $('#featured_article').removeClass('boxerror'); }
	if($('#publish_date').val()==''){ err=1; $('#publish_date').addClass('boxerror'); } else { $('#publish_date').removeClass('boxerror'); }

	if(err==0) {

		$('#buttonValue').val(value);
		var myForm = document.getElementById('blogPostFrm');
		if(value=="Preview") {
			myForm.setAttribute("method", "post");
			myForm.setAttribute("action", "blog_preview.php");
			myForm.setAttribute("target", "formresult");
			window.open("blog_preview.php", 'formresult', 'scrollbars=yes, menubar=no, height=600, width=1000, resizable=yes, toolbar=no, status=no');
			myForm.submit();
			
		} else {
			myForm.removeAttribute("action", "");
			myForm.removeAttribute("target", "");
			if(value=="Publish"){
				alert("Blogs Published Successfully..!");
			}else if(value=="Save"){
				alert("Blogs Saved as Draft..!");
			}
			document.blogPostFrm.submit();
		}
	}
}

function post_setting() {
	if($("#postsettinsdiv").is(":visible")) { $('#postsettinsdiv').hide(); }
	else { $('#postsettinsdiv').show(); }
}

function rightmenu(val) { 
	if(val=='L') {
		if($("#labelsblock").is(":visible")) { $('#labelsblock').hide(); } else { $('#labelsblock').show(); }
	} else {
		if($("#optionblock").is(":visible")) { $('#optionblock').hide(); } else { $('#optionblock').show(); } 
	}
}

function func_showHideFeatured(){
		
	if($('#featured_article').attr('checked')){
		$('#tr_featured_article').show();
	}else{
		$('#tr_featured_article').hide();
	}
}

</script>