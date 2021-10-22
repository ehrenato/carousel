  <!-- START CAROUSEL  -->
  <!-- <div class="row">
    <div class="col-md-12"> -->
      <div class="carousel">
        <div class="Modern-Slider">

          <!-- Item -->
          <?php if (isset($carrossels) && !empty($carrossels)) : ?>
            <?php foreach ($carrossels as $carrossel) : ?>
              <div class="top_slider">
                <div class="slide">
                  <a href="<?= BASE_URL ?>site/carrossel_unid/<?= $carrossel['id'] ?>"></a>
                
                  
                    <div class="text-left" style="position: relative;">

                    <label style="position: absolute; font-size: 50px; left: 100px; top: 135px; color: white; z-index: 99"><?= $carrossel['titulo'] ?></label>                                              
                    <img src="<?= BASE_URL ?>media/upload/images/<?= $carrossel['image'] ?>" style="width: 100%; height: 300px; object-fit: fill; filter: blur(1px)" />

                    </div>
                 
                </div>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <div class="top_slider">
              <div class="slide">
                <img src="<?= BASE_URL ?>assets/imagens/default.jpg" style="width: 100%; height: 300px;">
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
    <!-- </div>
  </div> -->

<!-- END CAROUSEL  -->