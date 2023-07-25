<?
function main(){
	$country_Arr = countries();	
	$usstate_Arr = USState();	
	$indiastate_Arr = IndiaStateArr();
	$ts_maharastraDistrict = maharastraDistrict();
	
     $EId = $_REQUEST['Id'];
	//echo "Test".$_REQUEST['Faculty_id'];
	 if($EId!='')
	 {
	  $query = "select * from ".TBL_FACULTY." where id = '".$EId."' ";
	  $Updateresult = dB::sExecuteSql($query);
	 }
	 
	 if($_POST['act']=='Submit'){ 
		
		if($_FILES['Photo']['size'] > 0)
		{
			$FileArr = $_FILES['Photo'];	
			$rExt1 = array('jpg','jpeg','gif','png');
			$FileObj = new FileUpload();
			$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$FileArr, 'Extension'=>implode(',', $rExt1),'PathPrefix'=>FACULTY_PATH));
			
			if($FileResult['Type']==1)
			{
				$Err['Photo']=$FileResult['Error'];
				$ErrFlag = false;
				if($FileResult['ErrorNo']==1 )
				{
					$Err['Photo'] = "Valid file formats are ".implode(',',$rExt);
					$ErrFlag = true;
				}
			}
			elseif($FileResult['Type']==2)
			{
				$UploadFile = true;
			}
	
		}
		if($_FILES['Flag']['size'] > 0)
		{
	
		$FileArr_flag = $_FILES['Flag'];	
		$rExt1_flag = array('jpg','jpeg','gif','png');
		$FileObj_flag = new FileUpload();
		$FileResult_flag = $FileObj_flag->AssignAndCheck(array('FileRef'=>$FileArr_flag, 'Extension'=>implode(',', $rExt1_flag),'PathPrefix'=>FACULTYFLAG_PATH));
		if($FileResult_flag['Type']==1)
		{
		$Err['Flag']=$FileResult_flag['Error'];
		$ErrFlag = false;
		if($FileResult_flag['ErrorNo']==1 )
		{
		$Err['Flag'] = "Valid file formats are ".implode(',',$rExt);
		$ErrFlag = true;
		}
		}
		elseif($FileResult_flag['Type']==2)
		{
		$UploadFile_flag = true;
		}
	
		}
			
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		if($_POST['Country']=='INDIA'){
		$_POST['USState']='';
		}
		if($_POST['Country']=='UNITED STATES'){
		$_POST['INDState']='';
		$_POST['City2']='';
		}
		if($_POST['Country']!='UNITED STATES' && $_POST['Country']!='INDIA'){
		$_POST['USState']='';
		$_POST['INDState']='';
		$_POST['City2']='';
		}
		if($_POST['USState']!=''){
		$State = $_POST['USState'];
		}elseif($_POST['INDState']!=''){
		$State = $_POST['INDState'];
		}else{
		$State = $_POST['State'];
		}
		if($_REQUEST['Faculty_id']==''){ ;
		$Faculty_obj = new Faculty();
		$Faculty_obj->Falculty_Type=$_POST['Type'];
		$Faculty_obj->Prefix=$_POST['Prefix'];
		$Faculty_obj->Name=$_POST['Name'];
		$Faculty_obj->Institute=$_POST['Institute'];
		$Faculty_obj->Degree=$_POST['Degree'];
		$Faculty_obj->SEO_Name=$_POST['SEO_Name'];
		$Faculty_obj->Email=$_POST['Email'];
		$Faculty_obj->Zipcode=$_POST['Zipcode'];
		if($_POST['State']=='Maharashtra'){
		$_POST['City']='';
		$Faculty_obj->City=check_input($_POST['City2']);
		}else{
		$_POST['City2']='';
		$Faculty_obj->City=check_input($_POST['City']);
		}	
		$Faculty_obj->State=check_input($State);
		$Faculty_obj->Country=check_input($_POST['Country']);
		$Faculty_obj->Designation=$_POST['Designation'];
		$Faculty_obj->Mobile=$_POST['Mobile'];
		$Faculty_obj->Address=addslashes($_POST['Address']);
		$Faculty_obj->ShortDescription=addslashes($_POST['ShortDescription']);
		$Faculty_obj->Zipcode=$_POST['Zipcode'];
		$Faculty_obj->AddedDate = $sqlDateTime;
		
		if($_REQUEST['Id']==""){
			$ins_Faculty_id = $Faculty_obj->insertFaculty();
		} 
		/*else {
			$Updateresult_query = $Faculty_obj->updateFaculty();
			
		}*/
		
		if($ins_Faculty_id > 0){
		
		$fileName=$ins_Faculty_id;
		
			if($UploadFile)
			{
				$FileObj->AssignFileName($fileName);
				$filepath = $FileObj->Upload();
				$Faculty_obj = new Faculty();
				$Faculty_obj->Faculty_id=$ins_Faculty_id;
				$Faculty_obj->Photo=$filepath;
				$ins_photo = $Faculty_obj->updateFacultyPhoto();////photo ID
			}
			
			if($UploadFile_flag)
			{
				$FileObj_flag->AssignFileName($fileName);
				$filepath_flag = $FileObj_flag->Upload();
				$Faculty_obj = new Faculty();
				$Faculty_obj->faculty_id=$ins_Faculty_id;
				$Faculty_obj->Flag=$filepath_flag;
				$ins_Flag = $Faculty_obj->updateFacultyFlag();
				//@SetUpHtAccess();
			}	
			
		
				?>
					<script>window.top.location.href='faculty.php?fid='+<?=$ins_Faculty_id?>;</script>
				<?
			
		}	
		}else{
		
			$Faculty_obj = new Faculty();
			$Faculty_obj->Faculty_id=$_REQUEST['Faculty_id'];
			$Faculty_obj->Falculty_Type=$_POST['Type'];
			
			if($_POST['State']=='Maharashtra'){
			$_POST['City']='';
			$Faculty_obj->City=check_input($_POST['City2']);
			}else{
			$_POST['City2']='';
			$Faculty_obj->City=check_input($_POST['City']);
			}	
			$Faculty_obj->Country=check_input($_POST['Country']);
			$Faculty_obj->State=check_input($State);

			$Faculty_obj->Prefix=$_POST['Prefix'];
			$Faculty_obj->Name=$_POST['Name'];
			$Faculty_obj->Degree=$_POST['Degree'];
			$Faculty_obj->Institute=$_POST['Institute'];
			$Faculty_obj->SEO_Name=$_POST['SEO_Name'];
			$Faculty_obj->Email=$_POST['Email'];
			$Faculty_obj->Designation=$_POST['Designation'];
			$Faculty_obj->Mobile=$_POST['Mobile'];
			$Faculty_obj->Zipcode=$_POST['Zipcode'];
			$Faculty_obj->Address=addslashes($_POST['Address']);
			$Faculty_obj->ShortDescription=addslashes($_POST['ShortDescription']);
			$Faculty_obj->UpdaedDate = $sqlDateTime;
			
			if($_REQUEST['Id']!=""){
			$Updateresult_query = $Faculty_obj->updateFaculty();
			
			}
			$fileName=$_REQUEST['Faculty_id'];
			
				if($UploadFile)
				{
					$FileObj->AssignFileName($fileName);
					$filepath = $FileObj->Upload();
					
					$Faculty_obj = new Faculty();
					$Faculty_obj->Faculty_id=$_REQUEST['Faculty_id'];
					$Faculty_obj->Photo=$filepath;
					$ins_photo = $Faculty_obj->updateFacultyPhoto();
                
				}
			if($UploadFile_flag)
			{
				
				$FileObj_flag->AssignFileName($fileName);
				$filepath_flag = $FileObj_flag->Upload();
				$Faculty_obj = new Faculty();
				$Faculty_obj->faculty_id=$_REQUEST['Faculty_id'];
				$Faculty_obj->Flag=$filepath_flag;
				$ins_Flag = $Faculty_obj->updateFacultyFlag();
				
			}
		
			
		
				?>
					<script>window.top.location.href='faculty.php?type=<?=$_POST['Type']?>&fid=<?=$_REQUEST['Faculty_id']?>'</script>
				<?
			
			
		}

	}
