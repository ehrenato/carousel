//Verifica o tamanho ao recarregar pagina
$(document).ready(function() {
    tamanhoCards();
  });
  
  //redimensiona de acordo a tamanho de dispositivos
  $( window ).resize(function() {
    tamanhoCards();
  });

  //Verificar maior e ajustar os demais botoes de acordo
  function tamanhoCards(){
    var maior = 0;
    $("#cards div.card").each(function(){
      if($(this).find("a").height()>maior){
        maior=$(this).find("a").height();
      }
    //console.log($(this).find("a").height());
    });
    console.log(maior);
    $("#cards div.card a").height(maior);
  }