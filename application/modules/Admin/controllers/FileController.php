<?php
/**
 * Contains FileController 
 *
 * @package Controllers
 */

/**
 * The file controller.
 * 
 * @package Controllers
 */
class Admin_FileController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/file/index.css');
        $files = scandir(APPLICATION_PATH.'/../public/images/dynamic/'); 
        unset($files[0]);
        unset($files[1]);
        $this->view->images = $files;
    }

    /**
     * The file upload action.
     */
    public function uploadAction()
    {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $adapter->addValidator('Count', false, array('min' =>1, 'max' => 1))
            ->addValidator('IsImage', false, array('jpg', 'jpeg', 'png', 'gif'))
            ->addValidator('Size', false, array('max' => '10MB'))
            ->setDestination(APPLICATION_PATH.'/../public/images/dynamic/');

        $fileInfo = $adapter->getFileInfo();
        if ($adapter->isValid($fileInfo['file']['name'])) {
            try {
                $adapter->receive();
            } catch (Zend_File_Transfer_Exception $e) {
                $this->view->uploadErrors = array($e->getMessage());
            }
        } else {
            $this->view->uploadErrors = $adapter->getMessages();
        }
        
        if (!isset($this->view->uploadErrors)) {
            $filePath = APPLICATION_PATH.'/../public/images/dynamic/' . $fileInfo['file']['name'];

            // Resize the image.
            $image = new Imagick($filePath);
            $dimension = $image->getImageGeometry();
            $maxDimesion = max($dimension['width'], $dimension['height']);
            $maxTarget = 350;
            $aspect = 1;

            if ($maxDimesion > $maxTarget) {
                $aspect = $maxTarget / $maxDimesion;
            }

            if ($aspect != 1) {
               $image->resizeImage(
                    $dimension['width'] * $aspect,
                    $dimension['height'] * $aspect,
                    Imagick::FILTER_LANCZOS,
                    1
                ); 
                
                $image->writeImage($filePath);
                $image->destroy();
            }
        }

        $this->indexAction();
        $this->render('index');
    }
}
