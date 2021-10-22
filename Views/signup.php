<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="container">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <img src="img/small_suinin_logo.png" alt="" srcset="">
          <a href="index.php" class="h1"><b>Cadastre-se</b></a>
        </div>
        <div class="card-body">
          <form action="<?= BASE_URL ?>login/signup" method="POST">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="username" placeholder="Usuario" value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="pass" placeholder="Senha" value="<?= isset($_POST['pass']) ? $_POST['pass'] : ''; ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="pass_confirm" placeholder="Confirmar Senha" value="<?= isset($_POST['pass_confirm']) ? $_POST['pass_confirm'] : ''; ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="btn-acessar">Acessar</button>
            <?php if (isset($msg) && !empty($msg)) : ?>
              <div class="warning">
                <?= $msg ?>
              </div>
            <?php
            endif; ?>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= BASE_URL ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASE_URL ?>assets/js/adminlte.min.js"></script>
</body>

</html>