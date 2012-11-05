<?php
/**
 * Contains \Website\Doctrine\EventListener. 
 */

/**
 * Define the namespace.
 */
namespace Website\Doctrine;

/**
 * Event listener for doctrine.
 */
class EventListener
{
    /**
     * Method called after the change-sets of all managed entities are computed.
     * 
     * @param \Doctrine\ORM\Event\OnFlushEventArgs $eventArgs 
     */
    public function onFlush(\Doctrine\ORM\Event\OnFlushEventArgs $eventArgs)
    {
        $user = new \Website\User();
        $user = $user->getCurrentUser();

        $entityManager = $eventArgs->getEntityManager();
        $unitOfWork = $entityManager->getUnitOfWork();
        
        $entityManager->getEventManager()->removeEventListener('onFlush', $this);

        foreach ($unitOfWork->getScheduledEntityInsertions() as $entity) {
            $entityName = str_replace('Model\\', '', get_class($entity));
            
            foreach ($entity->getSetableFields() as $field) {
                if (!is_scalar($entity->$field)) {
                    continue;
                }

                $auditModel = new \Model\Audit();
                $auditModel->entity = $entityName;
                $auditModel->field = $field;
                $auditModel->old_value =  '';
                $auditModel->new_value =  (string)$entity->$field;
                $auditModel->user_id =  $user->id;
                $auditModel->entity_id = 0;
                $entityManager->persist($auditModel);
            }
        }

        foreach ($unitOfWork->getScheduledEntityUpdates() as $entity) {
            $entityName = str_replace('Model\\', '', get_class($entity));
            
            foreach ($unitOfWork->getEntityChangeSet($entity) as $field => $changeSet) {
                if (!is_scalar($changeSet[0]) || !is_scalar($changeSet[1])) {
                    continue;
                }
                
                if (in_array($field, $entity->getSetableFields())) {
                    $auditModel = new \Model\Audit();
                    $auditModel->entity = $entityName;
                    $auditModel->field = $field;
                    $auditModel->old_value =  (string)$changeSet[0];
                    $auditModel->new_value =  (string)$changeSet[1];
                    $auditModel->user_id =  $user->id;
                    $auditModel->entity_id =  $entity->id;
                    $entityManager->persist($auditModel);
                }
            }
        }

        $entityManager->flush();
    }
}
