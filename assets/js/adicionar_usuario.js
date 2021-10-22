/*$('.chosen-select').chosen({ width: '100%' }); $('.chosen-select-deselect').chosen({ allow_single_deselect: true });*/
$('#btn-cadastrar').on('click', function(){
   
    var usuario = $('#usuario').val();
    var logado_id = $('#user_id').val();
    perfis = [];
    $('form input[type=checkbox]:checked').each(function() {
        perfis.push($(this).val());
    });
 
   console.log(perfis)
   

        if(usuario==''){
            $('#usuario').css('border','1px solid red');
            setTimeout(function() {
                $('#usuario').removeAttr('style');
            }, 2000);
            return false;
        }

        if(perfis==''){
            html = '<div class="alert alert-warning alert-dismissible mt-2">';
            html+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            html+='<h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>';
            html+= '<b>Escolha um pefil de usuário</b>';
            html+='</div>';
            $("#check_error").append(html);
            setTimeout(function(){
                $("#check_error").fadeOut("slow");  
            }, 3000);
            return false;
        }

        if(usuario && perfis){
            $.ajax({
                url:baseUrl+'user/add_action',
                method:'POST',
                data:{usuario:usuario,logado_id:logado_id,perfis:perfis},
                success:function(retorno){
                    var objJSON = JSON.parse(retorno);
                   if(objJSON.userExists){
                        $('#usuario').css('border','1px solid red');
                        html = '<div class="alert alert-warning alert-dismissible">';
                        html+='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                        html+='<h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>';
                        html+= '<b>'+objJSON.userExists+'</b>';
                        html+='</div>';
                        $("#div_error").append(html);
                    setTimeout(function(){
                        $('#usuario').removeAttr('style');
                        $("#div_error").fadeOut("slow");  
                    }, 3000);
                    return false;
                   } else {
                       Swal.fire({
                           position: 'center',
                           icon: 'success',
                           title: 'Usuario cadastrado com sucesso ;)',
                           showConfirmButton: false,
                           timer: 1500
                         }).then(function(result) {
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
        }
});

