<?php

namespace Controllers;

use \Core\Controller;
use \Models\Carrossel;
use Models\PostFix;
use Models\CarrosselFix;
use Models\Sugestoes;

class SiteController extends Controller
{

    private $carrossel;

    public function __construct()
    {
        $this->carrossel = new Carrossel();
    }

    //Carregamento da Página Principal do Site
    public function index()
    {
        $array = ['error' => '', 'title' => 'Rede Potiguar de Educação Permanente em Saúde'];

        $array['carrossels'] = $this->carrossel->getCarrosselLimit();
        $this->loadView('header', $array);
        $this->loadView('site', $array);
        $this->loadView('footer', $array);
    }
 

    //Carregamento de todos as Carrossels com Paginação
    public function carrossel_all()
    {
        $array = ['error' => '', 'title' => 'Todos as Carrossels'];
        $carrossel = new Carrossel();
        $offset = 0;
        $limit = 9;
        $limit_pages = 2;

        $total = $carrossel->getTotalCarrossel();
        $array['paginas'] = ceil($total / $limit);
        $array['paginaAtual'] = 1;
        if (!empty($_GET['f'])) {
            $array['paginaAtual'] = intval($_GET['f']);
        }

        $paginaAtual =  $array['paginaAtual'];
        $paginas = $array['paginas'];
        $offset = ($array['paginaAtual'] * $limit) - $limit;
        $array['carrossel_all'] = $carrossel->carrosselAll($offset, $limit);

        $init_page = ((($paginaAtual - $limit_pages) > 1) ? $paginaAtual - $limit_pages : 1);
        $end_page = ((($paginaAtual + $limit_pages) < $paginas) ? $paginaAtual + $limit_pages : $paginas);
        $array['init_page'] = $init_page;
        $array['end_page'] = $end_page;

        $this->loadView('header', $array);
        $this->loadView('carrossel_all', $array);
        $this->loadView('footer', $array);
    }

    //Carrega uma unica Carrossel
    public function carrossel_unid($carrossel_id)
    {
        $array = [
            'error' => ''
        ];
        $offset = 0;
        $limit = 7;
        $carrossel = new Carrossel();

        $array['title'] = $carrossel->carrosselId($carrossel_id)['titulo'];
        $array['carrossel_all'] = $carrossel->carrosselAll($offset, $limit);
        $array['carrossel_info'] = $carrossel->carrosselId($carrossel_id);
        $this->loadView('header', $array);
        $this->loadView('single_page', $array);
        $this->loadView('footer', $array);
    }



    //==================ALTERACAO P/ KLEBER==================
    //Carregamento de todos as Carrossels com Paginação
    public function carrossel_ponto()
    {
        $array = ['error' => '', 'title' => 'Todas as Carrossels'];
        $carrossel = new Carrossel();
        $offset = 0;
        $limit = 9;
        $limit_pages = 2;

        $total = $carrossel->getTotalCarrossel();
        $array['paginas'] = ceil($total / $limit);
        $array['paginaAtual'] = 1;
        if (!empty($_GET['f'])) {
            $array['paginaAtual'] = intval($_GET['f']);
        }

        $paginaAtual =  $array['paginaAtual'];
        $paginas = $array['paginas'];
        $offset = ($array['paginaAtual'] * $limit) - $limit;
        $array['carrossel_all'] = $carrossel->carrosselAll($offset, $limit);

        $init_page = ((($paginaAtual - $limit_pages) > 1) ? $paginaAtual - $limit_pages : 1);
        $end_page = ((($paginaAtual + $limit_pages) < $paginas) ? $paginaAtual + $limit_pages : $paginas);
        $array['init_page'] = $init_page;
        $array['end_page'] = $end_page;


        $this->loadView('carrossel_all', $array);
    }

    //Carrega uma unica Carrossel
    public function carrossel_ponto_unid($carrossel_id)
    {
        $array = [
            'error' => ''
        ];
        $offset = 0;
        $limit = 7;
        $carrossel = new Carrossel();

        $array['title'] = $carrossel->carrosselId($carrossel_id)['titulo'];
        $array['carrossel_all'] = $carrossel->carrosselAll($offset, $limit);
        $array['carrossel_info'] = $carrossel->carrosselId($carrossel_id);

        $this->loadView('single_page', $array);
    }

    //Carrega uma unica Carrossel FIX
    public function carrossel_unid_fix($carrossel_id)
    {
        $array = [
            'error' => ''
        ];
        $offset = 0;
        $limit = 7;
        $carrossel_fix = new CarrosselFix();
        $carrossel = new Carrossel();
        $array['title'] = 'Carrossel FIX';
        $array['carrossel_all'] = $carrossel->carrosselAll($offset, $limit);
        $array['carrossel_info'] = $carrossel_fix->carrosselId($carrossel_id);
        $this->loadView('header', $array);
        $this->loadView('post_fixo/carrossel_fixo', $array);
        $this->loadView('footer', $array);
    }

}
