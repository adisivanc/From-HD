<h4>Popular Posts</h4>
<?
$count=0;
	foreach($rs_blog as $K=>$V)
	{
			if($count<=1)
			{
			$blog_subtitle= $V->blog_title;
			$added_by= $V->added_by;
			$postedDate=date('F Y',strtotime($V->publish_date));
			$blog_content= $V->blog_content;
			$blog_image=$V->blog_image;
			$blog_id=$V->id;
			?>
<div class="blog_popular_post"> <!-- Blog 1-->
    <div class="full_width blog_thumb_header">
        <div class="blog_thumb_head"><?=$blog_subtitle?></div>
        <div class="blog_thumb_date"><?=$postedDate?></div>
    </div>
    
    <div class="full_width blog_thumb_cntr">
        <div class="blog_thumb_img"> <? if($blog_image!="") {
				$blog_photo=(BLOG_REL.$blog_image);
				$thumb_blog_photo_name=(BLOG_REL.'thumb_'.$blog_image);
				if(!file_exists($thumb_blog_photo_name)) 
				smart_resize_image($blog_photo, null, 385, 282, true, $thumb_blog_photo_name, false, false, 100);
				?>
                <img src="<?=$thumb_blog_photo_name?>" alt="<?=ucwords($title)?>" title="<?=ucwords($title)?>" />
                <?
				}?>
                    </div>
        <div class="blog_thumb_content"><? echo limit_words($blog_content,20);?><span onclick=""><a href="yt_blog_details.php?id=<?=$blog_id?>">[more...]</a></span></div>
    </div>
</div> <!-- Blog 1-->
<?
}
			$count=$count+1;
	}


?>


<div class="blog_categories"> <!-- Blog Categories-->
    <h4>Categories</h4>
    <ul>
        <?
		$rs_blog_category=Blog::getAllBlogCategory();
		foreach($rs_blog_category as $bcK=>$bcV)
		{
		?>
        <li onclick="alert(<?=$bcV->id;?>)"><?=$bcV->category_name;?></li>
        <?
		}
		?>
    </ul>
</div> <!-- Blog Categories-->

<div class="blog_archives"> <!-- Blog Archives-->
    <h4>Archives</h4>
       <ul>
    <?
	$get_blog=new Blog();
	$get_blog->category='all';
    $rs_year = $get_blog->getBlogYear();
	
			if(count($rs_year)){
			foreach($rs_year as $key=>$value)
			{
			 $year=$value->created_year;
			$total=$value->Total;
			$Id=$value->id;
	?>
	
   
 
        <li>
            <div class="archives_year"><?= $year?> (<?=$total?>)</div>
            <ul class="archives_month">
             <?
			$get_blog_mth=new Blog();
			$get_blog_mth->category='all';
			$rs_month = $get_blog_mth->getBlogMonth($year);
			foreach($rs_month as $k=>$v)
			{
			$pmonth=$v->created_month;
			$postedmonth=date("F", strtotime($pmonth));
			$postedmonthnum=date("n", strtotime($pmonth));
			?>
                <li> 
                	<div class="month_list"> <?=$postedmonth?> (<?=$v->Total?>)</div>
                    <ul class="archives_blogs">
                    <?
					$get_blog_dtls=new Blog();
					$get_blog_dtls->category='all';
					$rs_blog_month = $get_blog_dtls->getMonthBlogDtls($year,$postedmonth);
					foreach($rs_blog_month as $kb=>$vb)
					{
					?>
                        <li> <a href="yt_blog_details.php?id=<?=$vb->id?>"><?=$vb->blog_title?></a> </li>
                     <?
					}
					 ?>
                    </ul>
                </li>
              
			<?
			}
			?> 
            </ul>
        </li>
     <? 
			}
			}
	?>
    </ul>
</div> <!-- Blog Archives-->


<script type="text/javascript">

$(".archives_year").click(function(){
    $(".archives_month").css({"display": "none"});
	$(this).next(".archives_month").css({"display": "block"});
}); 

$(".month_list").click(function(){
    $(".archives_blogs").css({"display": "none"});
	$(this).next(".archives_blogs").css({"display": "block"});
}); 

</script>

