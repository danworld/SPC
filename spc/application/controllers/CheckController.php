<?php

class CheckController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

	public function indexAction()
    {
        $spc = new Default_Model_Spc();
        $this->view->entries = $spc->fetchAll();
    }
}

