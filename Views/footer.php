<div id="footer" class="row" style="background-color:black; margin-right: 0; margin-left: 0; width: 100%; height: 75px; position: absolute; bottom: 0; left: 0;">

  <div class="col-6 text-white text-center">
Ícones
  </div>

  <div class="col-6 text-white text-center">
Endereço
  </div>


</div>

<script>
  $(document).ready(function() {

    $(".Modern-Slider").slick({
      autoplay: true,
      //autoplaySpeed:10000,
      speed: 600,
      slidesToShow: 1,
      slidesToScroll: 1,
      pauseOnHover: true,
      dots: true,
      pauseOnDotsHover: true,
      cssEase: 'linear',
      fade: true,
      arrows: false,
      draggable: true,
      /*prevArrow:'<button class="PrevArrow"> < </button>',
      nextArrow:'<button class="NextArrow"> ></button>',*/
    });
  });
</script>

<?php if (isset($_GET['insert']) && $_GET['insert'] == '1') : ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Cadastro realizado com sucesso!',
      showConfirmButton: false,
      timer: 1500
    }).then(function(result) {
      if (true) {
        window.location = baseUrl + "site";
      }
    })
  </script>
<?php endif; ?>

</body>

</html>