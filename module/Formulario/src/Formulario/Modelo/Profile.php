<?php

namespace Formulario\Modelo;

use Zend\InputFilter\Factory as InputFactory;

use Zend\Form\Form;

use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

use Zend\Filter\File\RenameUpload;
use Zend\Validator\File\Size;
use Zend\Validator\File\Extension;
use Zend\Validator\File\MimeType;

class Profile implements InputFilterAwareInterface
{
    public $profilename;
    public $fileupload;
    protected $inputFilter;
    
    public function exchangeArray($data)
    {
       $this->profilename  = (isset($data['profilename']))  ? $data['profilename']     : null;
        $this->fileupload  = (isset($data['genero']))  ? $data['genero']     : null;
       $this->fileupload  = (isset($data['fileupload']))  ? $data['fileupload']     : null;
    } 
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'profilename',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Debe indicar su nombre!'
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            /*'min' => 8,*/
                            'max' => 100,
                            'messages' => array(
                                /*'stringLengthTooShort' => 'La contraseña debe ser de por lo menos 8 caracteres!'*/
                                'stringLengthTooLong' => 'El nombre no debe exceder 100 caracteres!'
                            ),
                        ),
                    ),
                ),
            )));


            $inputFilter->add($factory->createInput(array(
                'name' => 'email',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(

                    array (
                        'name' => 'Regex',
                        'options' => array(
                            'pattern'=>'/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/',
                            'messages' => array(
                                \Zend\Validator\Regex::NOT_MATCH    => 'Debe indicar un correo valido'
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),

                    array(
                        'name' =>'EmailAddress',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\EmailAddress::INVALID_FORMAT => 'El formato de correo es invalido!',
                                \Zend\Validator\EmailAddress::INVALID_HOSTNAME => "'%hostname%' No es un nombre de dominio valido",
                                \Zend\Validator\Hostname::INVALID_HOSTNAME => "'El correo es incorrecto",
                                \Zend\Validator\Hostname::LOCAL_NAME_NOT_ALLOWED => "Los correos locales no son permitidos",
                                \Zend\Validator\Hostname::UNKNOWN_TLD => "El correo nos aparece en la lista de DNS",

                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),

                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Debe indicar su correo!'
                            ),
                        ),
                    ),

                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            /*'min' => 8,*/
                            'max' => 100,
                            'messages' => array(
                                /*'stringLengthTooShort' => 'La contraseña debe ser de por lo menos 8 caracteres!'*/
                                'stringLengthTooLong' => 'El correo no debe exceder 100 caracteres!'
                            ),
                        ),
                    ),
                ),
            )));





            $inputFilter->add($factory->createInput(array(
                'name' => 'pass',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(

                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 8,
                            /*'max' => 20,*/
                            'messages' => array(
                                'stringLengthTooShort' => 'La contraseña debe ser de por lo menos 8 caracteres!'
                                /*'stringLengthTooLong' => 'Por favor introduce una contraseña de entre 8 y 20 caracteres'*/
                            ),
                        ),

                        'break_chain_on_failure' => true
                    ),


                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La contraseña es obligatoria!',
                            ),
                        ),
                    ),



                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'genero',
                'validators' => array(

                    array(
                        'name'    => 'InArray',
                        'options' => array(
                            'haystack' => array("m","f"),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Por favor indique su genero !'
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),

                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La opcion es incorrecta para elegir genero!',
                            ),
                        ),
                    ),

                ),
            )));


            $inputFilter->add($factory->createInput(array(
                'name' => 'lenguaje',
                'required' => true,
                'validators' => array(

                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor indique su idioma materno!',
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),
                ),
            )));



            $inputFilter->add($factory->createInput(array(
                'name'     => 'pais',
                'validators' => array(

                    array(
                        'name'    => 'InArray',
                        'options' => array(
                            'haystack' => array(1,2,3,4),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Por favor indique su pais !'
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),

                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La opcion es incorrecta!',
                            ),
                        ),
                    ),

                ),
            )));

              $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'preferencias',
                    'required' => false,
                ))
            );


            $inputFilter->add($factory->createInput(array(
                'name'     => 'condiciones',
                'validators' => array(

                    array(
                        'name'    => 'InArray',
                        'options' => array(
                            'haystack' => array("si","no"),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Debe aceptar las condiciones para continuar !'
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),

                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La opcion es incorrecta!',
                            ),
                        ),
                    ),

                ),
            )));


            $inputFilter->add($factory->createInput(array(
                'name' => 'fileupload',
                'required' => true,
                'validators' => array(

                    array(
                        'name' =>'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor suba su archivo!',
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),
                ),
            )));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
    
}