<?
  class Admin
  {
     
	 var $admin_uname;
	 var $admin_pass;
	  
	 function admin($username='', $password='')
	 {
	    $this->username=$username;
		$this->password=$password;
	 }    
	 
	 function getAdmin()
	 {
         $admin_qry ="select * from `".TBL_SITESETTINGS."` where AdminUname= '".$this->username."' and AdminPass  = '".$this->password."'";
	     return  $adminRes=dB::sExecuteSql($admin_qry);
	  
	  }

	
	
	
	

  }
?>