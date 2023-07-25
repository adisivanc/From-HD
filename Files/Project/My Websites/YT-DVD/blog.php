<?
function main(){
	
	
if($_POST['act']=="showBlogDtls") {
	ob_clean();
	
	$blog_obj = new Blog;
	$blog_obj->status = "P";
	$blog_obj->orderby = "id";
	$blog_obj->sortby = "Desc";
	$blog_obj->publish_date = date("Y-m-d");
	$rs_blog = $blog_obj->getAllBlogPostDtls();
	
	
	if ($_POST['page'] == '')
		$page = 1;
	else
		$page = $_POST['page'];
	$totalReg = count($rs_blog);
	$PageLimit = ($_POST["page_limit"] == "") ? 2 : $_POST["page_limit"];

	$totalPages = ceil(($totalReg) / ($PageLimit));
	if ($totalPages == 0) $totalPages = 1;
	$StartIndex = ($page - 1) * $PageLimit;
	if (count($rs_blog) > 0) $rs_blogArr = array_slice($rs_blog, $StartIndex, $PageLimit, true);
	
	$arrayCount = count($rs_blog);
	$arraySliceCount = count($rs_blogArr);
			
	if($arrayCount>0 && $totalPages > 1) { 
		$table_val = generatePagination($functionName="blogList", $arrayCount, $arraySliceCount, $pageLimit=$PageLimit, $adjacent=1, $page=$page, $type="");
	}
	
    if(count($rs_blogArr)>0){
   		foreach($rs_blogArr as $K=>$V){
		$title = $V->blog_title;
		$blog_subtitle = $V->blog_subtitle;
		$posted_date = date('l F d, Y',strtotime($V->publish_date));
		$blog_content = $V->blog_content;
		$blog_image = $V->blog_image;
	  ?>
      	<div class="full_width subject_head"  style="background-color:#ca9863; margin-top:0px;">
        	<h2 style="float:left;"><?=$title?></h2>
            <div style="float:right; padding-right:10px;"><?=$posted_date?></div>
        </div>
        
        <div class="full_width">
            <div class="arithmetic_cntr1">
            	<? if($blog_image!="") {
				$blog_photo=(BLOG_REL.$blog_image);
				$thumb_blog_photo_name=(BLOG_REL.'thumb_'.$blog_image);
				if(!file_exists($thumb_blog_photo_name)) 
				smart_resize_image($blog_photo, null, 385, 282, true, $thumb_blog_photo_name, false, false, 100);
				}?>
				<img src="<?=$thumb_blog_photo_name?>" alt="<?=ucwords($title)?>" title="<?=ucwords($title)?>" width="385" border="0" />
                
            </div>
            <div class="arithmetic_cntr2">
                <p><?=limit_words(stripslashes($blog_content), 120)?>..</p>
                <span class="math_in_fun" style="padding:12px 45px; background:#ce9f38 url(images/pattern_1.jpg); cursor:pointer; float:right; margin-bottom:25px; box-shadow:2px 2px 7px #996600; font-size:18px;"><a href="<?=getSeoUrl(array('pn'=>'blog-details.php','BlogId'=>$V->id))?>" style="color:#000000;">Read More..!</a></span>
            </div>
        </div>
        
	<? 	}
	
		if($table_val!='') {
			?>
			<div class="full_width blog_cntr">
            	<div class="content" align="center">
					<?=$table_val?>
                </div>
			</div>
		<?
		}
		
	} else {
		?>
        <div class="full_width" style="margin:10px 0 280px 0;">
        	Blogs not yet added..!
        </div
        ><?
	}
	
	exit();
}	

?>


<div class="full_width cognitive_develop" id="CD" style="margin-top:0px;">
    <div class="content">
        
        <div id="bloglisttab"></div>
        
        
    </div>
</div>


<div class="full_width" style=" margin-bottom:20px; margin-top:-50px; padding-top:0; ">
    <div class="content">
        
        <div class="contact_explore">
            <h2>What to Explore Next ?</h2>
            <ul>
                <li><a href="<?=getSeoUrl(array('pn'=>'yt_methodology.php'))?>">Methodology</a></li>
                <li><a href="<?=getSeoUrl(array('pn'=>'yt_practices.php'))?>">YT Practices</a></li>
                <li><a href="<?=getSeoUrl(array('pn'=>'funstop.php','Type'=>'gallery'))?>">Gallery</a></li>
            </ul>
        </div>
        
    </div>
</div>

<!--<div class="full_width cognitive_develop">
    <div class="content">
		<div class="blue_line"></div>
        <div class="what_explore">
        	<h2>What to Explore Next ?</h2>
            <ul>
            	<li><a href="<?=getSeoUrl(array('pn'=>'yt_fundamentals.php'))?>">YT Fundamentals</a></li>
                <li><a href="#">Theme &amp; Projects</a></li>
                <li><a href="yt_methodology.php">Methodology</a></li>
            </ul>
        </div>   
    </div>
</div>-->


<script type="text/javascript">

showBlogList();
function showBlogList() {
	
	ajax({
		a:'blog',
		b:'act=showBlogDtls',
		c:function(){},
		d:function(data) { //alert(data);
			$("#bloglisttab").html(data);
		}
	});
	
}

function blogListPaging(page) { 
	
	ajax({
		a:'blog',
		b:'act=showBlogDtls&page='+page,
		c:function(){},
		d:function(data) {
			$('#bloglisttab').html(data);
		}
	});
	
}

$(".teacher").click(function(){
	 
	$('.teacher').removeClass('active');
	$(this).addClass('active');
	 
});


function show_curriculam(param){
	$('.cognitive_develop').hide(); $('#'+param).show();
}

</script>


<?
}
include "template.php";
?>