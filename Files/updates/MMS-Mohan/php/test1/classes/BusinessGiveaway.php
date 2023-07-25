<?
class BusinessGiveaway
{

var $Name;
var $EmailAddress;
var $Password;
var $Website;


		function insertBusinessGiveaway()	{
				
			$today=time();
			$sqlDateTime = date('Y-m-d H:i:s',$today);
		
			$query="INSERT INTO `".TBL_BUSINESS_GIVEAWAY."` 				
					(`GiveawayId`,`BusinessId`,`NumberOfDays`,`Features`,`FbPage`,`Tweet`,`TwUsername`,`BlogUrl`,
					`SubscribeNewsletter`,`Plan`,`Points`,`StartDate`,`EndDate`,`PaidAmount`,`AddedDate`) 
					VALUES ('$this->Giveaway_id','$this->Business_Id','$this->day','$this->Features','$this->Fb_page ',
					'$this->Tweet','$this->TwUsername','$this->Blog_url','$this->SubscribeNewsletter','$this->Plan',
					'$this->Points','$this->StartDate','$this->EndDate','$this->PaidAmount','$sqlDateTime')";	
						
			 $insertId=dB::insertSql($query);
			 return $insertId; 
		}

		function updateBusinessGiveaway()	{
			$today=time();
			$sqlDateTime = date('Y-m-d H:i:s',$today);
			$query="Update ".TBL_BUSINEE_GIVEAWAY." set  
			        `BillStartDate`='".$this->BillStartDate."',
					`Features`='".$this->Features."',
					`NumberOfDays`='".$this->day."',
					`StartDate`='".$this->StartDate."',
					`EndDate`='".$this->EndDate."',
					`PaidAmount`='".$this->PaidAmount."',
					`FbPage`='".$this->FbPage."',
					`TwUsername`='".$this->TwUsername."',
					`SubscribeNewsletter`='".$this->SubscribeNewsletter."',
					`Plan`='".$this->Plan."',
					`UpdatedDate`='".$sqlDateTime."' where `Id`='".$this->Id."'";
			$rs_Upd = dB::updateSql($query);
			return $rs_Upd; 
		
		}
	
		
	

	    function getBusinessGiveawayDtl() 	{
			if($this->Date!='') $sub_qry[] ="`Date`='".$this->Date."'";
			if($this->Giveaway_id!='') $sub_qry[] ="`Giveaway_id`='".$this->Giveaway_id."'";
			if($this->id!='') $sub_qry[] .= " Id= '".$this->id."'";
			if($this->BusinessId!='') $sub_qry[] .= " BusinessId= '".$this->BusinessId."'";
			if($this->fields=='') $this->fields='*';
			if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
			if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
			$query="select ".$this->fields." from `".TBL_BUSINEE_GIVEAWAY."` ".$subqry;	
			if($this->id=='')
			return dB::mExecuteSql($query);			
			else
			return dB::sExecuteSql($query);	
		}

		function isBusinessGiveawayActive() { 
				$query="select * from ".TBL_BUSINESS_GIVEAWAY." where  
						BusinessId = ".$this->BusinessId. " and ( ((`StartDate` > '".date('Y-m-d 00:00:00')."' 
						or `EndDate` > '".date('Y-m-d 00:00:00')."' ) or (`StartDate` <= '".date('Y-m-d 00:00:00')."' 
						and `EndDate` > '".date('Y-m-d 00:00:00')."')) or ((`StartDate` = '".date('Y-m-d 00:00:00')."'
						or `EndDate` = '".date('Y-m-d 00:00:00')."') or (`StartDate` < '".date('Y-m-d 00:00:00')."' 
						and `EndDate` >= '".date('Y-m-d 00:00:00')."')))";	
				if(dB::getNumRows($query)>0) return true;
				return false;
		}

		function hasBusinessGiveawayPast() { 
				 $query="select * from ".TBL_BUSINESS_GIVEAWAY." where  
						 BusinessId = ".$this->BusinessId. " and 
						 ((`StartDate` < '".date('Y-m-d 00:00:00')."' or `EndDate` < '".date('Y-m-d 00:00:00')."'))";	
				return dB::getNumRows($query);
		}

		function getBusinessGiveaways() {
				if($this->type=='upcoming') 
					$sub_qry = " and ((`StartDate` > '".date('Y-m-d 00:00:00')."' or `EndDate` > '".date('Y-m-d 00:00:00')."' )
								or (`StartDate` <= '".date('Y-m-d 00:00:00')."' and `EndDate` > '".date('Y-m-d 00:00:00')."'))";
				if($this->type=='current')
					$sub_qry = " and  ((`StartDate` = '".date('Y-m-d 00:00:00')."' or `EndDate` = '".date('Y-m-d 00:00:00')."') 
								or (`StartDate` < '".date('Y-m-d 00:00:00')."' and `EndDate` >= '".date('Y-m-d 00:00:00')."'))";
				if($this->type=='past')
					$sub_qry = " and (`StartDate` < '".date('Y-m-d 00:00:00')."' or `EndDate` < '".date('Y-m-d 00:00:00')."')";
				$query="select * from ".TBL_BUSINESS_GIVEAWAY." where  BusinessId = ".$this->BusinessId.$sub_qry;	
				return dB::mExecuteSql($query);	
		}

		function getBusinessGiveawayPlan() {
			 $query="select * from ".TBL_BUSINESS_GIVEAWAY." where  BusinessId = ".$this->BusinessId." Order by Id Desc LIMIT 0,1 ";	
			 return dB::sExecuteSql($query);	
		}



}
