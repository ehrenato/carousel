
<div class="content-wrapper" style="min-height: 22px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Informativo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Informativo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Finalizar Post</h3>
                <div class="d-flex justify-content-end">
                  <button type="button" class="btn bg-gradient-success btn-xs mr-1" id="btn-add-img">
                    <span style="font-size: 15px;">
                      Adicionar Imagem
                      <i class="fas fa-plus"></i>
                    </span>
                    </button>
                    <button type="button" class="btn bg-gradient-primary btn-xs mr-1" id="btn-add-file">
                    <span style="font-size: 15px;">
                      Adicionar Arquivo
                      <i class="far fa-file-pdf"></i>
                    </span>
                    </button>
                    <button type="button" class="btn bg-gradient-danger btn-xs mr-1"  id="cad-end">
                      <span style="font-size: 15px;">
                        Finalizar Cadastro
                        <i class="fas fa-play"></i>
                        </span>
                      </button>
                      <button type="button" class="btn bg-gradient-warning btn-xs" id="cad-cancel" style="display: none;">
                      <span style="font-size: 15px;">
                      Cancelar
                      <i class="fas fa-sync"></i>
                        </span>
                      </button>
                </div>
              </div>
              <!--ADD_IMAGEN-->
              <div class="card-body" style="display: none;" id="cad-img">
              <form action="<?= BASE_URL?>info/imagem_up_insert" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_post" value="<?= $_SESSION['last_id']?>">
              <input type="hidden" name="id_user" value="<?= $_SESSION['info_id']?>">
                    <img id="output" style="max-height:150px;max-width:400px;width: 200px;height: 120px;display:none; margin-bottom:5px;"/>
              <div class="row">
                <div class="custom-file col-lg-4 mr-1" id="custom-img">
                    <input type="file" class="custom-file-input" name="img" accept="image/*" onchange="loadFile(event)"/>
                    <label class="custom-file-label" for="customFile">Enviar Imagem</label>
                </div>
                    <button type="submit" class="btn btn-secondary col-lg-2 ml-1 mb-3" style="display:none;" id="btn-enviar">Enviar Imagem</button>
              </div>
              <?php if(isset($_GET['id_img']) && $_GET['id_img']=='empty'):?>
                <div class="alert alert-alert alert-dismissible fade show" role="alert">
                  <strong>Imagem</strong> Obrigátoria.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif;?>
              </form>

              </div>
              <!-- /.card-body -->
              <!--ARQUIVO-->
              <div class="card-body" style="display: none;" id="cad-arquivo">
              <form action="<?= BASE_URL?>info/arquivo_up_insert" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_post" value="<?= $_SESSION['last_id']?>">
              <input type="hidden" name="id_user" value="<?= $_SESSION['info_id']?>">
                    <img id="output" style="max-height:150px;max-width:400px;width: 200px;height: 120px;display:none; margin-bottom:5px;"/>
              <div class="row">
                <div class="custom-file col-lg-4 mr-1" id="custom-file">
                    <input type="file" class="custom-file-input" name="enviar-pdf" accept="application/pdf" id="enviar-pdf"/>
                    <label class="custom-file-label" for="customFile">Enviar Arquivo</label>
                </div>
                  <div id="imagen_pdf"></div>
              </div>
                  <button type="submit" class="btn btn-secondary mt-1" style="display:none;" id="btn-enviar-pdf">Enviar Arquivo</button>
              <?php if(isset($_GET['id_img']) && $_GET['id_img']=='empty'):?>
                <div class="alert alert-alert alert-dismissible fade show" role="alert">
                  <strong>Arquivo</strong> Obrigátorio.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif;?>
              </form>

              </div>
            </div>
            </div>
        </div>
    </div>
</section>
</div>


