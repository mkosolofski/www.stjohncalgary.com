<?php
/**
 * Contains Extended_View_Helper_Layout_RandomImage
 */

/**
 * Helper for displaying a random layout image.
 */
class Extended_View_Helper_Layout_RandomImage extends Zend_View_Helper_Abstract
{
    /**
     * The random images. 
     */
    static $_images = array(
        'commandments.png',
        'crosses.png',
        'dove.png',
        'hands.png',
        'thorns.png',
        'wine.png'
    );

    /**
     * Returns image html for a random layout image.
     */
    public function __call($method, $args)
    {
        $imageIndex = mt_rand(0, count(self::$_images) - 1);
 
        $html = '<img src="/images/layout/random/' . self::$_images[$imageIndex] . '"/>';

        // Don't display the same random image twice.
        unset(self::$_images[$imageIndex]);
        self::$_images = array_values(self::$_images);
        
        return $html;
    }
}
