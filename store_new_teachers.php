<?php
	require 'functions.php';

	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// log file
	$file = "output.txt";
	// check if file exists
	if (!file_exists($file)) {
		print 'ERROR (store_new_teachers.php): File not found';
	}
	// check if file can be opened (permissions etc)
	else if (!$fh = fopen($file, 'a')) {
		print 'ERROR (store_new_teachers.php): Can\'t open file';
	}
	else if (isset($_GET['teachers_array'])) {
		// writing to log file
		fwrite($fh, PHP_EOL . PHP_EOL . "---------------------------------------------------------------------------------------------------------------------" . PHP_EOL);
		fwrite($fh, date("m/d/Y h:i:s a", time()) . ": storing new teachers" . PHP_EOL);

		// arrays
        $teachers_array = $_GET['teachers_array'];
        $css_bg_array = $_GET['css_bg_array'];
        $css_fore_array = $_GET['css_fore_array'];

		// handle connection
		$connection = include 'connection.php';
		if ($connection == null) {
			fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#31 (store_new_teachers.php): Connection error: " . PHP_EOL);
		}
		else {
			emptyTable($fh,$connection,'teachers_lst');
			// store new teachers
			for ($i=0; $i < count($teachers_array); $i++) {
				// add teacher
				$teacher = $teachers_array[$i];
				$css_bg = $css_bg_array[$i];
				$css_fore = $css_fore_array[$i];
				addTeacherList($fh, $connection, $teacher, $css_bg, $css_fore);
			}
		}
		fclose($fh);
	} else {
	}

?>
