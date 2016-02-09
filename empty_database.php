<?php
	require 'functions.php';

	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// log file
	$file = "output.txt";
	// check if file exists
	if (!file_exists($file)) {
		print 'ERROR (empty_database.php): File not found';
	}
	// check if file can be opened (permissions etc)
	else if (!$fh = fopen($file, 'a')) {
		print 'ERROR (empty_database.php): Can\'t open file';
	}
	else {
		// writing to log file
		fwrite($fh, PHP_EOL . PHP_EOL . "---------------------------------------------------------------------------------------------------------------------");
		fwrite($fh, date("m/d/Y h:i:s a", time()) . ": emptying the 'classes' and 'timeslots' tables" . PHP_EOL);
		// arrays
		$days_array = array();
		$start_array = array();
		$end_array = array();
		$classes_array = array();

		// handle connection
		$connection = include 'connection.php';
		if ($connection == null) {
			fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#31 (empty_database.php): Cannot connect" . $sql . " == " . $connection->error . PHP_EOL);
		}
		else {
			// delete from classes
			$sql = "DELETE FROM classes;";

			if ($connection->query($sql) === TRUE) {
			    echo "All classes deleted";
			} else {
				fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#40 (empty_database.php): Couldn\'t delete class" . $sql . " == " . $connection->error . PHP_EOL);
			}

			// delete from timeslots
			$sql = "DELETE FROM timeslots;";

			if ($connection->query($sql) === TRUE) {
			    echo "All timeslots deleted successfully";
			} else {
				fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#49 (empty_database.php): Couldn\'t delete timeslot: " . $sql . " == " . $connection->error . PHP_EOL);
			}
		}
		fclose($fh);
	}

?>
