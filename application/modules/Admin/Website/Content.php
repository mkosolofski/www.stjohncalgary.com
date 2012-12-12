<?php
/**
 * Contains Content. 
 */

/**
 * Define the namespace. 
 */
namespace Admin\Website;

/**
 * Manages site content location.
 */
class Content
{
    /**
     * The application path to the root content folder. 
     */
    const PATH = '/modules/Admin/views/scripts/mainScripts/';

    /**
     * Returns the absolute path of the root content folder.
     *
     * @return string The absolute path to the root content folder.
     */
    public function getPath()
    {
        return APPLICATION_PATH . self::PATH;
    }

    /**
     * Given a content file name, returns the associated absolute backup file path.
     * 
     * @param string $fileName The content file name.
     * @return string The associated back up file path.
     * @throws \Admin\Website\Exception\Parameter Invalid method parameter.
     */
    public function getBackupFilePath($fileName)
    {
        if (!is_string($fileName)) {
            throw new \Admin\Website\Exception\Parameter('Invalid $filename parameter.');
        }
 
        $backup = new \Admin\Website\Content\Backup();
        return $backup->getPath() . $backup->getBackupFileName($fileName);
    }

    /**
     * Returns an associative array of content files.
     * 
     * @return array An associative array of content files.
     */
    public function getFiles()
    {
        return $this->_files;
    }

    /**
     * A definition of content files and associated paths from the content root folder.
     * 
     * @var array
     */
    protected $_files = array(
        'Test Page' => 'test/index.phtml',
        'Acadia Place' => 'ministries/missions/acadia-place.phtml',
        'Baptism' => 'services/baptism.phtml',
        'CLWR' => 'ministries/missions/clwr.phtml',
        'Confirmation and Education' => 'ministries/education/confirmation-and-educational-links.phtml',
        'Contact Us' => 'about-us/contact-us.phtml',
        'Funeral' => 'services/funeral.phtml',
        'Giving' => 'giving/index.phtml',
        'History' => 'about-us/history.phtml',
        'Huff and Puff' => 'ministries/education/huff-and-puff.phtml',
        'Pastors Page' => 'about-us/pastors-page.phtml',
        'Under 100 Club' => 'ministries/education/under-100-club.phtml',
        'Wedding' => 'services/wedding.phtml',
        'Welcome' => 'index/index/_welcome.phtml',
        'Womens Group' => 'ministries/education/womens-group.phtml',
        'Worship Time' => 'index/index/_worshiptime.phtml'
    );
}