?>

<style type="text/css">
.boxerror{
	border:1px solid #F00;
}

.texterror{
color:#F00;
}
</style>
<table width="100%" border="0" class="tblouter" cellpadding="0" cellspacing="0">
  <tr class="tblhd">
    <td width="18%" colspan="2"><? if($EId!=''){?>Update <? } else {?>Add New <? }?>Faculty Details</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" align="center">
    
    	<form id="addfacultyfrm" name="addfacultyfrm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="act" id="act" value="Submit" />
        <input type="hidden" name="Faculty_id" id="Faculty_id" value="<?=$_REQUEST['Id'] ?>" />
        <table width="100%" border="0" class="addfacultytbl">
          <tr>
            <td width="12%" align="right">Prefix</td>
            <td width="41%">            	
            	<select class="listbox" style="float:left; width:75px;" id="Prefix" name="Prefix">
                <option value="">Select Prefix</option>
                <option value="Dr" selected="selected">Dr</option>
                <option value="Prof">Prof</option>
                </select>
            	<script type="text/javascript">
					$('#Prefix').val('<?=$Updateresult->Prefix?>');
				</script>
                <span style="float:left; margin-left:15px;">Name <input type="text" style="float:none; width:200px;" class="txtbox2" id="Name" name="Name" value="<?=$Updateresult->Name?>"/></span>
            </td>
            <td align="right">Address</td>
            <td><input type="text" class="txtbox2" id="Address" name="Address" value="<?=$Updateresult->Address?>"/></td>
          </tr>
          <tr>
            <td align="right">Degree</td>
            <td><input type="text" class="txtbox2" id="Degree" name="Degree" value="<?=$Updateresult->Degree?>"/></td>
            <td width="13%" align="right">Country</td>
            <td width="34%">
				<select name="Country" id="Country" class="listbox" onchange="show_state(this.value)">
                    <option value="">--Choose Country--</option>
                    <? 
                    if(count($country_Arr)>0){
                    foreach($country_Arr as $K=>$V){
                    $Country=$Updateresult->Country;
                    
                    ?>
                    <option value="<?=$V?>"  <? if($Country==$V){ ?>selected="selected"<? } ?>  ><?=$V?></option>
                    <?
                    }
                    }
                    ?>
                </select>                
            </td>
          </tr>
          <tr>
            <td align="right">Email&nbsp;</td>
            <td><input type="text" class="txtbox2" id="Email" name="Email" value="<?=$Updateresult->Email?>"/></td>
            <td align="right" id="state_id">State</td>
            <td>
                <span id="usstate_id" style="display:none">
                <select name="USState" id="USState" class="listbox" >
                    <option value="">--Choose State--</option>
                    <? 
                        if(count($usstate_Arr)>0){
                        foreach($usstate_Arr as $K=>$V){
                    ?>
                    <option value="<?=$V?>"  <? if($Updateresult->State==$V){ ?>selected="selected"<? } ?>><?=$V?></option>
                    <?
                            }
                        }
                    ?>
            </select>
            </span>
            
        
            <span id="indstate_id" style="display:none">
            <select name="INDState" id="INDState" class="listbox" onchange="showMState(this.value)">
                    <option value="">--Choose State--</option>
                    <? 
                        if(count($indiastate_Arr)>0){
                        foreach($indiastate_Arr as $K=>$V){
						
                    ?>
                    <option value="<?=$V?>"  <? if($Updateresult->State==$V){ ?>selected="selected"<? } ?>><?=$V?></option>
                    <?
                            }
                        }
                    ?>
            </select>
            </span>
            <span style="display:block" id="state_textid">
            <input type="text" name="State" id="State" class="txtbox2" value="<?=$Updateresult->State ?>" />
            </span>
            </td>
          </tr>
          <tr>
            <td align="right">Designation</td>
            <td><input type="text" class="txtbox2" id="Designation" name="Designation" value="<?=$Updateresult->Designation?>"/></td>
            <td align="right" id="othercity_id">City</td>
            <td>
            
            <span id="mahadis_id" style="display:none">
            <select name="City2" id="City2" class="listbox">
                    <option value="">--Choose State--</option>
                    <? 
                        if(count($ts_maharastraDistrict)>0){
                        foreach($ts_maharastraDistrict as $K=>$V){
						
                    ?>
                    <option value="<?=$V?>"  <? if($Updateresult->City==$V){ ?>selected="selected"<? } ?>><?=$V?></option>
                    <?
                            }
                        }
                    ?>
            </select>
            </span>
            <span style="display:block" id="city_textid">
            <input type="text" class="txtbox2" id="City" name="City" value="<?=$Updateresult->City?>"/>
            </span>
            </td>
          </tr>
          <tr>
            <td align="right">Institute</td>
            <td><input type="text" class="txtbox2" id="Institute" name="Institute" value="<?=$Updateresult->Institute?>"/></td>
            <td align="right">Zipcode</td>
            <td><input type="text" class="txtbox2" id="Zipcode" name="Zipcode" value="<?=$Updateresult->Zipcode?>"/></td>
          </tr>
          <tr>
            <td align="right">Photo</td>
            <td><input type="file" id="Photo" name="Photo"/></td>
            <td align="right">Mobile</td>
            <td><input type="text" class="txtbox2" id="Mobile" name="Mobile" value="<?=$Updateresult->Mobile?>"/></td>
          </tr>
          <tr>
            <td align="right">Flag</td>
            <td><input type="file" id="Flag" name="Flag" /></td>
            <td align="right">SEO Name</td>
            <td><input type="text" class="txtbox2" id="SEO_Name" name="SEO_Name" value="<?=$Updateresult->SEO_Name ?>"/></td>
          </tr>
          <tr>
            <td align="right" id="td_Type">Faculty Type&nbsp;</td>
            <td>
            	<span><input type="radio" id="Type" name="Type" value="IF" <? if($Type== 'IF' || $Updateresult->Type=='IF') { ?> checked="checked" <? } ?> /> International</span> 
            	<span><input type="radio" id="Type" name="Type" value="IN" <? if($Type== 'IN' || $Updateresult->Type=='IN') { ?> checked="checked" <? } ?>/> National</span>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="top">Profile</td>
            <td colspan="3"><textarea class="msgbox" style="width:99%; height:70px" id="ShortDescription" name="ShortDescription"><?=$Updateresult->ShortDescription ?></textarea></td>
          </tr>
          <tr>
            <td colspan="4" align="right">
			<? if($EId!='') { $buttonTxt = "Update"; } else { $buttonTxt = "Submit"; } ?>
            <div class="submitbtn bgred" onclick="submit_faculty();"><?=$buttonTxt?></div>
            </td>
          </tr>
        </table>
    	</form>
    </td>
  </tr>
