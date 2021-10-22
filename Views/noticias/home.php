<div class="content-wrapper" style="min-height: 22px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-12">
          <div class="card">
            <div class="card-header">
              Suas Fotos
              <a href="<?= BASE_URL ?>noticias/noticia_form" role="button" class="btn btn-primary btn-sm float-right">
                <i class="fas fa-plus"></i>
                Eviar Foto
              </a>
            </div>
            <div class="card-body">
              <table id="myTable">
                <thead>
                  <tr>
                    <th></th>
                    <th>Nº Registro</th>
                    <th>Título</th>
                    <th>Criado</th>
                    <th>Por</th>
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
                  <?php if (isset($total)) : ?>
                    <?php foreach ($total as $t) : ?>
                      <?php if ($t['fixo'] == 0) : ?>
                        <tr>
                          <td></td>
                          <td><?= $t['id'] ?></td>
                          <td><?= mb_strimwidth($t['titulo'], 0, 15, '...') ?></td>
                          <td><?= date('d/m/Y H:s', strtotime($t['create_at'])) ?></td>
                          <td><?= strtoupper($t['username']) ?></td>
                          <td>
                          <a href="<?= BASE_URL ?>noticias/noticia_update_form?id=<?= $t['id'] ?>" class="text-none">
                              <i class="fas fa-edit" style="color:#F6C355"></i>
                            </a>
                            <a class="text-none" data-toggle="modal" data-target="#staticBackdrop_<?= $t['id'] ?>">
                              <i class="fas fa-eye" style="color:#4AB080;cursor:pointer;"></i>
                            </a>
                            <a class="text-none" onclick="deleteInfo('<?= $t['id'] ?>', '<?= $_SESSION['info_id'] ?>')">
                              <i class="fas fa-file-export" style="color:red;cursor:pointer;"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  
                  <!-- <?php if (isset($noticias)) : ?>
                    <?php foreach ($noticias as $t) : ?>
                      <tr>
                        <td></td>
                        <td><?= $t['id'] ?></td>
                        <td><?= mb_strimwidth($t['titulo'], 0, 15, '...') ?></td>
                        <td><?= date('d/m/Y H:s', strtotime($t['created_at'])) ?></td>
                        <td><?= strtoupper($t['username']) ?></td>
                        <td class="text-center">
                          <a href="<?= BASE_URL ?>noticias/noticia_update_form?id=<?= $t['id'] ?>">
                            <button class="btn btn-sm btn-warning" style="color: #fff;"><i class="fas fa-pencil-alt fa-xs"></i></button>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?> -->
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

</div>