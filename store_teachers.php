<?php
	require 'functions.php';

	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// log file
	$file = "output.txt";
	// check if file exists
	if (!file_exists($file)) {
		print 'ERROR (get_data.php): File not found';
	}
	// check if file can be opened (permissions etc)
	else if (!$fh = fopen($file, 'a')) {
		print 'ERROR (get_data.php): Can\'t open file';
	}
	else if (isset($_GET['days_array'])) {
		// writing to log file
		fwrite($fh, PHP_EOL . PHP_EOL . "---------------------------------------------------------------------------------------------------------------------");
		fwrite($fh, date("m/d/Y h:i:s a", time()) . ": storing teachers" . PHP_EOL);

		// arrays
        $teachers_array = $_GET['teachers_array'];
        $days_array = $_GET['days_array'];
        $css_top_array = $_GET['css_top_array'];
        $css_left_array = $_GET['css_left_array'];
        $css_bg_array = $_GET['css_bg_array'];
        $css_fore_array = $_GET['css_fore_array'];

		// handle connection
		$connection = include 'connection.php';
		if ($connection == null) {
			fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#34 (get_data.php): Error while connecting to server: " . PHP_EOL);
		}
		else {
			emptyTable($fh,$connection,'teachers');
			// store teachers
			for ($i=0; $i < count($teachers_array); $i++) {
				// add teacher
				$teacher = $teachers_array[$i];
				$css_top = $css_top_array[$i];
				$css_left = $css_left_array[$i];
				$css_bg = $css_bg_array[$i];
				$css_fore = $css_fore_array[$i];
				
				fwrite($fh,"TEACHER: ".$teacher. " ".$days_array[$i]."\n");
				
				$dayID = getTeacherDayID($fh, $connection, $days_array[$i]);
				
				addTeacher($fh, $connection, $teacher, $css_top, $css_left, $css_bg, $css_fore, $dayID);
			}
		}
		fclose($fh);
	} else {
	}

?>