</table>

<script type="text/javascript">

function submit_faculty() {
	err=0;
	if($('#Name').val()==''){ err=1; $('#Name').addClass('boxerror'); } else{ $('#Name').removeClass('boxerror'); }
	if($('#Country').val()=='') { err=1; $('#Country').addClass('boxerror'); } else { $('#Country').removeClass('boxerror'); }
	if(!$('input[name=Type]:checked').val()){err=1;$("#td_Type").addClass("texterror");}else{$("#Type").removeClass("texterror");}

	if(err==0){		
		document.addfacultyfrm.submit();
	}
}

<? if($Updateresult->State!=''){ ?>
showMState('<?=$Updateresult->State?>');
<? } ?>
function showMState(val){
	
	if(val=='Maharashtra'){
		$('#mahadis_id').show();
		$('#city_textid').hide();
	}else{
		$('#city_textid').show();
		$('#mahadis_id').hide();
	}
}
<? if($Updateresult->Country!=''){ ?>
show_state('<?=$Updateresult->Country?>');
<? } ?>
function show_state(val){
	
	if(val=='UNITED STATES'){
		
		//$('#tndistrict_id').hide();
		$('#othercity_id').show();
		
		$('#usstate_id').show();
		$('#indstate_id').hide();
		$('#state_textid').hide();
		$('#CountryCode').val('1');
		
	}else if(val=='INDIA'){
		$('#indstate_id').show();
		$('#usstate_id').hide();
		$('#state_textid').hide();
		$('#CountryCode').val('91');
		if($('#INDState').val()=='Tamil Nadu' && $('#indstate_id').is(':visible')){
			//$('#tndistrict_id').show();
			$('#othercity_id').hide();
		}else{
			//$('#tndistrict_id').hide();
			$('#othercity_id').show();
		}
		
	}else{
		//$('#tndistrict_id').hide();
		$('#othercity_id').show();
		$('#state_textid').show();
		$('#indstate_id').hide();
		$('#usstate_id').hide();
		
	}
}
</script>

<?
}
include "admin_template.php";
?>