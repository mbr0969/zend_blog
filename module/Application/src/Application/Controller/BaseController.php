<?php

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
/**
 * Description of BaseController
 *
 * @author papa
 */
class BaseController extends AbstractActionController {
    
    protected $entityManager;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        
        $this->setEntityManager( $this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        parent::onDispatch($e);
    }
    
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager) {
        $this->entityManager = $entityManager;        
    }
    
    function getEntityManager() {
        return $this->entityManager;
    }

   
  
}
