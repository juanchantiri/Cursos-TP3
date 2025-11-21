 <?php   
    require_once './app/model/cursos_model.php';
    require_once './app/model/categorias_model.php';
    class cursos_controller{
    private $model;
    private $categorias_model;

    function __construct() {
        $this ->model = new cursos_model();
        $this ->categorias_model = new categorias_model();
    }

function getCursos($req, $res) {
    try {
        $cursos = $this->model->getAll();

        if (empty($cursos)) {
            return $res->json([], 200);
        }

        return $res->json($cursos, 200);

    } catch (Exception $e) {
        return $res->json(['error' => 'Error del servidor al obtener los cursos','detalle' => $e->getMessage()], 500);
    }
}

function getCursosPorCategoria($req, $res) {

        $id_categoria = $req->params->id;

        if (empty($id_categoria) || !is_numeric($id_categoria)) {
            return $res->json(['error' => 'ID de categoría inválido o faltante.'], 400);
        }

        try {
            $categoriaExiste = $this->categorias_model->getCategoriaID($id_categoria);
            
            if (!$categoriaExiste) {
                return $res->json(['error' => "La categoría con ID $id_categoria no existe."], 404);
            }

            $cursos = $this->model->getCursosByCategoria($id_categoria);
            
            return $res->json($cursos, 200);

        } catch (Exception $e) {
            return $res->json([
                'error' => 'Error del servidor al obtener los cursos.','detalle' => $e->getMessage()], 500);
        }
    }

    function addCursos($req, $res){
            if(!isset($req->body->titulo) || !isset($req->body->descripcion) || !isset($req->body->id_categoria) || !isset($req->body->instructor) || empty($req->body->titulo) || empty($req->body->descripcion) || empty($req->body->id_categoria) || empty($req->body->instructor)){
            return $res->json("Faltan completar datos", 400);
            }
            $titulo = $req->body->titulo;
            $descripcion =  $req->body->descripcion; 
            $id_categoria =  $req->body->id_categoria;
            $instructor = $req->body->instructor;

            $id_nuevo_curso = $this->model->añadirCursos($titulo, $descripcion,$instructor, $id_categoria);

        if (!$id_nuevo_curso || $id_nuevo_curso <= 0) {
          return $res->json("Error al obtener el ID del producto insertado.", 404);
         }
         $cursoNuevo = $this->model->curso($id_nuevo_curso);
         return $res->json($cursoNuevo);
    }
    function deleteCurso($req, $res){
        $id_curso = $req->params->id;
        $curso = $this->model->curso($id_curso);

        if(!$curso){
            return $res->json("El curso con el id = $id_curso no existe", 404);
        }

        $this->model->eliminarCurso($id_curso);
        return $res->json("El curso con el id = $id_curso a sido eliminado", 200);
    }


    function editarCurso($req, $res){
        $id_curso = $req->params->id;
        $curso = $this->model->curso($id_curso);

        if(!$curso){
            return $res->json("El curso con el id = $id_curso no existe", 404);
        }

        if(!isset($req->body->titulo) || !isset($req->body->descripcion) || !isset($req->body->id_categoria) || !isset($req->body->instructor) || empty($req->body->titulo) || empty($req->body->descripcion) || empty($req->body->id_categoria) || empty($req->body->instructor)){
            return $res->json('Faltan datos', 400);
        }
            $titulo = $req->body->titulo;
            $descripcion =  $req->body->descripcion; 
            $id_categoria =  $req->body->id_categoria;
            $instructor = $req->body->instructor;

        $this->model->updateCurso($id_curso, $titulo, $descripcion,$instructor, $id_categoria);

        $CursoEditado = $this->model->curso($id_curso);

        return $res->json($CursoEditado, 201);
     }
    }