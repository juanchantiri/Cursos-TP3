 <?php   
    require_once './app/model/categorias_model.php';

    class categorias_controller{
    private $categorias_model;

    function __construct() {
        $this ->categorias_model = new categorias_model();
    }

    function getCategorias($req, $res){
        try {
            $categorias = $this->categorias_model->getCategorias();

            if (empty($categorias)) {
                return $res->json([], 200);
            }

            return $res->json($categorias, 200);

        } catch (Exception $e) {
            return $res->json(['error' => 'Error del servidor al obtener las categorias','detalle' => $e->getMessage()], 500);
        }
    }

    function getCategoria($req, $res){
        try {
            $categoriaID = $req->params->id;
            
            if(!$categoriaID){
                return $res->json("La categoria con el id=$categoriaID no existe", 404);
            }
            
            $categoria = $this->categorias_model->getCategoriaID($categoriaID);
            if (empty($categoria)) {
                return $res->json([], 200);
            }

            return $res->json($categoria, 200);

        } catch (Exception $e) {
            return $res->json(['error' => 'Error del servidor al obtener la categoria','detalle' => $e->getMessage()], 500);
        }
    }

    function addCategorias($req, $res){

        if (!isset($req->body->nombre) || empty($req->body->nombre)) {
            return $res->json(['error' => 'Falta el campo "nombre" en el JSON enviado'], 400);
        }   

        $nombre = $req->body->nombre;

        $id = $this->categorias_model->añadirCategoria($nombre);


        if ($id) {
            return $res->json(['id' => $id,'nombre' => $nombre,'mensaje' => 'Categoría creada con éxito'], 201); 
        } else {
            return $res->json(['error' => 'No se pudo crear la categoría'], 500);
        }
}

    function deleteCategoria($req, $res){
        $id_cat = $req->params->id;
        $categoria = $this->categorias_model->getCategoriaID($id_cat);

        if(!$categoria){
            return $res->json("La categoria con el id = $id_cat no existe", 404);
        }

        $this->categorias_model->deleteCategoria($id_cat);
        return $res->json("La categoria con el id = $id_cat a sido eliminada", 200);
    }

    function updateCategoria($req, $res){
        $id_cat = $req->params->id;
        $categoria = $this->categorias_model->getCategoriaID($id_cat);

        if(!$categoria){
            return $res->json("La categoria con el id = $id_cat no existe", 404);
        }

        if(empty($req->body->nombre)|| !isset($req->body->nombre)){
            return $res->json('Faltan datos', 400);
        }
        $nombre = $req->body->nombre;

        $this->categorias_model->editarCategoria($nombre, $id_cat);

        $categoriaEditada = $this->categorias_model->getCategoriaID($id_cat);

        return $res->json($categoriaEditada, 201);
    }


    function ordenarCategorias($req, $res){
        // strtoupper es para que no diferencie entre mayusculass
        $orden = isset($req->params->order) ? strtoupper($req->params->order) : 'ASC';


        if($orden !== 'ASC' && $orden !== 'DESC') {
            return $res->json(['error' => 'Parámetro de ordenamiento inválido. Use "ASC" o "DESC".'], 400);
        }

        try {
            $categorias = $this->categorias_model->getCategoriasOrdenadas($orden);
            return $res->json($categorias, 200);
            
        } catch (Exception $e) {
            return $res->json(['error' => 'Error al ordenar categorías'], 500);
        }
    }


}