<?
  class Giveaway
  {
     
	 var $Name;
	 var $Prize;
	 var $StartDate;
	 var $EndDate;
	 var $AcceptedEntries;
	 var $Giveaway_id;
	 
	function insertGiveaway()
	{
			
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
     $query="INSERT INTO `".TBL_GIVEAWAYS."` (`Date`,`BusinessGiveawayId`,`PrizeMoney`,`Added_date`) VALUES ('$this->Date','$this->business_ga_id','$this->PrizeMoney','$sqlDateTime')";			
	   $insertId=dB::insertSql($query);

		return $insertId; 
		
	}
	
	function updategiveaway()
	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		  $query="Update ".TBL_GIVEAWAYS." set  `Date`='".$this->Date."',`BusinessGiveawayId`='".$this->business_ga_id."',`PrizeMoney`='".$this->PrizeMoney."',`updated_date`='".$sqlDateTime."' where `Id`='".$this->Id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	
	
	function getGiveawayDtl() {
		if($this->Date!='') $sub_qry[] ="`Date`='".$this->Date."'";
		if($this->type=='upcoming') $sub_qry[] ="`Date`> '".date('Y-m-d')."'";
		if($this->type=='current') $sub_qry[] ="`Date` = '".date('Y-m-d')."'";
		if($this->type=='past') $sub_qry[] ="`Date` < '".date('Y-m-d')."'";
		
		if($this->Giveaway_id!='') $sub_qry[] ="`Giveaway_id`='".$this->Giveaway_id."'";
		if($this->id!='') $sub_qry[] .= " Id=".$this->id;
		if($this->businessga_id!='') $sub_qry[]= '(BusinessGiveawayId like "%,'.$this->businessga_id.'"  OR BusinessGiveawayId like "%,'.$this->businessga_id.',%"  OR BusinessGiveawayId like "'.$this->businessga_id.',%" OR BusinessGiveawayId="'.$this->businessga_id.'")';
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		echo $query="select ".$this->fields." from ".TBL_GIVEAWAYS." ".$subqry. ' order by Date desc ';	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}
	
	
	
	function insertGiveawayEntries()
	{
			
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
	
		$query="INSERT INTO `".TBL_BUSINEE_GIVEAWAY."` (`GiveawayId`,`BusinessId`,`NumberOfDays`,`Features`,`FbPage`,`Tweet`,`TwUsername`,`BlogUrl`,`SubscribeNewsletter`,`Plan`,`Points`,`CardNumber`,`CardName`,`ExpirationMonth`,`ExpirationYear`,`CVV`,`StartDate`,`EndDate`,`PaidAmount`,`AddedDate`) VALUES ('$this->Giveaway_id','$this->Business_Id','$this->day','$this->Features','$this->Fb_page ','$this->Tweet','$this->TwUsername','$this->Blog_url','$this->SubscribeNewsletter','$this->Plan','$this->Points','$this->CardNumber','$this->CardName','$this->ExpirationMonth','$this->ExpirationYear','$this->cvc','$this->StartDate','$this->EndDate','$this->PaidAmount','$sqlDateTime')";	
			
			
					
	  $insertId=dB::insertSql($query);

		return $insertId; 
		
	}

	function DeleteOptionDtl()
	{
	
	  $query="delete from `".TBL_GIVEAWAY_ACCEPTEDENTRY."` where Id  ='".$this->Id ."'";	
	return dB::deleteSql($query);	
	}	
	function DeleteGivewaayDtl()
	{
	
	   $query="delete from `".TBL_BUSINEE_GIVEAWAY."` where Id  ='".$this->Id ."'";	
		return dB::deleteSql($query);	
	}	
	function DelG_wayDtl()
	{
	
	   $query="delete from `".TBL_GIVEAWAYS."` where BusinessGiveawayId  ='".$this->Id ."'";	
		return dB::deleteSql($query);	
	}


	
	function getWinner() {
		
		$query="select * from ".TBL_GIVEAWAYS." where Id = ".$this->GiveawayId." and WinnerId!=0";	
		return dB::sExecuteSql($query);	
		
	}
	
	function update_giveawaybyfield() {

		$query=" update ".TBL_GIVEAWAYS." set ".$this->field." = '".$this->fieldvalue."' where `Id`='".$this->id."'";
		return dB::updateSql($query);
	}

	
	}
