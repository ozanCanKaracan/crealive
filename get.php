<?php

if(!$_GET){
	 include('views/index.php');
}else{
	switch(@$_GET['target']){
		case '': include('views/index.php');  break;
	}
}
