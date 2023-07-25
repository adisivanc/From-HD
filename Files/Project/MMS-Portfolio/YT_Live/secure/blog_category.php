<?
include "includes.php";

if($_POST['act']=="chkBlogCatExist") {
	ob_clean();
	$cate_obj = new Blog();
	$cate_obj->category_name=$_POST['category_name'];
	$cate_obj->id_not=$_POST['category_id'];
	$rs_categories = $cate_obj->getAllBlogCategoryDtls();	
	if(count($rs_categories)>0){
		echo 'already exist';
	} else{
		echo 'not exist';
	}
	exit();
}

if($_POST['act']=="loadBlogsCat") {
	ob_clean();
	$rs_categories = Blog::getAllBlogCategory();
	
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl">
    	<tr>
        	<th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
	<?
	if(count($rs_categories)>0) {
		foreach($rs_categories as $K=>$V) {	
	?>
    	<tr>
        	<td><?=($K+1)?></td>
            <td><?=$V->category_name?></td>
            <td>
            	<img src="images/edit_icon.png" align="absmiddle" alt="Edit" title="Edit" onClick="showCatActions('E', '<?=$V->id?>')" class="cursor" />
                <img src="images/delete_icon.png" align="absmiddle" alt="Delete" title="Delete" class="cursor" onClick="if(confirm('Are you sure want to delete the selected Blog?')) submitBlogCategory('<?=$V->id?>', 'D')" />
            </td>
        </tr>
    <?
		}
	} else {
	?>
		<tr>
        	<td colspan="3">No details found..!</td>
		</tr>
	<?
	}
	?>
    </table>
    <?
	echo "::::";
	echo count($rs_categories);
	exit();	
}

if($_POST['act']=="loadBlogsAction") {
	ob_clean();
	$catId = $_POST['catId'];
	$rs_category = Blog::getBlogCategoryById($catId);
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;<?=($catId!='' && $catId!='undefined')?"Edit Category":"Add Category"?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
                    <tr>
                        <td>Category Name</td>
                        <td colspan="3">
                            <input type="text" class="txtbox" name="category_name" id="category_name" value="<?=$rs_category->category_name ?>" onblur="chckCatExists()" />
                            <span id="cateNameErr" class="txterror"></span>
                        </td>
                    </tr>
                </table>
			</td>
        </tr>
        <tr>
        	<td style="padding-left:380px;">
            	<? if($catId!='' && $catId!='undefined') $actionName="Edit"; else $actionName="Add"; ?>
            	<div class="combutton pull_right" onClick="submitBlogCategory('<?=$catId?>', 'S')"><?=$actionName?></div>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
	
	function chckCatExists() {
		var err=0;
		var category_name = $('#category_name').val();
		var category_id = '<?=$catId?>';
		if($('#category_name').val()==''){ err=1; $('#category_name').addClass('boxerror'); } else { $('#category_name').removeClass('boxerror'); }
		
		if(err==0) {
			ajax({
				a:'blog_category',
				b:'act=chkBlogCatExist&category_name='+category_name+'&category_id='+category_id,
				c:function(){},
				d:function(data){
					//alert(data);
					if($.trim(data)=='already exist'){
						$('#cateNameErr').html('<br />Category already exists');
						$('#category_name').val('');
						$('#category_name').focus();
					}
					else{
						$('#cateNameErr').html('');
					}
				}
			});
		}
	}

	</script>
    <?
	exit();
}

if($_POST['act']=="saveBlogCategory"){
	ob_clean();
	
	if($_POST['catAction']=="D") {
		Blog::deleteBlogCategory($_POST['category_id']);
	} else {
		$cateName = ucfirst($_POST['category_name']);
		if($_POST['category_id']!="" && $_POST['category_id']!="undefined"){
			Blog::updateBlogCategory($cateName, $_POST['category_id']);
		} else {
			Blog::insertBlogCategory('', $cateName);
		}
	}
	
	exit();
}

?>
    
<div class="fullsize lineht2 border_bottom" id="blogcountdtls">
    <div class="pull_left padlr10 padtb10 txtbold letterspac f18">Blog Categories</div>
    <? if($_SESSION['viewLog']) { ?><div class="combutton pull_right margin5 txtbold letterspac f18" onclick="showLogDetails('<?=TBL_BLOG_CATEGORY?>', '')">Logs</div><? } ?>
    <div class="combutton pull_right margin5 txtbold letterspac f18" onclick="showCatActions('N', '')" >Add Category</div>
    <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Blogs: <span id="blogcatecount"></span></div>
</div>

<div class="fullsize">
    <div id="blogcattab"></div>
</div>


<script type="text/javascript">

showBlogCategories();
function showBlogCategories(){
	
	$("#blogcattab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
  	ajax({
		a:'blog_category',
		b:'act=loadBlogsCat',
		c:function(){},
		d:function(data){ //alert(data);
			var dataArr = data.split('::::');
			$('#blogcattab').html(dataArr[0]);
			$('#blogcatecount').html(dataArr[1]);
		}			
	});
}

function showCatActions(action, id) {
	ajax({
		a:'blog_category',
		b:'act=loadBlogsAction&catId='+id+'&catAction='+action,
		c:function(){},
		d:function(data){ //alert(data);
			$("#blog_popup").html(data);
			popupDtls();
		}			
	});
}

function submitBlogCategory(category_id, action){
	
	var err=0, param=""; 
	if(action=="S") {
		var	category_name = $("#category_name").val();
		if($('#category_name').val()==''){ err=1; $('#category_name').addClass('boxerror'); } else { $('#category_name').removeClass('boxerror'); }
		param = '&category_name='+category_name;
	}
	
	if(err==0) {
		ajax({
			a:'blog_category',
			b:'act=saveBlogCategory&category_id='+category_id+'&catAction='+action+param,		
			c:function(){},
			d:function(data){ //alert(data);
				if(action=="S") { alert('Saved successfully..!'); closePopup(); }
				if(action=="D") { alert('Deleted successfully..!'); }
				showBlogCategories();
			}			
		});
	}
}

</script>
