<?php 	
	class Concesionario
	{
		private $_dbh;
		public function __construct($dsn, $username, $password){
			$this->_dbh = new PDO($dsn, $username, $password);
		}
	    /**
	     * @return array  con valores 
	     */
	    public function listaConcesionarios()
	    {
		    $stmt = $this->_dbh->prepare('SELECT id_concesionario, calle, numero, comuna, ciudad, telefono, telefono_adicional, id_concesionario, prioridad, nombre_fantasia,logo_chico FROM concesionario ORDER BY nombre_fantasia ASC ');
		    $stmt->execute();

		    while ($value = $stmt->fetch()) { 

		        $concesionarios[0][$i] = $value['id_concesionario'];
		        $concesionarios[1][$i] = $value['calle'];
		        $concesionarios[2][$i] = $value['numero'];
		        $concesionarios[3][$i] = $value['comuna'];
		        $concesionarios[4][$i] = $value['ciudad'];
		        $concesionarios[5][$i] = $value['telefono'];
		        $concesionarios[6][$i] = $value['telefono_adicional'];
		        $concesionarios[7][$i] = $value['id_concesionario'];
		        $concesionarios[8][$i] = $value['prioridad'];
		        $concesionarios[9][$i] = $value['nombre_fantasia'];
		        $concesionarios[10][$i] = $value['logo_chico'];

	        }
	        return $concesionarios;

	    }
	}
?>