<?php

if(!$_GET){
	 include('views/index.php');
}else{
	
	switch(@$_GET['target']){
		case '': include('views/index.php');  break;
		case 'company_add':
			$check_per = checkPer($_GET['target']);
			if($check_per) {
				include('views/company/company_add.php');
				break;
			} else {
				echo "<script>window.location.href = '".site_url."';</script>";
			}
		case 'companies': 
			$check_per = checkPer($_GET['target']);
			if($check_per) {
				include('views/company/companies.php');
				break;
			} else {
				echo "<script>window.location.href = '".site_url."';</script>";
			}
		case 'storelist': 
			$check_per = checkPer($_GET['target']);
			if($check_per) {
				include('views/stores/storelist.php');
				break;
			} else {
				echo "<script>window.location.href = '".site_url."';</script>";
			}
			case 'timelist': 
				$check_per = checkPer($_GET['target']);
				if($check_per) {
					include('views/employee/timelist.php');
					break;
				} else {
					echo "<script>window.location.href = '".site_url."';</script>";
				}
			case 'timelistMonth': include('views/employee/timelistMonth.php');  break;
			case 'employeelist': include('views/employee/employeelist.php');  break;
			case 'approve': include('views/employee/approve.php');  break;

			case 'permission': 
			$check_per = checkPer($_GET['target']);
			if($check_per) {
				include('views/permission/permission.php');
				break;
			} else {
				echo "<script>window.location.href = '".site_url."';</script>";
			}
    
			case 'userlist': 
			$check_per = checkPer($_GET['target']);
			if($check_per) {
				include('views/employee/user_list.php');
				break;
			} else {
				echo "<script>window.location.href = '".site_url."';</script>";
			}
    }
}

