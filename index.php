<?php

	include 'robot.php';

	// open the file for reading
	$fh = fopen('instructions.txt', 'r');
	
	// read the first line to create the robot
	$instruction = fgets($fh);
	
	// I'm going to explode the line on space to get 2 details; action and location.
	$data = explode(' ', $instruction);
	
	// make sure there are 2 "details"
	if ( count($data) !== 2 ) {
		fclose($fh);
		echo 'First instruction is not formatted correctly';
		exit;
	}		
	
	$action = $data[0];
	
	// now explde the second paramater to get the x, y and facing details
	$location = explode(',', $data[1]);
	
	// make sure we have x, y & "Facing" details
	if ( count($location) !== 3 ) {
		fclose($fh);
		echo 'First instruction is missing an x, y or "facing" detail';
		exit;
	}
	
	// instantiate our robot
	try {
		$robot = new Robot( trim($action), trim($location[0]), trim($location[1]), trim($location[2]) );
	} catch (Exception $e) {
		fclose($fh);
		// failed to create the robot class
		echo $e->getMessage();
		exit;
	}
	
	while (($instruction = fgets($fh)) !== false) {
		// I'm being "polite" and handling the casing of the instruction
		$instruction = trim(strtolower($instruction));
		
        switch ( $instruction ) {
			case 'move' :
				if ( !$robot->move() ) {
					echo "The robot cannot move in it's current orientation or it will fall off the table";
				}
				break;
			case 'left' :
			case 'right' :
				$robot->turn( $instruction );
				break;
			case 'report' :
				$robot->report();
				break;				
			default :
				echo 'Unknown instruction '.$instruction;
				break;
		}
    }

    fclose($fh);
?>