<?php
/**
 * Contains Register. 
 */

/**
 * Define the namespace.
 */
namespace Website\Form;

/**
 * The user registration form.
 */
class Register extends \Zend_Form
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
        $this->setName('registerForm');

        $email = new \Zend_Form_Element_Text('email');
        $email->setRequired(true)
            ->setLabel('Email')
            ->setDecorators(
                array(
                    'ViewHelper',
                    array('Label'),
                    array(
                        'Message',
                        array(
                            'id' => 'emailMessage',
                            'class' => 'registerFormFieldMessage',
                            'placement' => \Extended_Form_Decorator_Message::APPEND
                        )
                    )
                )
            )
            ->setAttrib('maxlength', 100);
        
        $password = new \Zend_Form_Element_Password('password');
        $password->setRequired(true)
            ->setLabel('Password')
            ->setDecorators(
                array(
                    'ViewHelper',
                    array('Label'),
                    array(
                        'Message',
                        array(
                            'id' => 'passwordMessage',
                            'class' => 'registerFormFieldMessage',
                            'placement' => \Extended_Form_Decorator_Message::APPEND
                        )
                    )
                )
            )
            ->setAttrib('maxlength', 100);

        $passwordConfirm = new \Zend_Form_Element_Password('passwordConfirm');
        $passwordConfirm->setRequired(true)
            ->setLabel('Confirm Password')
            ->setDecorators(
                array(
                    'ViewHelper',
                    array('Label')
                )
            )
            ->setAttrib('maxlength', 100);
    
        $submit = new \Zend_Form_Element_Button('submitButton', 'Submit');
        $submit->setDecorators(
            array(
                'ViewHelper',
                array('HtmlTag', array('tag' => 'div')),
                    array(
                        'Message',
                        array(
                            'id' => 'errorMessage',
                            'class' => 'registerFormErrorMessage',
                            'placement' => \Extended_Form_Decorator_Message::APPEND
                        )
                    )
            )
        );

        $this->addElements(
            array(
                $email,
                $password,
                $passwordConfirm,
                $submit
            )
        );
    }
}
