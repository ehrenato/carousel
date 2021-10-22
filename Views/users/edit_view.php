<div class="content-wrapper h-100" style="min-height: 22px;">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12">
          <form method="POST">
            <div class="card-body">
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <input type="hidden" name="user_id" value="<?= $user_info['id']; ?>">
                  <div class="text-center">
                    <label for="arquivo">
                      <?php if ($user_id['image'] == NULL) : ?>
                        <img class="profile-user-img img-fluid img-circle img-circle-hidden" src="<?= BASE_URL ?>assets/imagens/usuarios/avatar.jpg" alt="User profile picture">
                      <?php else : ?>
                        <img class="profile-user-img img-fluid img-circle img-circle-hidden" src="<?= BASE_URL ?>assets/imagens/usuarios/<?= $user_id['image']; ?>" alt="User profile picture">
                      <?php endif; ?>

                    </label>
                  </div>
                  <h3 class="profile-username text-center"><?= $user_id['username'] ?></h3>
                  <input type="hidden" name="id_user" id="id_user" value="<?= $user_id['id'] ?>">
                  <p class="text-muted text-center">Software Engineer</p>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <p class="text-muted text-center">Tela de Cadastro de Usuários</p>
                      <div class="row">
                        <!-- checkbox -->
                        <div class="form-check">
                          <div class="form-check">
                            <?php 
                            $perfil_explode = explode(',', $user_id['perfil']);
                            for ($i = 0; $i < count($list_permissions); $i++) : 
                            ?>
                              <label for="form-check_<?= $list_permissions[$i]['id']; ?>" class="form-check-label" style="display: inline-block;padding-right:35px;">
                                <input class="form-check-input" type="checkbox" name="permissoes" id="form-check_<?= $list_permissions[$i]['id']; ?>" value="<?= $list_permissions[$i]['id']; ?>" <?php if(in_array($list_permissions[$i]['id'],$perfil_explode)){ echo 'checked="checked"';}?>>
                                <?= $list_permissions[$i]['nome']; ?></label>
                            <?php 
                          endfor; 
                          ?>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <label for="usuario">Usuário</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $user_id['username'] ?>">
                      <div id="check_error"></div>
                      <div id="div_error"></div>
                    </li>
                    <div id="senha_error"></div>
                    <?php if (isset($_SESSION['errorSenha']) && !empty($_SESSION['errorSenha'])) : ?>
                      <li class="list-group-item">
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                          <?= $_SESSION['errorSenha']; ?>
                        </div>
                        <?php unset($_SESSION['errorSenha']); ?>
                      </li>
                    <?php endif; ?>
                  </ul>
                  <button type="button" class="btn btn-primary btn-block" id="btn-editar"><b>Editar</b></button>

                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>