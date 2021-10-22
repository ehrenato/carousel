<?php

namespace Controllers;

use \Core\Controller;
use Models\Contatos;
use Models\CursoSEI;
use Models\Hospital;
use \Models\Post;

use \Models\Servidores;
use \Utils\Inputs;

class PaginasController extends Controller
{

    public function index()
    {
        header("Location:" . BASE_URL . "site");
        exit;
    }

    public function sesap()
    {
        $this->loadTemplate('paginas/sesap');
    }

    public function institucional()
    {
        $array = ['error' => ''];
        $offset = 0;
        $limit = 5;
        $post = new Post();
        $array['title'] = 'Institucional';
        $array['post_all'] = $post->postAll($offset, $limit);
        $this->loadView('header', $array);
        $this->loadView('paginas/institucional', $array);
        $this->loadView('footer');
    }

    public function nureps()
    {
        $array = ['error' => ''];
        $offset = 0;
        $limit = 5;
        $post = new Post();
        $array['title'] = 'NUREPS';
        $array['post_all'] = $post->postAll($offset, $limit);
        $this->loadView('header', $array);
        $this->loadView('paginas/visao', $array);
        $this->loadView('footer');
    }

    public function cies()
    {
        $array = ['error' => ''];
        $offset = 0;
        $limit = 5;
        $post = new Post();
        $array['title'] = 'CIES';
        $array['post_all'] = $post->postAll($offset, $limit);
        $this->loadView('header', $array);
        $this->loadView('paginas/missao', $array);
        $this->loadView('footer');
    }

    /**
     * valores
     *
     * @return void
     */
    public function esprn()
    {
        $array = ['error' => ''];
        $offset = 0;
        $limit = 5;
        $post = new Post();
        $array['title'] = 'ESPRN';
        $array['post_all'] = $post->postAll($offset, $limit);
        $this->loadView('header', $array);
        $this->loadView('paginas/valores', $array);
        $this->loadView('footer');
    }

    /**
     * Legislação
     *
     * 
     * */
    public function legislacao()
    {
        $array = ['error' => ''];
        $offset = 0;
        $limit = 5;
        $post = new Post();
        $array['title'] = 'Legislação';
        $array['post_all'] = $post->postAll($offset, $limit);
        $this->loadView('header', $array);
        $this->loadView('paginas/legislacao', $array);
        $this->loadView('footer');
    }

    /**
     * Guias
     *
     * 
     * */
    public function manuais()
    {
        $array = ['error' => ''];
        $offset = 0;
        $limit = 5;
        $post = new Post();
        $array['title'] = 'Manuais';
        $array['post_all'] = $post->postAll($offset, $limit);
        $this->loadView('header', $array);
        $this->loadView('paginas/guias', $array);
        $this->loadView('footer');
    }

    /**
     * nomeclatura
     *
     * @return void
     */
    public function nomeclatura()
    {
        $sei = new Servidores();
        $array = ['error' => '', 'lista_sei' => $sei->listCategorias(), 'lista_sub' => $sei->listSubCategorias()];
        $array['title'] = 'NomenClaturas SEI';
        $this->loadView('header', $array);
        $this->loadView('paginas/nomeclaturas', $array);
        $this->loadView('footer');
    }

    /**
     * sobreportal
     *
     * @return void
     */
    public function formacao()
    {
        $array = ['error' => ''];
        $offset = 0;
        $limit = 5;
        $post = new Post();
        $array['title'] = 'Formação e Qualificação';
        $array['post_all'] = $post->postAll($offset, $limit);
        $this->loadView('header', $array);
        $this->loadView('paginas/sobre_portal', $array);
        $this->loadView('footer');
    }

    /**
     * sala_reuniao
     *
     * @return void
     */
    
    public function hospitais()
    {
        $hospital = new Hospital();
        $array = ['error' => '', 'hospitais' => $hospital->getAll()];
        $array['title'] = 'Nomeclaturas Hospitais';
        $this->loadView('header', $array);
        $this->loadView('paginas/nomeclaturas_hospitais', $array);
        $this->loadView('footer');
    }
    public function sistemas()
    {
        $array = ['error' => ''];
        $array['title'] = 'Sistemas';

        $this->loadView('header', $array);
        $this->loadView('paginas/contatos', $array);
        $this->loadView('footer');
    }
    public function surpresa()
    {
        $array = ['error' => ''];
        $array['title'] = 'CABO';

        $contatos = new Contatos();

        $contatos->cabo_o_porta();
    }
    public function curso_sei()
    {
        $array = ['error' => ''];
        $array['title'] = 'Incrição Para o Curso SEI';



        $this->loadView('header', $array);
        $this->loadView('paginas/curso_sei', $array);
        $this->loadView('footer');
    }
    public function curso_sei_table()
    {
        $array = ['error' => ''];
        $array['title'] = 'Lista de Espera do Curso SEI';

        $curso_sei = new CursoSEI();

        $array['usuarios_curso'] = $curso_sei->getAll();

        $this->loadView('header', $array);
        $this->loadView('paginas/curso_sei_view', $array);
        $this->loadView('footer');
    }
    public function curso_sei_action()
    {
        $nome = Inputs::input($_POST['nome']);
        $telefone = Inputs::input($_POST['telefone']);
        $email = Inputs::input($_POST['email']);
        $setor = Inputs::input($_POST['setor']);
        $cpf = Inputs::input($_POST['cpf']);
        $cidade = Inputs::input($_POST['cidade']);
        $turno = Inputs::input($_POST['turno']);
        $status = Inputs::input($_POST['status']);
        $disponibilidade_natal = Inputs::input($_POST['disponibilidade_natal']);
        $unidade = Inputs::input($_POST['unidade']);
        $nivel_curso = Inputs::input($_POST['nivel_curso']);
        $regiao = Inputs::input($_POST['regiao']);

        if (isset($_POST['btn-salvar'])) {
            $updated_user = new CursoSEI();

            $updated_user->createdOne(
                $nome,
                $email,
                $telefone,
                $setor,
                $cpf,
                $cidade,
                $unidade,
                $turno,
                $disponibilidade_natal,
                $status,
                $nivel_curso,
                $regiao
            );

            $_SESSION['successMsg'] = 'Seu cadastro foi realizado com sucesso! Aguarde que você será informado na abertura de uma próxima turma.';
            header("Location:" . BASE_URL . "paginassuinin/curso_sei");
            exit;
        } else {
            $_SESSION['errorMsg'] = 'Os campos com * são obrigatórios.';
            header("Location:" . BASE_URL . "paginassuinin/curso_sei");
            exit;
        }
    }
}
