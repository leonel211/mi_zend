<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Formulario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TrabajoController extends AbstractActionController
{
    public function indexAction()
    {
       // return new ViewModel();
       $view =new ViewModel();
       $this->layout('layout/trabajo');
       $this->layout()->saludo="hola soy el parámetro";
        $this->layout()->title="mi nuevo layout";
       return $view;
    }
    public function ajaxAction()
    {
        // return new ViewModel();
       $view =new ViewModel();
       //$this->layout('layout/trabajo');
       //$view->setTerminal(true);
       return $view;
    }
	
	
	 public function flotChartsAction()
    {
      
        return new ViewModel();
		
    }
	
	public function morrisChartsAction()
    {
      
        return new ViewModel();
		
    }
	
	public function tablesAction()
    {
      
        return new ViewModel();
		
    }
	
	public function formsAction()
    {
      
        return new ViewModel();
		
    }
	
	public function panelWellsAction()
    {
      
        return new ViewModel();
		
    }
	
	public function buttonsAction()
    {
      
        return new ViewModel();
		
    }
	
	public function notificationsAction()
    {
      
        return new ViewModel();
		
    }
	
	public function typographyAction()
    {
      
        return new ViewModel();
		
    }
    
	public function iconsAction()
    {
      
        return new ViewModel();
		
    }
	
	public function gridAction()
    {
      
        return new ViewModel();
		
    }
	
	public function blankAction()
    {
      
        return new ViewModel();
		
    }
	
	public function loginAction()
    {
		
$result = new ViewModel();
    $result->setTerminal(true);

    return $result;
		
    }
	
	public function miFormularioAction()
    {
		
return new ViewModel();
		
    }
}
