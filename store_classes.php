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
		fwrite($fh, PHP_EOL . PHP_EOL . "---------------------------------------------------------------------------------------------------------------------" . PHP_EOL);
		fwrite($fh, date("m/d/Y h:i:s a", time()) . ": storing classes" . PHP_EOL);

		// arrays
        $days_array = $_GET['days_array'];
        $classes_array = $_GET['classes_array'];
        $css_top_array = $_GET['css_top_array'];
        $css_left_array = $_GET['css_left_array'];
        $css_bg_array = $_GET['css_bg_array'];
        $css_fore_array = $_GET['css_fore_array'];
        $css_width_array = $_GET['css_width_array'];

		// handle connection
		$connection = include 'connection.php';
		if ($connection == null) {
			fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#35 (store_classes.php): Can't get classes: " . PHP_EOL);
		}
		else {
			// emptyDB($fh, $connection);
			// store classes
			emptyTable($fh,$connection,'classes');
			for ($i=0; $i < count($classes_array); $i++) {
				// add class
				$class = $classes_array[$i];
				$css_top = $css_top_array[$i];
				$css_left = $css_left_array[$i];
				$css_bg = $css_bg_array[$i];
				$css_fore = $css_fore_array[$i];
				$css_width = $css_width_array[$i];
				$dayID = getClassDayID($fh, $connection, $days_array[$i]);
				$class_id = addClass($fh, $connection, $class, $css_top, $css_left, $css_bg, $css_fore, $css_width, $dayID);
			}
		}
		fclose($fh);
	}

?>
