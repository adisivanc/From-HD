<? 
include "includes.php";

if($_POST['act']=="loadBlogsForm"){
	ob_clean();
	$blogId = $_POST['blogId'];
	//$schoolId = $_POST['schoolId'];
	include "blog_add.php";
	exit();
}

if($_POST['act']=="loadBlogListDtls") {
	ob_clean();
	
	$blogPostObj = new Blog;
	if($_POST['type']=="C") {
		$rs_blog = $blogPostObj->getBlogPostByCategoryId($_POST['category_id']);
	} else if($_POST['type']=="P") {
		$blogPostObj->status =  $_POST['status'];
		$rs_blog = $blogPostObj->getAllBlogPostDtls();
	} else if($_POST['type']=="L" && $_POST['category_name']!='') {
		$rs_blog = $blogPostObj->getBlogPostByLabels($_POST['category_name']);
	} else {
		$rs_blog = $blogPostObj->getAllBlogPostDtls();
	}
	
	if($_POST['page']=='')
		$page=1;
	else
		$page = $_POST['page'];
	$totalReg = count($rs_blog);
	$PageLimit = 20;
	$adjacents = 1;
			
	$totalPages= ceil(($totalReg)/($PageLimit));
	if($totalPages==0) $totalPages=1;
	$StartIndex= ($page-1)*$PageLimit; 
		
	if(count($rs_blog)>0) $rs_blogArr = array_slice($rs_blog,$StartIndex,$PageLimit,true);
	if(count($rs_blog)>0 && $totalPages > 1) { 
		$rsPagination = generatePagination("blogList", $totalReg, count($rs_blogArr), $PageLimit, $adjacents, $page); 
	}
	
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl" style="border:1px solid #dab791">
	<? 
    // getAllStudentDtls
    if(count($rs_blogArr)>0){
        foreach($rs_blogArr as $M=>$N){
        $bgcolor="#EEEEEE"; if($M%2==0) $bgcolor="#FFFFFF";
        $category_id = explode(',',$N->category_id);
        if($N->status=="D") { $status = "Draft"; } else if($N->status=="P") { $status = "Pending"; }
    ?> 
        <tr bgcolor="<?=$bgcolor?>" style="color:<?=$color?>">
            <td width="48%" align="left">
                <div style=" padding-left:5px; float:left;" align="center">
                    <input type="checkbox" class= "blogCheckBox" name="chkbox[]" id="chkbox['<?=$N->id?>']" value="<?=$N->id?>" />
                </div>
                <span style="padding-left:15px; float:left;" align="center">
                    <?=$N->blog_title?> <br />
                    <span onclick="showBlogFrm('N', '<?=$N->id?>')" class="blogtxt">Edit |</span>
                    <span class="blogtxt" onclick="if(confirm('Are you sure want to delete the selected Blog?')) deleteBlogPost(<?=$N->id;?>)">Delete</span>
                </span>
            </td>
            <td width="16%">
                <? $rs_BlogComments=Blog::getAllBlogCommentsByBlogId($N->id); ?>
                <img src="images/comment_icon.png" id="commimage<?=$N->id?>" onclick="showComments(<?=$N->id?>)" style="cursor:pointer" width="18" height="18"/>
                <span style="color:#000">(<?=count($rs_BlogComments)?>)</span>
            </td>
            <td width="11%">
                <span style="font-size:12px; color:#F36F2C;"><?=($N->status=="P")?"Publish":"Draft";?></span><br/>
                <span style="font-size:14px;"><?=date('d M,Y',strtotime($N->added_date))?></span>
            </td>
            <!--<td width="25%"><?=ucfirst($N->labels)?></td>-->
        </tr>
    
    <? }
    } else {
    ?>
        <tr><td colspan="9" align="center">No Blogs Found..!</td></tr>
    <?
    }
    ?>
    <? if($rsPagination!=''){ ?>   
        <tr><td colspan="5"><span class="push_right" style="margin-right:1px; padding:4px;"> <?=$rsPagination?></span></td></tr>
    <? } ?>
    </table>
    <?
	echo "::::";
	echo count($rs_blog);
	exit();
}


