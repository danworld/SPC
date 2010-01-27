<?php

class SpcController extends Zend_Controller_Action
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

    public function checkAction()
    {
        $request = $this->getRequest();
        $form = new Default_Form_Spc();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $spc = new Default_Model_Spc($form->getValues());
                $spc->save();
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

}