<?php
namespace Formulario\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Captcha;
use Zend\Form\Factory;
use Zend\Captcha\AdapterInterface as CaptchaAdapter;

class Formularios extends Form
{
    public function __construct($name = null)
     {
         parent::__construct('Profile'); // Aqui le doy nombre al formulario
         $this->setAttribute('method', 'post');
         $this->setAttribute('enctype','multipart/form-data');
        
        $this->add(array(
            'name' => 'profilename',
            'options' => array(
                'label' => 'Nombre Completo',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
            ),
        ));




         $factory = new Factory();
        $email = $factory->createElement(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'Correo',
            ),
            'attributes' => array(
                'class' => 'form-control',
				'placeholder' => "algo@correo.com"
            ),
                ));
		$this->add($email);
		
		
		 //campo de tipo password
         $this->add(array(
            'name' => 'pass',
            'options' => array(
                'label' => 'Contraseña',
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control'
            ),
        ));





		  //radio button
       /* $radio = new Element\Radio('genero');
        $radio->setLabel('Cual es tu genero?<br>')
				->setAttribute('class', 'radio-inline');
		 $this->add($radio); */



         $this->add(array(
             'type' => 'Zend\Form\Element\Radio',
             'name' => 'genero',
             'options' => array(
                 'label' => 'Cual es su genero ?',
                 'value_options' => array(
                     'm' => 'Femenino',
                     'f' => 'Masculino',
                 ),
             ),
         ));
		 
		 
		  //select
    $select = new Element\Select('lenguaje');
     $select->setLabel('Cual en tu lengua materna?');
     $select->setAttribute('multiple', true)
			->setAttribute('class', 'form-control');
    //$select->setEmptyOption('Seleccione...');
    $this->add($select);


         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'pais',

             'attributes' => array(
                 'class' => 'form-control',
                  'value' => '0',

             ),

             'options' => array(
                 'label' => 'Cuál es tu país?',
                 'empty_option' => 'Seleccione un país',


                 'value_options' => array(
                     'european' => array(
                         'label' => 'Paises Europeos',
                         'options' => array(
                             '1' => 'Francia',
                             '2' => 'Italia',
                         ),
                     ),
                     'asian' => array(
                         'label' => 'Paises Asiaticos',
                         'options' => array(
                             '3' => 'Japon',
                             '4' => 'China',
                         ),
                     ),
                 ),
             ),

         ));

/*
	
	// select 
     $pais = new Element\Select('pais');
     $pais->setLabel('Cuál es tu país?');
	 $pais->setAttribute('multiple', false)
			->setAttribute('class', 'form-control');
     $pais->setEmptyOption('Seleccione...');
     $pais->setValueOptions(array(
      'european' => array(
         'label' => 'Paises Europeos',
         'options' => array(
            '0' => 'Francia',
            '1' => 'Italia',
         ),
      ),
      'asian' => array(
         'label' => 'Paises Asiaticos',
         'options' => array(
            '2' => 'Japon',
            '3' => 'China',
         ),
      ),
     ));
     $this->add($pais);
*/
		 
		    //multicheckbox
       $preferencias = new Element\MultiCheckbox('preferencias');
        $preferencias->setLabel('Indique sus preferencias');
        $this->add($preferencias);
		 
		 
		 /* // checkbox
        $condiciones = new Element\Checkbox('condiciones');
        $condiciones->setLabel('Acepto Las Condiciones');
        $this->add($condiciones); */

         $this->add(array(
             'type' => 'Zend\Form\Element\Checkbox',
             'name' => 'condiciones',
             'options' => array(
                 'label' => 'Acepto Las Condiciones',
                 'use_hidden_element' => false,
                 'checked_value' => 'si',
                 'unchecked_value' => 'no'
             ),
             'attributes' => array(
                // 'value' => 'no'
             )
         ));
		 
		 
	/*	    // File Input
        $file = new Element\File('fileupload');
        $file->setLabel('Suba su archivo')
             ->setAttribute('id', 'file');
        $this->add($file);   */


         $this->add(array(
             'name' => 'fileupload',
             'attributes' => array(
                 'type'  => 'file',
             ),
             'options' => array(
                 'label' => 'Suba su archivo',
             ),
         ));
		
		
	 
		
	//campo oculto
        $oculto = new Element\Hidden('oculto');
        $this->add($oculto);
		
		
		   //bot�n enviar
       // $this->add(new Element\Csrf('security'));
        $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Enviar',
                'title' => 'Enviar',
				'class' => 'btn btn-success' 
            ),
        ));
     
     }
}

?>