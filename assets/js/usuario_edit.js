$('#btn-editar').on('click',function(){
    perfis = [];
    $('form input[type=checkbox]:checked').each(function() {
        perfis.push($(this).val());
    });
    var usuario= $('#usuario').val();
    var id_user = $('#id_user').val(); 
    $.ajax({
        url:baseUrl+'user/edit_action',
        method:'POST',
        data:{usuario:usuario,perfis:perfis,id_user:id_user},
        success:function(retorno){
            var objJSON = JSON.parse(retorno);
                   if(objJSON.resposta==='error'){
                        $('#usuario').css('border','1px solid red');
                        html = '<div class="alert alert-warning alert-dismissible mt-3">';
                        html+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                        html+='<h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>';
                        html+= '<b>'+objJSON.userExists+'</b>';
                        html+='</div>';
                        $("#div_error").html(html);
                        $("#div_error").fadeIn("slow");  
                    setTimeout(function(){
                        $('#usuario').removeAttr('style');
                       $("#div_error").fadeOut("slow");
                    }, 3000);
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Usuario editado com sucesso ;)',
                        showConfirmButton: false,
                        timer: 1500
                      }).then(function(result) {
                        console.log(result)
                        if (true) {
                            window.location.href = baseUrl+'dashboard/user_all'
                        }
                      })
                }
        },
        error:function(err){
            console.log(err)
        }
    });
});