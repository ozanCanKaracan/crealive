<?php

if(!$_GET){
	 include('views/index.php');
}else{
        //roles/role_list
        //file_exists("views/{$_GET['target']}.php");
        //include ("views/{$_GET['target']}.php");
	switch(@$_GET['target']){
		case '': include('views/index.php');  break;
	}
    switch (@$_GET['target']){
        case 'roles':include('views/roles/roles.php');
    }
}
