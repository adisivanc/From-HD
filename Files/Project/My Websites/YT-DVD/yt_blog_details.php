<?
function main(){
	$blog_obj = new Blog;
	$blog_obj->status = "P";
	$blog_obj->orderby = "id";
	$blog_obj->sortby = "Desc";
	$blog_obj->publish_date = date("Y-m-d");
	$rs_blog = $blog_obj->getAllBlogPostDtls();
if($_POST['act']=="saveComment")
{
	ob_clean();
		//print_r($_POST);
		$id=$_POST['id'];
		$name=$_POST['name'];
		$comments=$_POST['comments'];
		$emailaddress=$_POST['emailaddress'];
		$rs_ins_blog=Blog::inserBlogComments($id,$comments,$name,$emailaddress);
		if($rs_ins_blog)
		{
			echo "Thank you for submitting your comment.";
		}
		else
		{
			echo "There is a problem in saving your comment";
		}
	exit();
	
}
?>


<div id="campus_container">
<div id="slide1" class="parallax">
<div class="parallax" style="height:auto;">
    

    <div class="page_menu" style="top:110px; z-index:10; padding-top:17px;">
    <div class="content">
        <div class="page_menu_container">
            
            <div class="page_menutop_outer">
            <div class="page_menutop">
                <h1 class="page_menuhd">YT Blog</h1>
                <div class="pagemenu_right">
                   <!-- <div class="pagemenu_desctop" id="pagemenu_desctop">celebrating the joy of unhurried childhood</div>-->
                </div>
            </div>
            </div>
            
        </div>
    </div>
    </div>
    
  

	<div class="full_width">
        <div class="content">
        
        <div class="full_width blog_container"> <!-- Blog Outer-->
        
            <div class="blog_content"> <!-- Blog Content-->
<?
if($_REQUEST['id']!="")
{
$id=$_REQUEST['id'];
$rs_s_blog=Blog::getBlogPostById($id);

$id=$rs_s_blog->id;
$publish_date=$rs_s_blog->publish_date;
$blog_title=$rs_s_blog->blog_title;
$blog_image	=$rs_s_blog->blog_image;
$blog_subtitle=$rs_s_blog->blog_subtitle;
$blog_content=$rs_s_blog->blog_content;
$added_by=$rs_s_blog->added_by;
$publishedby;
$rs_user=User::getUserById($added_by);
$publishedby=$rs_user->name;
$postedDate=date('l F d, Y',strtotime($publish_date));
?>            
                <div class="blog_header">
                    <div class="blog_header_left"> <h3><?=$blog_title?></h3> <p>Posted by <span><?=$publishedby?></span></p> </div>
                    <div class="blog_header_right"><p><?=$postedDate?></p></div>
                </div>
                
                <div class="full_width blog_parag">
                    <? 
					
					if($blog_image!="") {
				$blog_photo=(BLOG_REL.$blog_image);
				$thumb_blog_photo_name=(BLOG_REL.'thumb_'.$blog_image);
				if(!file_exists($thumb_blog_photo_name)) 
				smart_resize_image($blog_photo, null,382,280,true, $thumb_blog_photo_name, false, false, 100);
				?>
                 <img src="<?=$thumb_blog_photo_name?>" alt="<?=ucwords($title)?>" title="<?=ucwords($title)?>" />
                <?
				}?>
                  
                    
                   <?=$blog_content?>
                    
                </div>
 <?
}
 ?>               
                <!--<div class="full_width blog_social">
                	<a href="" target="_blank"> <img src="images/blog_fb_icon.png" alt="" /> </a>
                    <a href="" target="_blank"> <img src="images/blog_twitter_icon.png" alt="" /> </a>
                    <a href="" target="_blank"> <img src="images/blog_instagram_icon.png" alt="" /> </a>
                </div>-->


                <div class="blog_pagination">
                    <div class="blog_pagination_left">
                    <?
                    	$blog_rec=new Blog();
						$blog_rec->blog_id=$_REQUEST['id'];
						$rs_details=$blog_rec->getPreviousBlog();
						$rs_details=$rs_details[0];
					?>
                
                     <? if(count($rs_details)>0){ ?><a href="yt_blog_details.php?id=<?=$rs_details->id?>" > <img src="images/prev_icon.png" alt="" />&nbsp;<?=stripslashes($rs_details->blog_title)?> </a><? }?>
                     </div>
                    <div class="blog_pagination_right">
                    <?
                    	$blog_rec=new Blog();
						$blog_rec->blog_id=$_REQUEST['id'];
						$rs_details=$blog_rec->getNextBlog();
						$rs_details=$rs_details[0];
					?>
                    <? if(count($rs_details)>0){ ?><a href="yt_blog_details.php?id=<?=$rs_details->id?>" > <?=stripslashes($rs_details->blog_title)?> </a>&nbsp;<img src="images/next_icon.png" alt="" /><? }?>
                    </div>
                </div>
             
           <?
				/*
			?>
                <div class="full_width blog_postfrm"> <!-- Blog Post-->
                
               
                    <h3>Post a Comment</h3>
                    
                    <div class="blog_background"> <!-- Blog Box-->
                        <div class="blog_txtleft">
                            <div class="blog_txtbox">
                                <img src="images/name1_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                                <input type="text"  style="width:100%;" class="txtbox_noborder"  id="blog_name" name="blog_name" placeholder="Your name" />
                            </div>
                        </div>
                        <div class="blog_txtright">
                            <div class="blog_txtbox">
                                <img src="images/mail1_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                                <input type="text"  style="width:100%;" class="txtbox_noborder" id="blog_email" name="blog_email" placeholder="Your Email" />
                            </div>
                        </div>
                        <div class="full_width">
                            <div class="blog_txtarea">
                                <img src="images/messege_icon.png" alt="" style="position:absolute; left:4px; top:4px;" />
                                <textarea  style="width:100%; height:120px;" class="txtbox_noborder" id="blog_comments" name="blog_comments" placeholder="Comments"></textarea>
                            </div>
                            <div class="blog_submitbtn" onclick="submitBlogFrm()" style="background:url(images/menu_bg.jpg) no-repeat;">Submit</div>
                        </div>
                    </div> <!-- Blog Box-->
                    
                </div> <!-- Blog Post---->>
                
               <?
			   */
			   ?>
            </div> <!-- Blog Content-->
            
            
            
            
            <div class="blog_list"> <!-- Blog List-->
             	<? include "blog_lists.php" ?>         
            </div> <!-- Blog List-->
        
        </div> <!-- Blog Outer-->
        
        
        </div>
    </div>



</div>
</div>
</div>


<script type="text/javascript">

function chkField(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}


function submitBlogFrm(){
	var err=0;
	var id=<?=$id?>;
	//alert(id);
	
	
	
	
	if($('#blog_name').val()==''){err=1; $('#blog_name').parent().addClass('boxred'); alert("Enter Your Name"); return false;}else{var name=$('#blog_name').val();$('#blog_comments').parent().removeClass('boxred'); }
	if($('#blog_comments').val()==""){err=1; $('#blog_comments').parent().addClass('boxred'); alert("Enter Your Comments");  return false;}else{var comments=$('#blog_comments').val();$('#blog_comments').parent().removeClass('boxred'); }
	
	if($('#blog_email').val()==""){err=1; $('#blog_email').parent().addClass('boxred'); alert("Enter Your Email");  return false;}
	else{
		 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#blog_email').val()) == false) 
		{
			err=1;
			$('#blog_email').parent().addClass('boxred');
			alert("Enter Your Email Properly");
			return false;
		}
		else{
			var emailaddress=$('#blog_email').val();
			$('#blog_email').parent().removeClass('boxred');
		}
		
		}
	//alert(name);alert(comments);alert(emailaddress);
	//var err = 0;
	/*
	if(	$('#blog_name').val()=='' || $('#blog_name').val()=='Your name'){ err=1; $('#blog_name').parent().addClass('boxred'); } else{var name= $('#blog_name').val(); $('#blog_name').parent().removeClass('boxred'); }
	if(	$('#blog_comments').val()=='' || $('#blog_comments').val()=='Comments'){ err=1; $('#blog_comments').parent().addClass('boxred'); } else {var comments=$('#blog_comments').val(); $('#blog_comments').parent().removeClass('boxred'); }
	
	if($('#blog_email').val()=='')
	{
	err=1;
	$('#blog_email').parent().addClass('boxred');
	}
	else
	{	 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#blog_email').val()) == false) 
		{
			err=1;
			$('#blog_email').parent().addClass('boxred');
		}
		else{
			var emailaddress=$('#blog_email').val();
			$('#blog_email').parent().removeClass('boxred');
		}
	}
*/
	//var paramData('act':'saveComment','id':id,'name':name,'emailaddress':emailaddress,'comments':comments)
	if(err==0)
	{
	ajax({
		a:'yt_blog_details',
		b:'act=saveComment&id='+id+'&name='+name+'&emailaddress='+emailaddress+'&comments='+comments,
		c:function(){},
		d:function(data) { alert(data);
			//$("#pagemenu_desctop").html(data);
		}
	});
	}
}


</script>

<?
}
include "template.php";
?>