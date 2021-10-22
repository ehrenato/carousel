<div class="content-wrapper h-100" style="min-height: 22px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="float-left">
                <p>Lista de Usuários</p>
              </div>
              <div class="float-right">
                <a href="<?= BASE_URL; ?>user/add" class="btn btn-primary">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
            <div class="card-body">
              <table id="myTable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Registro</th>
                    <th>Usuário</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <style>
                    a:link {
                      text-decoration: none;
                      color: blue;
                    }
                  </style>
                  <?php if (isset($user_list)) : ?>
                    <?php foreach ($user_list as $user) : ?>
                      <tr>
                        <td></td>
                        <td><?= $user['id']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><img src="<?= BASE_URL; ?>assets/imagens/usuarios/<?= $user['image']; ?>" height="50" alt="" srcset=""></td>

                        <td width="50">
                          <a href="<?= BASE_URL ?>user/edit_view/<?= $user['id'] ?>" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a href="<?= BASE_URL ?>user/disable?id=<?= $user['id'] ?>" class="btn btn-danger">
                            <i class="fas fa-user-times"></i>
                          </a>
                          <a href="<?= BASE_URL ?>user/reset_pass?id=<?= $user['id'] ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="A todas as senhas resetadas será atribuído o valor padrão de 123">
                            <i class="fas fa-lock-open"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>