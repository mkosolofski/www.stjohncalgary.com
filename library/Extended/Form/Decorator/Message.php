<?php
/**
 * Contains Message. 
 */

/**
 * Message decorator for from elements. 
 */
class Extended_Form_Decorator_Message extends Zend_Form_Decorator_Abstract
{
    /**
     * Renders the decorator with the given content.
     * 
     * @param string $content The content to render the decorator with.
     * @return string The renderred decorator.
     */
    public function render($content)
    {
        $decoratorOptions = array_merge(
            array('tag' => 'span'),
            $this->getOptions()
        );

        $id = $this->getOption('id');
        if (!is_null($id)) {
            $decoratorOptions['id'] = $id;
        }

        $decorator = new Zend_Form_Decorator_HtmlTag();
        $decorator->setOptions($decoratorOptions);
        return $decorator->render($content);
    }
}
