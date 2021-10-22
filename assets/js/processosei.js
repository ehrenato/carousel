$(document).ready(function () {
    //$('[data-toggle="tooltip"]').tooltip();
    tempoRefreshPage();
    $("body").addClass("sidebar-collapse");
});
$("#btnTempo").click(function () {
    var valor = $("#tempo").val();
    if (valor < 15) {
        $("#msg").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">O mínimo de tempo para recarregar a página é de 15 minutos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    } else {
        $("#tempoModal").modal('hide')
        $("#msg").html("");
        localStorage.setItem('tempo', $("#tempo").val());
        tempoRefreshPage();
    }
});
function tempoRefreshPage() {
    var tempo = localStorage.getItem('tempo');
    if (tempo == null) {
        tempo = 30;
        $("#tempo").val(30);
    } else {
        $("#tempo").val(tempo);
    }
    setTimeout(function () {
        window.location.reload(1);
        var elem = document.documentElement;
        elem.requestFullscreen();
        $("body").addClass("sidebar-collapse");
    }, (tempo * 60000));
}
$(".btnDelete").click(function () {
    var processo_id = $(this).data("catid");
    $("#catid").val(processo_id);
    console.log(processo_id);
});
function btnDeletar() {
    var submissao_id = $("#catid").val();
    console.log(submissao_id);
    deletar(submissao_id);
}
function deletar(id) {
    //console.log(baseUrl+"sei/delete/"+id);
    $.ajax({
        type: "DELETE",
        url: baseUrl+"sei/delete/"+id,
        context: this,
        success: function (data) {
            //remoção da linha deletada
            e = $("[data-catid='" + id + "']").closest("tr");
            if (e) e.remove();
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
  var targetId = "_hiddenCopyText_";
  var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
  var origSelectionStart, origSelectionEnd;
  if (isInput) {
      // can just use the original source element for the selection and copy
      target = elem;
      origSelectionStart = elem.selectionStart;
      origSelectionEnd = elem.selectionEnd;
  } else {
      // must use a temporary form element for the selection and copy
      target = document.getElementById(targetId);
      if (!target) {
          var target = document.createElement("textarea");
          target.style.position = "absolute";
          target.style.left = "-9999px";
          target.style.top = "0";
          target.id = targetId;
          document.body.appendChild(target);
      }
      target.textContent = elem.textContent;
  }
  // select the content
  var currentFocus = document.activeElement;
  target.focus();
  target.setSelectionRange(0, target.value.length);
  
  // copy the selection
  var succeed;
  try {
        succeed = document.execCommand("copy");
  } catch(e) {
      succeed = false;
  }
  // restore original focus
  if (currentFocus && typeof currentFocus.focus === "function") {
      currentFocus.focus();
  }
  
  if (isInput) {
      // restore prior selection
      elem.setSelectionRange(origSelectionStart, origSelectionEnd);
  } else {
      // clear temporary content
      target.textContent = "";
  }
  return succeed;
}
$(".copy_num_processo").click(function(){
    console.log( "Número "+$(this).val()+" copiado.");
    var $temp = $("<input>");
    $("body").append($temp);
    $(this).prop("title", "Número "+$(this).val()+" copiado.");
    $(this).trigger("hover");
    $temp.val($(this).val()).select();
    document.execCommand("copy");
    $temp.remove();
});
$(".copy_num_processo").hover(function(){},function(){
    $(".copy_num_processo").prop("title", "Clique para copiar o número do protocolo para a área de transferência.");
});
