<?php

class Default_Form_Spc extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        $this->addElement('password', 'password', array(
                'label'      => 'Your password is secure?',
                'require'    => true,
                'filter'    => 'StringTrim',
                'validators' => array(
                    array('validator' => 'StringLength',
                          'options'   => array(0, 20))
                )
        ));

        $require_captcha = false;
        if ($require_captcha) {
        	$this->addElement('captcha', 'captcha', array(
            	    'label'   => 'Write this text.',
                	'require' => true,
                	'captcha' => array('captcha' => 'Figlet',
                    	               'wordLen' => 5,
                        	           'timeout' => 300
                	)
        	));
        }

        $this->addElement('submit', 'submit', array(
                'label'  => 'check it',
                'ignore' => true
        ));

        $this->addElement('hash', 'csrf', array(
                'ignore' => true
        ));
    }
}

?>