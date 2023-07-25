<?
include "includes.php";
?>

    <table width="97%" border="0" cellspacing="0" cellpadding="0" style="margin:15px auto; ">
      <tr>
        <td>
			
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="download_tbl2" >
                      <tr>
                        <th width="160">Title</th>
                        <th>Description</th>
                        <th width="100">File Type</th>
                        <th width="100">Download</th>
                       
                      </tr>
            
              <input type="hidden" name="page_limit" id="page_limit" value="<?=$PageLimit?>" />
              <input type="hidden" name="grade_id" id="grade_id" value="<?=$gradeId?>" />
              <input type="hidden" name="student_id" id="student_id" value="<?=$student_id?>" />
               <input type="hidden" name="page" id="page" value="<?=$page?>" />
            <?
			//parmeter of this method is $params=array(),$orderby,$sortby
			
		   $i=0;
		 	if(count($rs_downloadArr)>0)
			{
			foreach($rs_downloadArr as $DK=>$DV)
				{
					$filesArr=explode(',',$DV->files);
			   ?>
				<div>
                      <tr>
                        <td valign="top"><?=$DV->filename?></td>
                        <td valign="top"><p style="text-align:justify; font-size:16px; letter-spacing:-0.5px; line-height:22px; width:96%; float:left; padding:0 2%;"><?=$DV->description?></p></td>
                         <td valign="top" align="center">
						<?
						if(count($filesArr)>0)
							{
								foreach($filesArr as $FK=>$FV)
								{
								  $fileType=explode('.',$FV);
                      			  echo $fileType[1];
								  
								}
							}
						?>
                        </td>
                        <td width="60" align="center" valign="top">
                        <?
							if(count($filesArr)>0)
							{
								$j=1;
								foreach($filesArr as $FK=>$FV)
								{
									?>
									<a href="<?=DOWNLOAD_FILE_HREF.$FV?>" target="_blank"><img src="images/download_icon.png" alt="" style=" margin:5px 0 10px 0;" /></a>
									<?
									$j++;
									$fileType=explode('.',$FV);
								}
							}
                        ?>
                        </td>
                       
                      </tr>

				</div>
				<?
				$i++;}
				}
				if($rsPagination!='')
				{
				?>
                	<tr>
                    	<td colspan="4"><?=$rsPagination?></td>
                    </tr>
                <?	
				}
            else
				{}
		?>
        
                    </table>
        
        </td>
      </tr>
    </table>
<script type="text/javascript" language="javascript">
function parentDownLoadPaging(page,as)
{
	
	var page_limit = $('#page_limit').val(); 
	var grade_id=$('#grade_id').val();
	var student_id=$('#student_id').val();
	$("#studentslistdtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
	ajax({
		a:'student_process',
		b:'act=getDownloads&page='+page+'&page_limit='+page_limit+'&student_id='+student_id+'&grade_id='+grade_id,
		c:function(){},
		d:function(data){
			$("#student_content").html(data);
		}
	});
	
}
function onMultipleFileDownload(id)
{
		var paramData={"act":"multipleDownload","id":id}
		ajax({
				a:'student_process',
				b:$.param(paramData),
				c:function(){},
				d:function(data){
						
								}
			})
}
</script>