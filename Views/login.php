<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tela de Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="text-center">
      <img class="mb-4" src="<?= BASE_URL ?>/assets/imagens/icons/cp_logo_governo.png" alt="" width="72" height="72">
    </div>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="img/small_suinin_logo.png" alt="" srcset="">
        <span style="color:#0D7BFF;"><b>Sistema </b>de autenticação SESAP</span>
      </div>
      <div class="card-body">
        <form action="<?= BASE_URL ?>login/signin" method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Usuário">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-user"></i>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" placeholder="Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">
          <i class="fas fa-sign-in-alt mr-1"></i>  
          Acessar</button>
          <?php if (!empty($msg)) : ?>
            <div class="warning">
              <?= $msg ?>
            </div>
          <?php endif; ?>
        </form>
        <!-- <a href="<?= BASE_URL ?>login/signup">Cadastro</a> -->
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-around">
    <img class="mb-4 mt-4 mr-5" src="<?= BASE_URL ?>/assets/imagens/icons/small_suinin_logo.png" alt="" height="50" width="50">

    <img class="mb-4 mt-2 ml-5" height="80" width="80" src="<?= BASE_URL ?>/assets/imagens/icons/gtroigueiro.png" alt="" >
  </div>


  <!-- jQuery -->
  <script src="assets/js/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/adminlte.min.js"></script>
</body>

</html>