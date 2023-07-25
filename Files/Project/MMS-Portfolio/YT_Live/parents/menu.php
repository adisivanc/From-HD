<div class="panel_left">
    	<ul>
            <li> <a href="#" class="panal_menu">Child's Profile <img src="images/arrow_down.png" alt="v" /></a> 
            	<ul class="students_list">
                	
                    <? 
					$studentDtls = $_SESSION['students'];
					foreach($studentDtls as $K=>$V) 
						{
							
						?>
                        
						<li onclick="getStudentScreen(<?=$K?>);getBasicDetai(<?=$K?>);"><?php echo $V['name'];?></li>
						
						<?
						}
						$rsStudenttDtl = explode(',',$V['sibling']);
							//print_r($rsStudenttDtl);
							$count = count($rsStudenttDtl);
							foreach($rsStudenttDtl as $K1 => $V1)
							{
							  
							  $sibDtl = Student::getStudentById($V1);
							  $sibs = $sibDtl->first_name.' '.$sibDtl->middle_name.' '.$sibDtl->last_name;
						?>
						<li onclick="getStudentScreen(<?=$V1?>);getBasicDetai(<?=$V1?>);"><?php echo $sibs;?></li>
						<?
						}
						
						?>
                </ul>
            </li>
            
            <li onClick="getStudentContact('<?=$_SESSION['studentId']?>')" style="cursor:pointer">Contact Details</li>
            <li><a href="#" class="panal_menu">Settings</a>
            	<ul class="students_list">
                	<?
            			$user_email = $_SESSION['user_email'];
			
					?>
                	<li onclick="changePassword('<?=$user_email?>')">Change Password</li>
                </ul>
            </li>
          <li> <a href="logout.php">Logout</a></li>
        </ul>
    </div>