$blog_count = Blog::getBlogCount(); 
$rs_blogs = Blog::getAllBlogCategory();
$rs_labes = Blog::getAllLabels();
?> 
<style>
.lablebox { float:left; background-color:#F4F4F4; border:1px solid #D8D8D8; border-left:none; padding:10px; cursor:pointer; color:#222222; font-size:12px; }
.blogtxt { font-size:12px; color:#39F; cursor:pointer; }
</style>


<div class="fullsize lineht2 border_bottom" id="blogcountdtls">
    <div class="pull_left padlr10 padtb10 txtbold letterspac f18">Blogs List</div>
    <div class="combutton pull_right margin5 txtbold letterspac f18" onclick="showBlogFrm('N', '')">Add Blog</div>
    <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Blogs: <span id="blogpostcount"></span></div>
</div>

<div class="fullsize">
    <div id="blogslisttab">
    <input type="hidden" name="blogpost_school_id" id="blogpost_school_id" value="<?=$schoolId?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                    <tr>
                        <td> 
                            <table width="100%" border="0" class="gradetbl" cellspacing="0" cellpadding="0" style="border-right:1px solid #dab791">
                                <tr>
                                    <td><img src="images/post_mo.png" align="absmiddle" alt="Posts" title="Posts" /> <strong>Posts</strong></td>
                                </tr>
                                <tr>
                                    <td onclick="showBlogList('P', '')" align="left" class="cursor">All(<?=$blog_count->Total?>)</td>
                                </tr>
                                <tr>
                                    <td onclick="showBlogList('P', 'D')" align="left" class="cursor">Drafts(<?=$blog_count->Draft?>)</td>
                                </tr>
                                <tr>
                                    <td onclick="showBlogList('P', 'P')" align="left" class="cursor">Published(<?=$blog_count->Published?>)</td>
                                </tr>
                                <tr>
                                    <td><img src="images/post_mo.png" align="absmiddle" alt="Categories" title="Categories" /> <strong>Categories</strong></td>
                                </tr>
                                <? if(count($rs_blogs)>0){
                                    foreach($rs_blogs as $M=>$N){
                                        $blogPostObj = new Blog;
                                        $blogPostObj->category_id =  $N->id;
                                        $countCategory=$blogPostObj->getAllBlogPostDtls();
                                        $blogCategory_count = $blogPostObj->getBlogPostByCategoryId($N->id);
                                ?>
                                <tr>
                                    <td onclick="showBlogList('C', '<?=$N->id;?>')" align="left" class="cursor"><?=$N->category_name?>(<?=count($blogCategory_count)?>)</td>
                                </tr>
                                <? 
                                    } 
                                }
                                ?>
                            </table>
                           
                        </td>
                    </tr>		
                </table>
            </td>
        
            <td width="79%" valign="top" align="left" style="padding-left:10px; padding-right:10px;">
                <table border="0" cellpadding="0" cellspacing="0" class="gradetbl" width="100%">
                    <tr>
                        <td width="62%" align="left">
                            <div align="center" class="lablebox" style="padding:8px 10px; border-left:1px solid #D8D8D8;">
                                <input type="checkbox" name="chkbox[]" id="chkbox[]"  onclick="checkAll(this);"/>
                            </div>
                            <div class="lablebox" id="label" onclick="showAllLabel('A')" style="padding:4px 0px;">
                                <img src="images/labal.png"  border="0" />
                            </div>	
                            <div class="lablebox" align="center" onClick="blogPublish('P')">Publish</div>
                            <div class="lablebox" align="center" onClick="blogPublish('D')">Revert To Draft</div>
                            <div class="lablebox" align="center" style="padding:9px 10px;">
                                <div style="float:left; font-size:14px; line-height:20px; position:relative; left:-280px; top:28px;" id="labelresults">
                                </div>
                                <img src="images/delete.png" border="0"  href="javascript:void(0);" onClick="if(confirm('Are you sure want to delete the selected Blog?')) deleteChecked()" /> 
                            </div>
                        </td>
                        <td align="right" colspan="2">Search Label</td>
                        <td width="18%">
                            <select id="searchLable" name="searchLable" class="listbox" onchange="showBlogList('L', this.value)">				
                                <option value="" style="padding-left:8px;">All Label</option>				
                                <?	
								if(!empty($rs_labes)) {	
                                foreach($rs_labes as $key=>$val) {
                                    if($val!='') {
                                ?>
                                <option value="<?=$key?>" <? if($_POST['category_name']==$key){ ?>selected="selected"<? } ?>><?=ucfirst($key).' ('.$val.') '?></option>				
                                <? } 
                                }
								}?>	
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0px;" colspan="4" id="blogpostlisttab"></td>
                    </tr>
                </table>
            
            </td>
        </tr>
    </table>
	</div>
</div>

<script type="text/javascript">

showBlogList('P', '');
function showBlogList(type, category_id) { //alert(type); alert(category_id);
	if(type=="C"){
		param = 'category_id='+category_id+'&type='+type;
	} else if(type=="P") {
		param = 'status='+category_id+'&type='+type;
	} else if(type=="L") {
		param = 'category_name='+category_id+'&type='+type;
	}
	$("#blogpostlisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
  	ajax({
		a:'blog_list',
		b:'act=loadBlogListDtls&'+param,
		c:function(){},
		d:function(data){ //alert(data);
			var dataArr = data.split('::::');
			$('#blogpostlisttab').html(dataArr[0]);
			$('#blogpostcount').html(dataArr[1]);
		}			
	});
}

function showBlogFrm(action, id) {
	
	$("#blogslisttab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	$('#blogcountdtls').hide();
	ajax({
		a:'blog_list',
		b:'act=loadBlogsForm&action='+action+'&blogId='+id,
		c:function(){},
		d:function(data){ //alert(data);
			$('#blogslisttab').html(data);
		}			
	});
	
}

function blogPublish(val) {
	 
	var err=0;
	
	var blogIds = $('input[class=blogCheckBox]:checked').map(function(){
		return this.value;
	}).get();
	
	if(blogIds=="") { err=1; alert('Please select rows'); }
	
	if(err==0 ) {
		ajax({
			a:'blogs',
			b:'act=publishBlog&blogIds='+blogIds+'&val='+val,
			c:function(){},
			d:function(data){
				if(val=="P"){
					alert("Blogs Published Successfully..!");
				}else{
					alert("Blogs Drafted Successfully..!");
				}
				showBlogDtls('BL');
			}
		});
	}
}

function deleteChecked(){
	var err=0;
	
	var blogIds = $('input[class=blogCheckBox]:checked').map(function(){
		return this.value;
	}).get();
	
	if(blogIds=="") { err=1; alert('Please select rows'); }
	
	if(err==0 ) {
		ajax({
			a:'blogs',
			b:'act=deleteBlogPost&blog_post_id='+blogIds,
			c:function(){},
			d:function(data){
				//alert(data);
				alert("Selected Blogs Deleted Successfully..!");
				showBlogDtls('BL');
			}
		});
	}
}

function showAllLabel(postid) {
	
	
	ajax({										  
		a:'blogs',
		b:'act=manageLabel&labelid='+postid,
		c:function(){},
		d:function(data) {
			if(data!='') {
				$('#labelresults').show();	
			    $('#labelresults').html(data);
			}
		}
	});
	
				$('#label_newt').hide();								 
	
}

function showNewLabel(){
	   //alert('hai');
	var list = new Array() ;
	$("input:checkbox").each(
		function(){
			if (this.checked){
				list[list.length] = 'chklink[]='+this.value;
			}
		}
	);
	
	if(list.length>0) {
	      $('#labelresults').show();
		  ajax({										  
				a:'blogs',
				b:'act=showNewLable',
				c:function(){},
				d:function(data) {
					$("#blog_popup").html(data);
					popupDtls();
				}
			});
	}
	else {
	    $('#labelresults').hide();	
		alert('No Posts are Selected!');
	}

}

function submitLabel(label){
	var err=0;
	var blogIds = $('input[class=blogCheckBox]:checked').map(function(){
		return this.value;
	}).get();
	
	if(blogIds=="") { err=1; alert('Please select rows'); }
	
	if(err==0 ) {
		ajax({										  
			a:'blogs',
			b:'act=saveNewLabel&blog_post_id='+blogIds+'&labels='+label,
			c:function(){},
			d:function(data) { //alert(data); return false;
				showBlogDtls('BL');
				$('#labelresults').hide();	
				closePopup();
			}
		});
	}
}

</script>