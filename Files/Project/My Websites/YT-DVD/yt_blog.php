<?
function main(){
	$blog_obj = new Blog;
	$blog_obj->status = "P";
	$blog_obj->orderby = "id";
	$blog_obj->sortby = "Desc";
	$blog_obj->publish_date = date("Y-m-d");
	$rs_blog = $blog_obj->getAllBlogPostDtls();	
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
                   <!-- <div class="pagemenu_desctop">celebrating the joy of unhurried childhood</div>-->
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
       <div id="latest_blog"></div>
<?
  if($_POST['act']=="showBlogDtls")
  {
	  ob_clean();
	 /******************************database part****************************************/
	
	$count=0;
	///////////////
	$blog_subtitle;
	$added_by;
	$publish_date;
	$blog_content;
	
	
	//////////////
	foreach($rs_blog as $K=>$V)
	{
			if($count==0)
			{
			$blog_subtitle= $V->blog_title;
			$added_by= $V->added_by;
			$postedDate=date('l F d, Y',strtotime($V->publish_date));
			$blog_content= $V->blog_content;
			$blog_image=$V->blog_image;
			}
			$count=1;
	}
	
	$publishedby;
	$rs_user=User::getUserById($added_by);
	$publishedby=$rs_user->name;
	
	
	 /*****************************database part*****************************************/
?>      
                     
                <div class="blog_header">
                    <div class="blog_header_left"> <h3><?=$blog_subtitle;?></h3> <p>Posted by <span><?=$publishedby;?></span></p> </div>
                    <div class="blog_header_right"><p><?=$postedDate;?></p></div>
                </div>
                
                <div class="full_width blog_parag">
                
                <? 
				
				if($blog_image!="") {
					
				$blog_photo=(BLOG_REL.$blog_image);
				$thumb_blog_photo_name=(BLOG_REL.'thumb_'.$blog_image);
				if(!file_exists($thumb_blog_photo_name)) 
				smart_resize_image($blog_photo, null, 385, 282, true, $thumb_blog_photo_name, false, false, 100);
				}?>
                   <img src="<?=$thumb_blog_photo_name?>" alt="<?=ucwords($title)?>" title="<?=ucwords($title)?>" />
                    
                   <?=$blog_content?>
              </div>
               
<?
	exit();
  }
?>                
               <!-- <div class="full_width blog_social">
                	<a href="" target="_blank"> <img src="images/blog_fb_icon.png" alt="" /> </a>
                    <a href="" target="_blank"> <img src="images/blog_twitter_icon.png" alt="" /> </a>
                    <a href="" target="_blank"> <img src="images/blog_instagram_icon.png" alt="" /> </a>
                </div>-->
                
                <div class="blog_pagination">
                    <div class="blog_pagination_left"> </div>
                    <div class="blog_pagination_right"> <a href="yt_blog_all.php"> See All Posts <img src="images/next_icon.png" alt="" /> </a> </div>
                </div>
                
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
	
	var err = 0;
	
	if(	$('#blog_name').val()=='' || $('#blog_name').val()=='Your name'){ err=1; $('#blog_name').parent().addClass('boxred'); } else{ $('#blog_name').parent().removeClass('boxred'); }
	if(	$('#blog_comments').val()=='' || $('#blog_comments').val()=='Comments'){ err=1; $('#blog_comments').parent().addClass('boxred'); } else { $('#blog_comments').parent().removeClass('boxred'); }
	
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
			$('#blog_email').parent().removeClass('boxred');
		}
	}
 
}



//**********************************siva new  code for the blog*********************************************/
showNewBlog();
function showNewBlog()
{
	ajax({
		a:'yt_blog',
		b:'act=showBlogDtls',
		c:function(){},
		d:function(data) { //alert(data);
			$("#latest_blog").html(data);
		}
	});
}

//**********************************siva new  code for the blog*********************************************/

</script>

<?
}
include "template.php";
?>