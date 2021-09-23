<?php 	



	// DB Information  - NOTE: Also in the core "search" directory. Be sure to change both.
	DEFINE('DB_DETAILS', true);
	DEFINE('DB_HOST', "localhost");
	DEFINE('DB_USER', "root");
	DEFINE('DB_PASS', "");
	DEFINE('DB_NAME', "pfill_homestead");

	// DB Connection
	if(!$c = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
		echo ("We couldn't establish a connection to your MySQL server.");
		die;	
	}

	if(!mysqli_select_db(DB_NAME, $c)) {
		echo ("We couldn't establish a connection to your MySQL database (16).");
		die;
	}














/*



	// DB Information  - NOTE: Also in the core "search" directory. Be sure to change both.
	DEFINE('DB_DETAILS', true);
	DEFINE('DB_HOST', "localhost");
	DEFINE('DB_USER', "pfill_data1");
	DEFINE('DB_PASS', "Q3gNY4jyzH7V");
	DEFINE('DB_NAME', "pfill_data");

	// DB Connection
	if(!$c = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
		echo ("We couldn't establish a connection to your MySQL server.");
		die;	
	}

	if(!mysqli_select_db(DB_NAME, $c)) {
		echo ("We couldn't establish a connection to your MySQL database (16).");
		die;
	}
    */