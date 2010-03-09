<?php

class SpcController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $form = new Default_Form_Spc();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $spc = new Default_Model_Spc($form->getValues());
                $spc->findByPassword($spc->getPassword());
                $spc->save();
                //return $this->_helper->redirector('check');
                $this->view->password = $spc->getPassword();
                $this->view->hitcount = $spc->getHitcount();
            }
        }

        $this->view->form = $form;
    }
    
    public function checkAction()
    {
    	// none
    }

}