  var arquivo = $("#arquivo");
  var imagem = $("#imagem");
  var hidde_image = $('.img-circle-hidden');
  var show_image = $('.img-circle-show');

  arquivo.on("change", function() {
    if (arquivo[0].files.length == 0)
        return false;
    
    hidde_image.hide();
    show_image.show();
    var file = arquivo[0].files[0];
    var url = URL.createObjectURL(file);
    imagem.attr("src", url);
    imagem.attr("title", file.name);
    console.log(arquivo[0].files[0]);
  });
