<div class="content-wrapper" style="min-height: 22px;">
  <div class="content pt-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <form method="POST" action="<?= BASE_URL ?>carrossel/img_carousel_action/<?= $_GET['last_id']?>" enctype="multipart/form-data">
            <input type="hidden" name="id_user" id="id_user" value="<?= $user_info['id'] ?>">
            <section class="content">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-default">
                    <div class="card-header">
                      Cadastrar Imagem do Carousel
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <div class="col-lg-6">
                          <div class="form-group">
                          <img id="blah" alt="your image" width="250" height="150" /><br>
                          <input class="img_file" type="file" name="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                          </div>
                        </div>
                      </div>
                    </div>
              <div class="col-12 card-buttons">
                <div class="card-footer">
                  <a href="<?= BASE_URL; ?>carrossel" class="btn btn-secondary">Cancelar</a>
                  <input type="submit" name="btn-salvar" id="btn-salvar" value="Salvar" class="btn btn-success">
                </div>
              </div>
                  </div>
                </div>
              </div>
        </div>
        </section>
        </form>
      </div>
    </div>
  </div>
</div>
</div>