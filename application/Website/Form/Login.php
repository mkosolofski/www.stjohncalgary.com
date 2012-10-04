<?php
/**
 * Contains Login. 
 */

/**
 * Define the namespace.
 */
namespace Website\Form;

/**
 * The user login form.
 */
class Login extends \Zend_Form
{
    /**
     * Initialize the form with elements.
     */
    public function init()
    {
        $this->addPrefixPath(
            'Extended_Form_Decorator',
            'Extended/Form/Decorator',
            'decorator'
        );
        
        $this->setDecorators(array('FormElements', 'Form'));
        $this->setName('loginForm');

        $email = new \Zend_Form_Element_Text('emailLogin');
        $email->setRequired(true)
            ->setLabel('Email')
            ->setDecorators(
                array(
                    'ViewHelper',
                    array('Label')
                )
            )
            ->setAttrib('maxlength', 100);
        
        $password = new \Zend_Form_Element_Password('passwordLogin');
        $password->setRequired(true)
            ->setLabel('Password')
            ->setDecorators(
                array(
                    'ViewHelper',
                    array('Label')
                )
            )
            ->setAttrib('maxlength', 100);
    
        $submit = new \Zend_Form_Element_Button('loginButton', 'Login');
        $submit->setDecorators(
            array(
                'ViewHelper'
            )
        )
        ->setAttrib('onclick', 'layout_usertoolbar.login();');

        $this->addElements(
            array(
                $email,
                $password,
                $submit
            )
        );
    }
}
