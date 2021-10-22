<div class="content-wrapper h-100" style="min-height: 22px;">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12">
          <form method="POST" action="<?= BASE_URL; ?>user/viewUserAction" enctype="multipart/form-data">
            <div class="card-body">
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                <input type="hidden" name="user_id" value="<?= $user_info['id']; ?>">
                  <div class="text-center">
                    <label for="arquivo">
                      
                        <input type="file" id="arquivo" name="arquivo" style="display: none;"/>
                      
                        <img class="profile-user-img img-fluid img-circle img-circle-show" id="imagem" src="#" alt="" style="display: none;">
                      <?php if($user_info['image']==NULL):?>
                        <img class="profile-user-img img-fluid img-circle img-circle-hidden" src="<?= BASE_URL ?>assets/imagens/usuarios/avatar.jpg" alt="User profile picture">
                      <?php else: ?>
                        <img class="profile-user-img img-fluid img-circle img-circle-hidden" src="<?= BASE_URL ?>assets/imagens/usuarios/<?= $user_info['image'];?>" alt="User profile picture">
                      <?php endif;?>

                    </label>
                  </div>

                  <h3 class="profile-username text-center"><?= $user_info['username'] ?></h3>

                  <p class="text-muted text-center">Software Engineer</p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <label for="usuario">Usuário</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $user_info['username'] ?>">
                    </li>
                    <li class="list-group-item">
                      <label for="senha">Informe uma nova Senha</label>
                      <input type="password" name="senha" class="form-control"  placeholder="Informe uma nova senha">
                    </li>
                    <li class="list-group-item">
                      <label for="senha">Confirme sua nova senha</label>
                      <input type="password" name="confirma_senha" class="form-control" placeholder="Confirme sua nova senha">
                    </li>
                    <?php if(isset($_SESSION['errorSenha']) && !empty($_SESSION['errorSenha'])):?>
                      <li class="list-group-item">
                      <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                          <?= $_SESSION['errorSenha']; ?>
                        </div>
                        <?php unset($_SESSION['errorSenha']);?>
                      </li>
                    <?php endif;?>
                  </ul>
                  <button class="btn btn-primary btn-block"><b>Editar</b></button>
                 
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>