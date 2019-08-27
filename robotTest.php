<?php
	use PHPUnit\Framework\TestCase;
	use 'robot.php';
	
	class RobotTest extends TestCase
	{
		protected $robot;

		protected function setUp() {
			$action = 'PLACE';
			$x = 0;
			$y = 0;
			$f = 'North';	
			
			$this->robot = new Robot( $action, $x, $y, $f );
		}
		
		/*
		 * First action can only be PLACE
		*/
		public function testFirstAction()
		{
			$this->assertSame('NORTH 0,0', $this->robot->report());
			
			// some ppl prefer 1 test per function. I'm just checking both cases here.
			$action = 'MOVE';
			$this->expectException( new Robot( $action, $x, $y, $f ) );
		}
				
		public function testCoordinates() {
			$action = 'PLACE';
			$x = 6;
			$y = 0;
			$f = 'North';
			$this->expectException( new Robot( $action, $x, $y, $f ) );
			
			$x = 0;
			$y = 6;
			$this->expectException( new Robot( $action, $x, $y, $f ) );
			
			$x = -1;
			$y = 0;
			$this->expectException( new Robot( $action, $x, $y, $f ) );
			
			$x = 0;
			$y = -1;
			$this->expectException( new Robot( $action, $x, $y, $f ) );
		}
		
		public function testOrientation() {
			$action = 'PLACE';
			$x = 0;
			$y = 0;
			$f = 'Random';
			$this->expectException( new Robot( $action, $x, $y, $f ) );
			
			$f = '';
			$this->expectException( new Robot( $action, $x, $y, $f ) );
			
			$f = 0;
			$this->expectException( new Robot( $action, $x, $y, $f ) );
		}
		
		public function testTurn() {			
			$this->robot->turn('right');
			
			$this->assertSame( 'EAST 0,0', $this->robot->report() );
			$this->robot->turn('right');
			$this->assertSame( 'SOUTH 0,0', $this->robot->report() );
			
			$this->assertFalse( $this->robot->turn('south') );
		}
		
		public function testMove() {
			$this->robot->move();
			
			$this->assertSame( 'NORTH 0,1', $this->robot->report() );
		}
		
		public function testRemainOnTable() {
			$this->robot->turn('left');
			$this->assertFalse( $this->robot->move() );
		}
	}
?>