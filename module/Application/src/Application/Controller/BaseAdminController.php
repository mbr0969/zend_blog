<?php
namespace Application\Controller;

/**
 * Description of BaseAdminController
 *
 * @author papa
 */
class BaseAdminController  extends BaseController{
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        parent::onDispatch($e);
    }
}
