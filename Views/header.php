<?php header('Access-Control-Allow-Origin: *'); ?>
<?php header('Access-Control-Allow-Methods: POST, GET'); ?>
<?php header('Access-Control-Allow-Headers: *'); ?>
<?php header('Access-Control-Max-Age: 86400'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="Carossel Imagens Mysql PHP">

  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-4E4YJKRYPV');
  </script>

  <title>Home - <?= $title ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="../assets/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  
  <!--CARROSSEL-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick-theme.css">

  <!--DATATABLES-->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/jquery.dataTables.min.css">

  <!-- FULLCALENDAR -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.js"></script>
  <script src="https://cdn.tiny.cloud/1/b0vq3ztxzl58eimggsawixoyjfznisjz16y5j89w5hqqpj4k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/toastr.min.css">


</head>

<body>

  <!--NAVBAR-->
  <nav id="navbarToggle" class="navbar navbar-expand-lg navbar-light bg-light mouse_over_effect" style="background-color: #005BAA !important ;">

    <div class="collapse navbar-collapse text-white" id="main_nav">
      <ul id="ulNavbar" class="navbar-nav mr-auto">
        <a class="nav-link text-white" href="" style="margin-right: 10px;">HOME</a>
        <li class="nav-item dropdown ">

          <a class="nav-link  dropdown-toggle text-white" style="margin-right: 10px;" href="#" data-toggle="dropdown">MENU</a>
          <ul class="dropdown-menu dropdown_color" style="font-size: 12px; background-color: #005ba3;">
            <li id="liNavbar">
              <a class="dropdown-item text-white" style="margin-right: 10px;" href="">Menu 1</a>
            </li>
            <li id="liNavbar">
              <a class="dropdown-item text-white" style="margin-right: 10px;" href="">Menu 2</a>
            </li>
          </ul>
        </li>
      </ul>

      <div id="navbarTools" class="row">

       

        <div id="toolsLogin" class="col-6">
          <a class="p-2 text-white" href="<?= BASE_URL ?>/login/signin" target="_blank"><i class="fas fa-key fa-2x"></i></a>
        </div>
        <!-- </span> -->
      </div>

    </div>
  </nav>

  <!--FIM NAV-->
  </header>