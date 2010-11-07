<?php

class Default_Model_SpcTest extends PHPUnit_Framework_TestCase
{
    public function testClass()
    {
        $spc = new Default_Model_Spc(array('test'));
	$this->assertType('Default_Model_Spc', $spc);
    }
}

?>
