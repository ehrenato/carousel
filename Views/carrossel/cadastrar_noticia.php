<div class="content-wrapper h-100" style="min-height: 22px;">
  <div class="content pt-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <form method="POST" action="<?= BASE_URL ?>carrossel/noticia_action">
            <input type="hidden" name="id_user" id="id_user" value="<?= $user_info['id'] ?>">
            <section class="content">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-default">
                    <div class="card-header">
                      <h6>Cadastrar Notícia</h6>
                    </div>
                    <div class="card-body">
                      <?php if (isset($_SESSION['errorMsg'])) : ?>
                        <p style="color:red;">
                          <b>
                            <?= $_SESSION['errorMsg']; ?>
                          </b>
                        </p>
                      <?php
                        $_SESSION['errorMsg'] = '';
                      endif; ?>
                      <div class="form-group">
                        <label for="inputName">Título</label>
                        <input type="text" id="id_titulo" name="titulo" class="form-control">
                        <span id="msg_titulo" style="color:red;"></span>
                      </div>
                      
                      <div class="row">
                        <div class="col-6">
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

<script>
  tinymce.init({
    selector: '#corpo',
    init_instance_callback: function(editor) {
      var freeTiny = document.querySelector('.tox-notifications-container');
      freeTiny.style.display = 'none';
    },
    height: 350,
    menubar: false,
    plugins: [
      'textcolor image media lists table fullscreen link'
    ],
    toolbar: 'undo redo | bold italic strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | link | fullscreen  preview save print | image media | ltr rtl table',
    toolbar_mode: 'floating',
    automatic_uploads: true,
    file_picker_types: 'image, file',
    images_upload_url: '<?= BASE_URL; ?>carrossel/upload_tinymce'
  });
</script>