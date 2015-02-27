<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function holaAction()
    {
        $id = (int) $this->params()->fromRoute("id", 0);
        $id2=(int) $this->params()->fromRoute("id2", 0);
        
        return new ViewModel(array("texto"=>"hola mundo desde Zend, soy C&eacute;sar Cancino<br>id=".$id."<br>id2=$id2"));
    }
}
