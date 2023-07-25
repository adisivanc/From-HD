<?
	
	$SessionDateArr = array('May 31,2014'=>'2014-05-31','Jun 01,2014'=>'2014-06-01');
	$SessionDate=array();
	$Session=array();
		foreach($SessionDateArr as $KK=>$VV){
			
			$Commitment=array();
			
			$chk_Obj = new Schedule();
			$chk_Obj->SpeakerLK=$fid;
			$chk_Obj->SessionDate=$VV;
			$chk_Obj->sortby="asc";
			$chk_Obj->orderby="fromtime_format";
			$chk_Obj->sorderby="NO";
			$rs_TalksDtls = $chk_Obj->getTalksDtl();
			
			if(count($rs_TalksDtls)>0){	
			foreach($rs_TalksDtls as $k=>$v){
			$chk_Obj= new Schedule(); 
			$chk_Obj->id = $v->SId;
			$rs_SessionDtls = $chk_Obj->getScheduleDtl();
			$Commitment[]=array('Timestamp'=>($v->fromtime_format),
								'FromTime'=>($v->FromTime),
								'ToTime'=>$v->ToTime,
								'Type'=>'Speaker',
								'PersonType'=>'Speaker',
								'Id'=>$v->Id,
								'Topic'=>$v->Topic,
								'SpeakingTime'=>$v->SpeakingTime,
								'SId'=>$v->SId,
								'SessionName'=>$rs_SessionDtls->Title,
								'SubSessionName'=>$rs_SessionDtls->SubTitle,
								'Remarks'=>$v->Remarks,
								'SessionDate'=>$v->SessionDate);
			}
			}

			//get session cat dtl
			$chk_Obj = new Schedule();
			$chk_Obj->ChairPersonsLK=$fid;
			$chk_Obj->SessionDate=$VV;
			$chk_Obj->sorderby="NO";
			$rs_SessionDtls = $chk_Obj->getScheduleDtl();
			
			if(count($rs_SessionDtls)>0){	
			foreach($rs_SessionDtls as $k=>$v){
			$chk_Obj = new Schedule();
			$chk_Obj->SId= $v->Id;
			$rsTalks = $chk_Obj->getTalksDtl();					
			$talk_topics=array();
			foreach($rsTalks as $tk=>$tv) {
			   $talk_topics[]='<li>'.$tv->Topic.'</li>';	
			}

			$Commitment[]=array('Timestamp'=>($v->fromtime_format),'FromTime'=>$v->FromTime,'ToTime'=>$v->ToTime,'Type'=>'Chair','Id'=>$v->Id,
								'SessionName'=>$v->Title,'SubSessionName'=>$v->SubTitle,'PersonType'=>$v->PersonType,'SessionDate'=>$v->SessionDate,'Topic'=>'<ul>'.implode('<br/>',$talk_topics).'</ul>');
			}
							
			}
			
			if(count($Commitment)>0) {
			$timearr = array();
			foreach ($Commitment as $key => $row)
			{
				$timearr[$key] = $row['Timestamp'];
			}
			array_multisort($timearr, SORT_ASC, $Commitment);
			
			$Session[]=$Commitment;
			$SessionDate[]=$KK;
			}
		}
									
?>