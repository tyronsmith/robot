<?php
	class Robot {
		private $orient;
		private $posX;
		private $posY;
		
		public function __construct( $action, $x, $y, $orientation ) {
			
			// make sure the action = place. I'm being kind and allowing all casing
			if (strtolower($action) !== 'place') {
				throw new Exception('First action of robot must be "PLACE" but is '.$action);
			}
			
			// validate x and y
			if ( !$this->validateCoords( $x, $y ) ) {
				throw new Exception('Invalid coordinates');
			}
			
			if ( !$this->validateOrientation( $orientation )) {
				throw new Exception('Invalid orientation');
			}
			
			// set the robot information
			$this->orient = strtolower($orientation);
			$this->posX = (int)$x;
			$this->posY = (int)$y;
		}
		
		private function validateCoords( $x, $y ) {
			// 0 based so our 5 x 5 table is actually 0 - 4
			if ( $x < 0 || $x > 4 || $y < 0 || $y > 4 ) {
				echo 'Robot is outside of bounds of table';
				return false;
			}
			
			return true;
		}
		
		private function validateOrientation( $orientation ) {
			$orientation = strtolower($orientation);
			
			if ( $orientation !== 'north' && $orientation !== 'south' && $orientation !== 'east' && $orientation !== 'west' ) {
				echo 'Orientation must be North, South, East or West but is '.$orientation;
				return false;
			}
			
			return true;
		}
		
		private function validateDirection( $direction ) {
			if ( $direction !== 'right' && $direction !== 'left' ) {
				echo "Direction needs to be Left or Right but is $direction";
				return false;
			}
			
			return true;
		}
		
		public function turn( $direction ) {
			// handling casing for direction
			$direction = strtolower($direction);
			
			if ( !$this->validateDirection( $direction ) ) {
				return false;
			}
			
			// no need for a default orient because we have validated it already.
			switch ($this->orient) {
				case 'north' :
					if ( $direction === 'left' ) {
						$this->orient = 'west';
					} else { // passed validate so must be right
						$this->orient = 'east';
					}
					break;
				case 'south' :
					if ( $direction === 'left' ) {
						$this->orient = 'east';
					} else { // passed validate so must be right
						$this->orient = 'west';
					}
					break;
				case 'east' :
					if ( $direction === 'left' ) {
						$this->orient = 'north';
					} else { // passed validate so must be right
						$this->orient = 'south';
					}
					break;
				case 'west' :
					if ( $direction === 'left' ) {
						$this->orient = 'south';
					} else { // passed validate so must be right
						$this->orient = 'north';
					}
					break;
			}
			
			return true;
		}
		
		public function move() {
			switch ($this->orient) {
				case 'north' :
					if ($this->posY === 4) {
						return false;
					} else {
						$this->posY++;
					}
					break;
				case 'south' :
					if ($this->posY === 0) {
						return false;
					} else {
						$this->posY--;
					}
					break;
				case 'east' :
					if ($this->posX === 4) {
						return false;
					} else {
						$this->posX++;
					}
					break;
				case 'west' :
					if ($this->posX === 0) {
						return false;
					} else {
						$this->posX--;
					}
					break;
			}
			
			return true;
		}
		
		public function report() {
			echo $this->posX.','.$this->posY.','.strtoupper($this->orient);
		}
		
	}
?>