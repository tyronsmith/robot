<?php
	use PHPUnit\Framework\TestCase;

	class RobotTest extends TestCase
	{
		protected $robot;

		protected function setUp()
		{
		}
		
		/*
		 * First action can only be PLACE
		*/
		public function testFirstAction()
		{
			$action = 'PLACE';
			$x = 0;
			$y = 0;
			$f = 'North';
			$this->robot = new Robot( $action, $x, $y, $f );
			
			$this->assertTrue( $this-> robot );
			
			// some ppl prefer 1 test per function. I'm just checking both cases here.
			$action = 'MOVE';
			$this->assertFalse( $this-> robot );
		}
		
		public function testSubsequentActions()
		{
			$action = 'PLACE';
			$x = 0;
			$y = 0;
			$f = 'North';
			$this->robot = new Robot( $action, $x, $y, $f );
			
			$this->assertTrue( $this->robot );
			$this->assertTrue( $this->robot );
		}
	}
?>