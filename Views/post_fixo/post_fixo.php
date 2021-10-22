<main role="main" class="container">
  <div class="row">
    <div class="col-md-9 blog-main">
      <div class="blog-post">
        <h4 id="text-uppercase" style="border:1px solid #CCC; font-size: 19px;" class="card-header text-center mt-2"><?= $post_info['titulo']; ?></h4>
        <?php if(!is_null($post_info['image']) && !empty($post_info['image'])):?>
        <img src="<?= BASE_URL ?>media/upload/images/<?= $post_info['image'] ?>" alt="Imagem de capa do card" style="height: 100%;width:100%;">
        <?php endif;?>
        <hr>
      </div><!-- /.blog-post -->
      <div class="blog-post text-justify">
        <?= html_entity_decode(str_replace('../', BASE_URL, stripslashes($post_info['$carrossel']))); ?><br>
        <ul class="list-group">
          <li class="list-group-item ">
            <div class="row">
              <div class="">
                <div class="text-left">
                  <b>Publicado por: </b><?= ucfirst($post_info['username']); ?> <b>, em</b>
                  <!-- <?php echo date('d/m/Y', strtotime($post_info['create_at'])); ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp -->
                </div>
              </div>
              <div class="">
              <div class="">
                  <?php $setores_explode =  explode(',', $post_info['setores']); ?>
                  <?php foreach ($setores_explode as $setor) : ?>
                    <?php if ($setor == '1') : ?>
                      <a href="#" class="text-info"> RedeEPS/</a>
                    <?php endif; ?>
                    <?php if ($setor == '2') : ?>
                      <a href="#" class="text-success"> SGES/</a>
                    <?php endif; ?>
                    <?php if ($setor == '3') : ?>
                      <a href="#" class="text-warning"> ESP/</a>
                    <?php endif; ?>
                    <?php if ($setor == '4') : ?>
                      <a href="#" class="text-dark"> SESAP</a>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div><!-- /.blog-post -->

      <div class="blog-post">
        <div class="container row mt-2">
          <?php
          $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
          $isMob = is_numeric(strpos($ua, "mobile"));
          ?>
          <?php if (!$isMob) : ?>
            <a class="btn btn-success btn-sm mr-2" href="https://web.whatsapp.com/send?text=<?= BASE_URL; ?>site//<?= $post_info['id']; ?>" target="_blank">Compartilhar <i class="fab fa-whatsapp"></i> </a>
          <?php else : ?>
            <a class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?text=<?= BASE_URL; ?>site//<?= $post_info['id']; ?>" target="_blank">Compartilhar <i class="fab fa-whatsapp"></i></a>
          <?php endif; ?>

        </div>
        <hr>
        <a class="btn btn-danger btn-sm mb-3 mt-2" href="<?= BASE_URL ?>" role="button">
          <i class="fas fa-angle-left"></i> Voltar
        </a>
      </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

    <aside class="col-md-3 blog-sidebar">

      <div class="p-2">
        <div class="card">
          <div class="card-header">
            Últimas Notícias
          </div>
          <ul class="list-group list-group-flush">
            <?php foreach ($post_all as $carrossel) : ?>
              <li class="list-group-item">
                <span class="badge badge-pill badge-danger">
                  <?= date('d/m/Y', strtotime($carrossel['create_at'])) ?> <?= date('H:i:s', strtotime($carrossel['create_at'])) ?>
                </span>
                <br>
                <a href="<?= BASE_URL ?>site/post_unid/<?= $carrossel['id'] ?>">
                  <?= $carrossel['titulo']; ?> <br>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <a href="<?= BASE_URL ?>site/post_all" class="badge mt-1" style="background-color:#DC3545;color:#FFF;" tabindex="0">+ Ver Todas</a>
        </ol>
      </div>
    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</main>
