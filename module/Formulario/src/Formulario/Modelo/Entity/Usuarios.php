<?php

/**
 * @author C�sar Cancino
 * @copyright 2013
 */
namespace Formulario\Modelo\Entity;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Usuarios extends TableGateway
{
    private $profilename;
    private $correo;
	private $pass; // Aqui declaro la propiedad pass para poder usarla en la clase
	private $genero;
    private $lenguaje;
	private $lenguajes;
	private $pais;
	private $preferencias;
	private $preferencias_separado; 
	private $acepta_condiciones; 
	private $fileupload;

	
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('usuarios', $adapter, $databaseSchema,$selectResultPrototype);
    } 
    private function cargaAtributos($datos=array(), $nombre_archivo)
    {
        
		$this->profilename=$datos["profilename"];
        $this->correo=$datos["email"];
		$this->pass=$datos["pass"]; // Aqui le asigno a la propiedad pass lo que venga del campo pass del formulario
		$this->genero=$datos["genero"];
		$this->lenguaje=$datos["lenguaje"]; // Aqui viene un arreglo porque es mutiple option
		$this->pais=$datos["pais"];
		$this->preferencias=$datos["preferencias"];
		$this->acepta_condiciones=$datos["condiciones"];
		$this->fileupload=$nombre_archivo;
		
    }
     
	 public function getUsuarios(){
     	$datos = $this->select();
        return $datos->toArray();
     }
     
	 public function getUsuarioPorId($id)
     {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        
        if (!$row) {
            throw new \Exception("No hay registros asociados al valor $id");
        }
        
        return $row;
     }
	 
	 
      public function addUsuario($data=array(), $nombre_archivo)
        {
             self::cargaAtributos($data, $nombre_archivo);
			 
			
			foreach ($this->lenguaje as $language) {
				$this->lenguajes .= $language.", ";
			}	
			
			foreach ($this->preferencias as $preferencia) {
				$this->preferencias_separado .= $preferencia.", ";
			}
			
		$this->preferencias_separado = trim($this->preferencias_separado, ',');
		$this->preferencias_separado = substr($this->preferencias_separado, 0, -1);	 
			 
             $array=array
             (
                'nombre'=>$this->profilename,
                'correo'=>$this->correo,
				'password'=>$this->pass,
				'genero'=>$this->genero,
				'idioma'=>$this->lenguajes,
				'pais'=>$this->pais,
				'preferencias'=>$this->preferencias_separado,
				'acepta_condiciones'=>$this->acepta_condiciones,
				'nombre_archivo'=>$this->fileupload
				
				//Aqui le digo que lo que venga en la propiedad pass lo meta en el campo password
             );
               $this->insert($array);  // Aqui se insertan los datos recibidos a la base de datos.
               
        }
       
        

    public function updateUsuario($id, $data=array())
    {
        
        $this->update($data, array('id' => $id));
    }

    public function deleteUsuario($id)
    {
        $this->delete(array('id' => $id));
    }
}




