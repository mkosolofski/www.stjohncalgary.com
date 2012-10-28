<?php
/**
 * Contains Service_News.
 */

/**
 * Define the object namespace.
 */
namespace Service;

/**
 * Service for handling news. 
 */
class News
{
    /**
     * Creates a new news item
     * 
     * @param string $title The news item title.
     * @param string $body The news item body.
     * @return Service_Response The result of creating an new news item.
     */
    public function create($title, $body)
    {
        $response = new Response();

        if (!is_string($title)) {
            return $response->setMessage('Invalid news title. Expected a string.')
                ->setResult(false); 
        }

        $title = trim($title);
        $titleLength = strlen($title);
        if ($titleLength < 1 || $titleLength > 200) {
            return $response->setMessage('News title must be between 1 and 200 characters long.')
                ->setResult(false); 
        }
        
        if (!is_string($body)) {
            return $response->setMessage('Invalid news body. Expected a string.')
                ->setResult(false); 
        }

        $body = trim($body);
        $bodyLength = strlen($body);
        if ($bodyLength < 1 || $bodyLength > 20000) {
            return $response->setMessage('News body must be between 1 and 20000 characters long.')
                ->setResult(false); 
        }

        $newsModel = new \Model\News();
        $newsModel->title = $title;
        $newsModel->body = $body;
        \Zend_Registry::getInstance()->entityManager->persist($newsModel);

        return $response->setResult(true);
    }

    /**
     * Deletes a news item.
     * 
     * @param int $id The id of the news item to delete.
     * @return Service_Response The result of deleting a news item.
     */
    public function delete($id)
    {
        $response = new Response(); 
        
        if (filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false)
        {
            return $response->setMessage('Invalid news id.')
                ->setResult(false); 
        }
        
        $entityManager = \Zend_Registry::getInstance()->entityManager;

        $newsModel = $entityManager->getRepository('\Model\News')->find($id);
        if (is_null($newsModel)) {
            return $response->setResult(true);
        }
        
        $newsModel->isDeleted = 1;
        $entityManager->persist($newsModel);
        return $response->setResult(true);
    }

    /**
     * Returns an array of all archived news items.
     * 
     * @return Service_Response The archived news items.
     */
    public function getArchivedNews()
    {
        $response = new Response(); 
        return $response->setMessage(
            \Zend_Registry::getInstance()->entityManager
                ->createQueryBuilder()
                ->select('n')
                ->from('\Model\News', 'n')
                ->where('n.isArchived = 0')
                ->andWhere('n.isDeleted = 0')
                ->orderBy('n.created', 'DESC')
                ->getQuery()
                ->execute()
        )->setResult(true);
    }

    /**
     * Returns an array of all active news.
     * 
     * @return Service_Response The active news items.
     */
    public function getActiveNews()
    {
        $response = new Response(); 
        return $response->setMessage(
            \Zend_Registry::getInstance()->entityManager
                ->createQueryBuilder()
                ->select('n')
                ->from('\Model\News', 'n')
                ->where('n.isArchived = 1')
                ->andWhere('n.isDeleted = 0')
                ->orderBy('n.created', 'DESC')
                ->getQuery()
                ->execute()
        )->setResult(true);
    }
}
