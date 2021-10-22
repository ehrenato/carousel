$('#img_file').on('change', function () {
  $('#img_file').css('display', 'none');
});

$('#file-upload').on('change', function () {
  $('.custom-file-upload').css('display', 'none');
  $('.files-full-upload').css('display', 'block');
});



var loadFile = function (event) {
  var output = document.getElementById('output');
  output.src = URL.createObjectURL(event.target.files[0]);
};

function carregamento() {
  // Chama a função ao carregar a tela
  countdown();
  document.getElementById('loader').style.display = 'block';
  document.getElementById('timeFinal').style.display = 'block';
  document.getElementById('body-form').style.display = 'none';
  document.getElementById('titulo_va').style.display = 'none';
  document.getElementById('cx-header').style.display = 'none';
}

var tempo = 0;
$('#myAlert').hide();

function countdown() {
  // Se o tempo não for zerado
  if ((tempo + 1) >= +1) {
    // Pega a parte inteira dos minutos
    var min = parseInt(tempo / 60);
    // Calcula os segundos restantes
    var seg = tempo % 60;
    // Formata o número menor que dez, ex: 08, 07, ...
    if (min < 10) {
      min = "0" + min;
      min = min.substr(0, 2);
    }
    if (seg <= 9) {
      seg = "0" + seg;
    }
    // Cria a variável para formatar no estilo hora/cronômetro
    horaImprimivel = '00:' + min + ':' + seg;
    //JQuery pra setar o valor
    $("#timer").html(horaImprimivel);
    // Define que a função será executada novamente em 1000ms = 1 segundo
    setTimeout('countdown()', 1000);
    // diminui o tempo
    tempo++;
    // Quando o contador chegar a zero faz esta ação
  }
  else {
    $('#myAlert').show().fadeOut(5000);
  }
}

