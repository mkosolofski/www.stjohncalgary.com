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
        array('src' => '/images/layout/random/commandments.png', 'width' => '180px', 'height' => '171px'),
        array('src' => '/images/layout/random/crosses.png', 'width' => '180px', 'height' => '176px'),
        array('src' => '/images/layout/random/dove.png', 'width' => '180px', 'height' => '162px'),
        array('src' => '/images/layout/random/hands.png', 'width' => '180px', 'height' => '190px'),
        array('src' => '/images/layout/random/thorns.png', 'width' => '180px', 'height' => '77px'),
        array('src' => '/images/layout/random/wine.png', 'width' => '180px', 'height' => '156px')
    );

    /**
     * Returns image html for a random layout image.
     */
    public function __call($method, $args)
    {
        $imageIndex = mt_rand(0, count(self::$_images) - 1);
 
        $html = '<img ';
        foreach (self::$_images[$imageIndex] as $property => $value) {
            $html .= $property .'="' . htmlentities($value) . '" '; 
        }
        $html .= '/>';

        // Don't display the same random image twice.
        unset(self::$_images[$imageIndex]);
        self::$_images = array_values(self::$_images);
        
        return $html;
    }
}
