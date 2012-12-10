<?php
/**
 * Contains Backup.
 */

/**
 * Define the namespace.  
 */
namespace Admin\Website\Content;

/**
 * Manages backup file locations. 
 */
class Backup
{
    /**
     * The application path to the root content backup folder. 
     */
    const PATH = '/modules/Admin/views/scripts/content/index/backups/';

    /**
     * Signifier used to mark a file as a backup file. 
     */
    const SIGNIFIER = 'backup_';

    /**
     * Returns the absolute path of the root backup folder.
     *
     * @return string The absolute path to the root backup folder.
     */
    public function getPath()
    {
        return APPLICATION_PATH . self::PATH;
    }

    /**
     * Given a file name returns the equivalent backup file name.
     * 
     * @param string $fileName The file name to get the backup name of.
     * @return string The equivalent backup file name.
     * @throws \Admin\Website\Exception\Parameter Invalid method parameter.
     */
    public function getBackupFileName($fileName)
    {
        if (!is_string($fileName)) {
            throw new \Admin\Website\Exception\Parameter('Invalid $filename parameter.');
        }

        return self::SIGNIFIER . $fileName;
    }
    
    /**
     * Checks if the given file name is a backup file name.
     * 
     * @param string $fileName The file name to check.
     * @return bool True is file name is a back up name, false otherwise.
     * @throws \Admin\Website\Exception\Parameter Invalid method parameter.
     */
    public function isBackupFile($fileName)
    {
        if (!is_string($fileName)) {
            throw new \Admin\Website\Exception\Parameter('Invalid $filename parameter.');
        }

        return strpos($fileName, self::SIGNIFIER) === 0;
    }
    
    /**
     * Given a backup file name, returns the associated absolute content file path.
     * 
     * @param string $fileName The backup file name.
     * @return string The associated content file path.
     * @throws \Admin\Website\Exception\Parameter Invalid method parameter.
     */
    public function getContentFilePath($fileName)
    {
        if (!is_string($fileName)) {
            throw new \Admin\Website\Exception\Parameter('Invalid $filename parameter.');
        }
        
        $fileInfo = $this->_getContentFileInfo($fileName);
        if (empty($fileInfo)) {
            throw new \Admin\Website\Exception\Parameter('Unrecognized file name.');
        }
        
        $content = new \Admin\Website\Content();
        return $content->getPath() . $fileInfo['path'];
    }

    /**
     * Returns an associative array of backup files.
     * 
     * @return array An associative array of backup files.
     */
    public function getFiles()
    {
        $files = array();
        if ($handle = opendir($this->getPath())) {
            while (false !== ($entry = readdir($handle))) {
                if(strstr($entry, '.phtml')) {
                    $fileInfo = $this->_getContentFileInfo($entry);
                    if (!empty($fileInfo)) {
                        $files[$fileInfo['name'] . ' - Backup'] = $entry;
                    }
                }
            }
            closedir($handle);
        }
        
        return $files;
    }

    /**
     * Returns an array of content file info for a given back up file name.
     * 
     * @param string $fileName The back up file.
     * @return array The array of content file info.
     */
    protected function _getContentFileInfo($fileName)
    {
        $fileName = str_replace(self::SIGNIFIER, '', $fileName);
        $content = new \Admin\Website\Content();
        foreach($content->getFiles() as $key => $filePath) {
            if (basename($filePath) == $fileName) {
                return array('name' => $key, 'path' => $filePath);
            }
        }

        return array();
    }
}
