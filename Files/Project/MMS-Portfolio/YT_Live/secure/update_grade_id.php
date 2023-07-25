<?

include "includes.php";


$query = "select * from student where grade_id!='0'";
$result = dB::mExecuteSql($query);

if(count($result)>0) {
	foreach($result as $K=>$V) { echo ($K+1)."==";echo "<br>";
		echo $student_name = $V->first_name." ".$V->middle_name." ".$V->last_name; echo "<br>";
		//echo $query = "UPDATE circular_mail_log set grade_id = '".$V->grade_id."' where `student_name`='".$student_name."'"; echo "<hr>";
		echo $query = "UPDATE circular_mail_log set grade_id = '".$V->grade_id."', mail_sent_id = '".$V->id."' where (`email_address`='".$V->father_email."' or `email_address`='".$V->mother_email."' or `email_address`='".$V->email_address."') and mail_type='S' and student_name='".$student_name."'";   echo "<hr>";
		dB::updateSql($query);
	}
}


?>