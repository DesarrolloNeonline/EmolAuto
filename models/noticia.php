<?php 	
	class News
	{
	    public function __construct(PDO $connection)
	    {
	        $this->connection = $connection;
	    }

	    /**
	     * @param array $idArray array con las id 
	     * @return array $valueBox array con valores 
	     */
    	public function listNews()
 		{
	        
	       	$stmt = $this->connection->prepare('select  id_noticia, titulo_noticia, subtitulo_noticia, bajada_titulo, glosa_periodistica, periodista, estado_publicacion, target from automoviles.noticias order by fecha_noticia DESC');
	        $stmt->execute();
	        $i = 0;

		        while($post = $stmt-> fetch()){

		        	$valueNews[0][$i] = $post['id_noticia'];
		        	$valueNews[1][$i] = $post['titulo_noticia'];
		        	$valueNews[2][$i] = $post['subtitulo_noticia'];
		        	$valueNews[3][$i] = $post['bajada_titulo'];
		        	$valueNews[4][$i] = $post['glosa_periodistica'];
		        	$valueNews[5][$i] = $post['periodista'];
		        	$valueNews[5][$i] = $post['estado_publicacion'];
		        	$valueNews[5][$i] = $post['target'];

		       		$i++;
		        }

        }
	        return $valueBox;
    }	
?>