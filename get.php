<?php

if(!$_GET){
	 include('views/index.php');
}else{
	switch(@$_GET['target']){
		case '': include('views/index.php');  break;
        case 'roles':include('views/roles/roles.php'); break;
        case 'editRole':include('views/roles/editRole.php'); break;

    }
}
//	 include('views/index.php');
//}else{
//    if( file_exists("views/{$_GET['target']}.php")){
//        include ("views/{$_GET['target']}.php");
//    }else{
//        include('views/404/404.php');
//    }
//}