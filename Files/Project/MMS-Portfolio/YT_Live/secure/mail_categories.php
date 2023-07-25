
<div class="fullsize lineht2 border_bottom">
    <div class="pull_left padlr10 padtb10 txtbold letterspac f18">Mail Template Categories</div>
    <? if($_SESSION['viewLog']) { ?><div class="combutton pull_right margin5 txtbold letterspac f18" onclick="showLogDetails('<?=TBL_MAIL_CATEGORY?>', '')">Logs</div><? } ?>
    <div class="combutton pull_right margin5 txtbold letterspac f18" onclick="showCatForm('N', '')" >Add Category</div>
    <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Categories: <span id="mailcatecount"></span></div>
</div>

<div class="fullsize">
    <div id="mailcattab"></div>
</div>


<script type="text/javascript">

showMailCategories();
function showMailCategories(){
	
	$("#mailcattab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
  	ajax({
		a:'mail_format',
		b:'act=loadMailCat',
		c:function(){},
		d:function(data){ //alert(data);
			var dataArr = data.split('::::');
			$('#mailcattab').html(dataArr[0]);
			$('#mailcatecount').html(dataArr[1]);
		}			
	});
}

function showCatForm(action, id) {
	ajax({
		a:'mail_format',
		b:'act=loadCategoryFrm&catId='+id+'&catAction='+action,
		c:function(){},
		d:function(data){ //alert(data);
			$("#circular_popup").html(data);
			popupDtls();
		}			
	});
}

function submitMailCategory(category_id, action){
	
	var err=0, param=""; 
	if(action=="S") {
		if($('#category_name').val()==''){ err=1; $('#category_name').addClass('boxerror'); } else { var category_name = escape($.trim($('#category_name').removeClass('boxerror').val())); }
		if($('#category_abv').val()==''){ err=1; $('#category_abv').addClass('boxerror'); } else { var category_abv = escape($.trim($('#category_abv').removeClass('boxerror').val())); }
		param = '&categoryName='+category_name+'&categoryAbv='+category_abv;
	}
	
	if(err==0) {
		ajax({
			a:'mail_format',
			b:'act=saveMailCategories&categoryId='+category_id+'&catAction='+action+param,		
			c:function(){},
			d:function(data){ //alert(data);
				if(action=="S") { closePopup(); }
				alert(data);
				showMailCategories();
			}			
		});
	}
}

</script>
