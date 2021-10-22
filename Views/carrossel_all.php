<main role="main">
  <div class="album py-5 bg-light">
    <div class="container">
      <style>
        .borda:hover {
          border: solid 1px #00FFFF;
          cursor: pointer;
        }

        a:link {
          text-decoration: none;
        }
      </style>
      <div class="row">
        <?php if(isset($carrossel_all)):?>
          <?php foreach ($carrossel_all as $carrossel) : ?>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow borda">
                <a href="<?= BASE_URL ?>site/carrossel_unid/<?= $carrossel['id'] ?>">
                  <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?= BASE_URL ?>media/upload/images/<?= $carrossel['image'] ?>">
                  <div class="card-body">
                    <p class="card-text" style="color: #000;" id="text-uppercase"><?=($carrossel['titulo']); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <small class="text-muted">
                        <b>Data da publicação: </b><?= date('d/m/Y', strtotime($carrossel['create_at'])); ?>
                        <br>
                        <b>
                          Postado Por:
                        </b><?= $carrossel['username']; ?>
                      </small>
                </a>
              </div>
            </div>
        </div>
    </div>
  <?php endforeach; ?>
  <?php endif; ?>
  </div>

  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <?php if ($paginas > 1 && $paginaAtual <= $paginas) : ?>
        <?php for ($i = $init_page; $i <= $end_page; $i++) : ?>
          <?php if ($i == $paginaAtual) : ?>
            <li class="page-item active">
              <a class="page-link" href="<?= BASE_URL ?>site/carrossel_all?p=<?= $i; ?>"><?= $i; ?><span class="sr-only">(current)</span></a>
            </li>
          <?php else : ?>
            <li class="page-item">
              <a class="page-link" href="<?= BASE_URL ?>site/carrossel_all?p=<?= $i; ?>"><?= $i; ?></a>
            </li>
          <?php endif ?>
        <?php endfor; ?>
      <?php endif; ?>
    </ul>
  </nav>
  <hr>
  <a class="btn btn-danger btn-sm mb-3 mt-2" href="<?= BASE_URL?>" role="button">
          <i class="fas fa-angle-left"></i> Voltar
         </a>  
  </div>
  </div>
</main>