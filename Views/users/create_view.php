<div class="content-wrapper" style="min-height: 22px;">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12">
          <form method="POST">
            <div class="card-body">
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <input type="hidden" name="user_id" id="user_id" value="<?= $user_info['id']; ?>">
                  <div class="text-center">
                    <label for="arquivo">
                      <img class="profile-user-img img-fluid img-circle img-circle-hidden" src="<?= BASE_URL ?>assets/imagens/usuarios/avatar.jpg" alt="User profile picture">
                    </label>
                  </div>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">

                      <p class="text-muted text-center">Tela de Cadastro de Usuários</p>
                      <div class="row">
                        <!-- checkbox -->
                        <div class="form-check">
                          <div class="form-check">
                            <?php for ($i = 0; $i < count($list_permissions); $i++) : ?>
                              <label for="form-check_<?= $list_permissions[$i]['id']; ?>" class="form-check-label" style="display: inline-block;padding-right:35px;">
                                <input class="form-check-input" type="checkbox" name="permissoes" id="form-check_<?= $list_permissions[$i]['id']; ?>" value="<?= $list_permissions[$i]['id']; ?>">
                                <?= $list_permissions[$i]['nome']; ?></label>
                            <?php endfor; ?>
                          </div>
                          <div id="check_error"></div>
                        </div>
                      </div>

                    </li>

                    <li class="list-group-item">
                      <label for="usuario">Usuário</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Informe o nome do usuário">
                    </li>
                    <li class="list-group-item">
                      <div id="div_error"></div>
                      <p>
                        A Senha será gerada pelo sistema e tera o valor de 123,
                        o usuário podera resetar a mesma logo após acessar o sistema.
                      </p>
                    </li>
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-1">
                          <label>Setor:</label>
                        </div>
                        <div class="col-11">
                          <select class="postName js-example-basic-single" style="width:500px" name="setor_id">

                          </select>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="form-group col-12" id="select_sub" style="display: none;">
                        <label for="exampleSelectBorder">Selecione um Sub-Setor</label>
                        <select id="sub_setores" name="sub_setores" multiple class="chosen-select">
                        </select>
                      </div>
                    </li>
                  </ul>
                  <button type="button" id="btn-cadastrar" class="btn btn-primary btn-block"><b>CADASTRAR</b></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
  $('.postName').select2({
    placeholder: 'Selecione uma pessoa',
    width: '100%',
    ajax: {
      url: "<?= BASE_URL ?>setores/searchSetores/",
      dataType: 'json',
      delay: 250,
      data: function(data) {
        return {
          searchTerm: data.term // search term
        };
      },
      processResults: function(response) {
        return {
          results: response
        };
      },
      cache: true
    }
  });
</script>