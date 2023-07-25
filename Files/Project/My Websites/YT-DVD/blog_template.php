<?
function main(){
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
                    <div class="pagemenu_desctop">celebrating the joy of unhurried childhood</div>
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
                <? include "blog_lists.php" ?> 
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


</script>

<?
}
include "template.php";
?>