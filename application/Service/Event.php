<?php
/**
 * Contains Service_Event.
 */

/**
 * Define the object namespace.
 */
namespace Service;

/**
 * Service for handling events. 
 */
class Event
{
    /**
     * Creates a new event.
     * 
     * @param int $timestamp The timestamp of when the event occurs.
     * @param string $text The new event text.
     * @return Service_Response The result of creating an event.
     */
    public function create($timestamp, $text)
    {
        $response = new Response();

        if (!is_int($timestamp)) {
            return $response->setMessage('Invalid event date.')
                ->setResult(false); 
        }

        if (!is_string($text)) {
            return $response->setMessage('Invalid event text. Expected a string.')
                ->setResult(false); 
        }

        $text = trim($text);
        $textLength = strlen($text);
        if ($textLength < 1 || $textLength > 200) {
            return $response->setMessage('Event text must be between 1 and 200 characters long.')
                ->setResult(false); 
        }

        $dateTime = new \DateTime();
        $dateTime->setTimestamp($timestamp);

        $eventModel = new \Model\Event();
        $eventModel->event = $text;
        $eventModel->date = $dateTime;
        \Zend_Registry::getInstance()->entityManager->persist($eventModel);

        return $response->setResult(true);
    }

    /**
     * Deletes an event.
     * 
     * @param int $id The id of the event to delete.
     * @return Service_Response The result of deleting an event.
     */
    public function delete($id)
    {
        $response = new Response(); 
        
        if (filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false)
        {
            return $response->setMessage('Invalid event id.')
                ->setResult(false); 
        }
        
        $entityManager = \Zend_Registry::getInstance()->entityManager;

        $event = $entityManager->getRepository('\Model\Event')->find($id);
        if (is_null($event)) {
            return $response->setResult(true);
        }
        
        $event->isDeleted = 1;
        $entityManager->persist($event);
        return $response->setResult(true);
    }

    /**
     * Returns an array of all inactive events.
     * 
     * @return Service_Response The inactive events.
     */
    public function getInActiveEvents()
    {
        $response = new Response(); 
        return $response->setMessage(
            \Zend_Registry::getInstance()->entityManager
                ->createQueryBuilder()
                ->select('e')
                ->from('\Model\Event', 'e')
                ->where('e.date < CURRENT_TIMESTAMP()')
                ->andWhere('e.isDeleted = 0')
                ->orderBy('e.date', 'DESC')
                ->getQuery()
                ->execute()
        )->setResult(true);
    }

    /**
     * Returns an array of all active events.
     * 
     * @return Service_Response The active events.
     */
    public function getActiveEvents()
    {
        $response = new Response(); 
        return $response->setMessage(
            \Zend_Registry::getInstance()->entityManager
                ->createQueryBuilder()
                ->select('e')
                ->from('\Model\Event', 'e')
                ->where('e.date >= CURRENT_TIMESTAMP()')
                ->andWhere('e.isDeleted = 0')
                ->orderBy('e.date', 'DESC')
                ->getQuery()
                ->execute()
        )->setResult(true);
    }
}
