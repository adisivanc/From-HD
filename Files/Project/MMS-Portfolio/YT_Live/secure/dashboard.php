<?
function main(){
	
?>
<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

<link rel="stylesheet" type="text/css" href="css/default_style.css" />

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>List <br/> <span class="f30"><strong>Dashboard</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
            
        </div>
    </div>
    
</div>

<!-- Menu --><!-- Menu --> <!-- Grade -->

<!--<div class="fullsize">
    
    <div class="fullsize padtb15">

        <div class="newsletter_left"> 
            <div class="newsletter_submenu txtwhite">
                <div class="circular_outer">
                    <div class="newcircular_head" id="show_currentteacher">Uniform List<span></span></div>
                </div>
                
            </div>
        </div>
        
        <div class="newsletter_right border_theme bgwhite" id="hide_allgradelist" style="width:79%;">
        
        	<div class="fullsize lineht2 border_bottom">
                <div class="combutton pull_right" style="clear:both;"><a href="generateCSV.php?filename=StudentUniformList" style="color:#FFF;">Export</a></div>
            </div>
            
            <div class="fullsize">
                <div id="uniformlisttab"></div>
            </div>

        </div>

    </div>
    
</div>-->

<div id="popup_div" style="display:none; padding:0;"></div>



<script type="text/javascript">

function popupDtls(){
	
	$("#popup_div").show();
  	$("#popup_div").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true,
		position: { 'my': 'center', 'at': 'top' }
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

function closePopup(){ $("#popup_div").dialog('close');  }


</script>

<?
}
include "template.php";
?>