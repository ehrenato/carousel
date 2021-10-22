<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RedeEPS</title>
  <link rel="shortcut icon" href="<?= BASE_URL ?>assets/imagens/icons/icon.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/adminlte.min.css">
  <!--DATATABLES-->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/processos_sei.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">

  <script src="https://cdn.tiny.cloud/1/b0vq3ztxzl58eimggsawixoyjfznisjz16y5j89w5hqqpj4k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= BASE_URL ?>vendor/harvesthq/chosen/chosen.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="row">

        <div class="col-md-6">
          <a href="<?= BASE_URL; ?>" class="brand-link">
            <img src="<?= BASE_URL; ?>assets/imagens/icons/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">RedeEPS</span>
          </a>
        </div>
        <div class="col-md-6">
          <a href="<?= BASE_URL . 'site'; ?>" style="margin-left: -30px;" class="brand-link text-center">
            <i class="fas fa-home"></i>
          </a>
        </div>
      </div>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <?php if ($viewData["user_info"]["image"] == NULL) : ?>
              <img src="<?= BASE_URL ?>assets/imagens/usuarios/avatar.jpg" class="img-circle elevation-2" alt="User Image">
            <?php else : ?>
              <img src="<?= BASE_URL ?>assets/imagens/usuarios/<?= $viewData["user_info"]["image"]; ?>" class="img-circle elevation-2" alt="User Image">
            <?php endif; ?>
          </div>
          <div class="info">
            <a href="<?= BASE_URL; ?>user/viewUser" class="d-block">
              <?= $viewData["user_info"]["username"]; ?></a>
          </div>
        </div>
        <?php $perfilExplode = explode(',', $viewData["user_info"]['perfil']); ?>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <?php if (in_array(2, $perfilExplode)) : ?>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>carrossel" class="nav-link">
                  <i class="fas fa-image"></i>
                  <p>
                    Inserir Fotos
                  </p>
                </a>
              </li>
            <?php endif; ?>

            <?php if (in_array(4, $perfilExplode)) : ?>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>dashboard/user_all" class="nav-link">
                  <i class="fas fa-users"></i>
                  <p>
                    Usuários do Sistema
                  </p>
                </a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a href="<?= BASE_URL ?>home/sair" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Sair</p>
              </a>
            </li>
            </li>
          </ul>
        </nav>
      </div>
      <!-- /.sidebar -->
    </aside>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>

    <footer class="main-footer">
      <strong>Copyright &copy; 2011-<?= date('Y') ?> <a href="<?= BASE_URL ?>/redeeps">Site</a>.</strong>
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> <?= VERSION ?>
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= BASE_URL ?>assets/js/jquery.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script src="<?= BASE_URL ?>assets/js/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= BASE_URL ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/popper.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= BASE_URL ?>assets/js/adminlte.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="<?= BASE_URL ?>assets/js/script.js"></script>
  <script src="<?= BASE_URL ?>assets/js/jquery.dataTables.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
  <script src="<?= BASE_URL ?>vendor/harvesthq/chosen/chosen.jquery.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/upload_imagen_user.js"></script>
  <script src="<?= BASE_URL ?>assets/js/adicionar_usuario.js"></script>
  <script src="<?= BASE_URL ?>assets/js/usuario_edit.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
  <script>
    var baseUrl = '<?= BASE_URL ?>';

    if ($('#historico_change').val() !== '') {
      $('.historico_botao').css("background-color", "green");
      $('.historico_botao').text("Arquivo Pronto");
    }
    $('#historico_change').on('change', function() {
      $('.historico_botao').css("background-color", "green");
      $('.historico_botao').text("Histórico Anexado");
    });
    $('#curriculo_change').on('change', function() {
      $('.curriculo_botao').css("background-color", "green");
      $('.curriculo_botao').text("Currículo Anexado");
    });

    $('#cad-cancel').on('click', function() {
      document.location.reload(true);
    });
    $('#btn-add-file').on('click', function() {
      $('#cad-end').css('display', 'none');
      $('#cad-read').css('display', 'none');
      $('#cad-cancel').css('display', 'block');
      $('#btn-add-img').css('display', 'none');
      $('#btn-add-file').css('display', 'none');
    });
    /**PREVIEW DE ENVIO DE PDF */
    $('#enviar-pdf').on('change', function() {
      $('#custom-file').css('display', 'none');
      var img = document.createElement("IMG");
      img.src = baseUrl + "assets/imagens/pdf.jpg";
      img.style.width = "150px";
      img.style.height = "120px";
      document.getElementById('imagen_pdf').appendChild(img);
      document.getElementById('btn-enviar-pdf').style.display = 'block'
    });

    $('#btn-add-img').on('click', function() {
      $('#cad-img').css('display', 'block');
      $('#cad-end').css('display', 'none');
      $('#cad-read').css('display', 'none');
      $('#cad-cancel').css('display', 'block');
      $('#btn-add-img').css('display', 'none');
      $('#btn-add-file').css('display', 'none');
    });
    $('#btn-add-file').on('click', function() {
      $('#cad-arquivo').css('display', 'block');
    });
    /**BOTAO RELOAD DA PAGINA COM REDIRECT PRO BARRA*/
    $('#cad-end').on('click', function() {
      finalizaPost()
    });

    /**TRADUTOR DO DATATABLES */
    $(document).ready(function() {
      $('#myTable').DataTable({
        "order": [
          [0, 'desc']
        ],
        "lengthMenu": [100, 200, 400, 600],
        responsive: {
          details: {
            type: 'column',
            target: 'tr'
          }
        },
        columnDefs: [{
          className: 'control',
          orderable: false,
          targets: 0
        }],
        "language": {
          "emptyTable": "Nenhum registro encontrado",
          "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 até 0 de 0 registros",
          "infoFiltered": "(Filtrados de _MAX_ registros)",
          "infoThousands": ".",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "zeroRecords": "Nenhum registro encontrado",
          "search": "Pesquisar",
          "paginate": {
            "next": "Próximo",
            "previous": "Anterior",
            "first": "Primeiro",
            "last": "Último"
          },
          "aria": {
            "sortAscending": ": Ordenar colunas de forma ascendente",
            "sortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
            "rows": {
              "_": "Selecionado %d linhas",
              "0": "Nenhuma linha selecionada",
              "1": "Selecionado 1 linha"
            },
            "1": "%d linha selecionada",
            "_": "%d linhas selecionadas",
            "cells": {
              "1": "1 célula selecionada",
              "_": "%d células selecionadas"
            },
            "columns": {
              "1": "1 coluna selecionada",
              "_": "%d colunas selecionadas"
            }
          },
          "buttons": {
            "copySuccess": {
              "1": "Uma linha copiada com sucesso",
              "_": "%d linhas copiadas com sucesso"
            },
            "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
            "colvis": "Visibilidade da Coluna",
            "colvisRestore": "Restaurar Visibilidade",
            "copy": "Copiar",
            "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
            "copyTitle": "Copiar para a Área de Transferência",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
              "-1": "Mostrar todos os registros",
              "1": "Mostrar 1 registro",
              "_": "Mostrar %d registros"
            },
            "pdf": "PDF",
            "print": "Imprimir"
          },
          "autoFill": {
            "cancel": "Cancelar",
            "fill": "Preencher todas as células com",
            "fillHorizontal": "Preencher células horizontalmente",
            "fillVertical": "Preencher células verticalmente"
          },
          "lengthMenu": "Exibir _MENU_ resultados por página",
          "searchBuilder": {
            "add": "Adicionar Condição",
            "button": {
              "0": "Construtor de Pesquisa",
              "_": "Construtor de Pesquisa (%d)"
            },
            "clearAll": "Limpar Tudo",
            "condition": "Condição",
            "conditions": {
              "date": {
                "after": "Depois",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vazio",
                "equals": "Igual",
                "not": "Não",
                "notBetween": "Não Entre",
                "notEmpty": "Não Vazio"
              },
              "number": {
                "between": "Entre",
                "empty": "Vazio",
                "equals": "Igual",
                "gt": "Maior Que",
                "gte": "Maior ou Igual a",
                "lt": "Menor Que",
                "lte": "Menor ou Igual a",
                "not": "Não",
                "notBetween": "Não Entre",
                "notEmpty": "Não Vazio"
              },
              "string": {
                "contains": "Contém",
                "empty": "Vazio",
                "endsWith": "Termina Com",
                "equals": "Igual",
                "not": "Não",
                "notEmpty": "Não Vazio",
                "startsWith": "Começa Com"
              }
            },
            "data": "Data",
            "deleteTitle": "Excluir regra de filtragem",
            "logicAnd": "E",
            "logicOr": "Ou",
            "title": {
              "0": "Construtor de Pesquisa",
              "_": "Construtor de Pesquisa (%d)"
            },
            "value": "Valor"
          },
          "searchPanes": {
            "clearMessage": "Limpar Tudo",
            "collapse": {
              "0": "Painéis de Pesquisa",
              "_": "Painéis de Pesquisa (%d)"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Nenhum Painel de Pesquisa",
            "loadMessage": "Carregando Painéis de Pesquisa...",
            "title": "Filtros Ativos"
          },
          "searchPlaceholder": "Digite um termo para pesquisar",
          "thousands": "."
        }
      });
    });

    $(document).ready(function() {
      $('#myTable1').DataTable({
        "order": [
          [0, 'desc']
        ],
        responsive: {
          details: {
            type: 'column',
            target: 'tr'
          }
        },
        columnDefs: [{
          className: 'control',
          orderable: false,
          targets: 0
        }],
        "language": {
          "emptyTable": "Nenhum registro encontrado",
          "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 até 0 de 0 registros",
          "infoFiltered": "(Filtrados de _MAX_ registros)",
          "infoThousands": ".",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "zeroRecords": "Nenhum registro encontrado",
          "search": "Pesquisar",
          "paginate": {
            "next": "Próximo",
            "previous": "Anterior",
            "first": "Primeiro",
            "last": "Último"
          },
          "aria": {
            "sortAscending": ": Ordenar colunas de forma ascendente",
            "sortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
            "rows": {
              "_": "Selecionado %d linhas",
              "0": "Nenhuma linha selecionada",
              "1": "Selecionado 1 linha"
            },
            "1": "%d linha selecionada",
            "_": "%d linhas selecionadas",
            "cells": {
              "1": "1 célula selecionada",
              "_": "%d células selecionadas"
            },
            "columns": {
              "1": "1 coluna selecionada",
              "_": "%d colunas selecionadas"
            }
          },
          "buttons": {
            "copySuccess": {
              "1": "Uma linha copiada com sucesso",
              "_": "%d linhas copiadas com sucesso"
            },
            "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
            "colvis": "Visibilidade da Coluna",
            "colvisRestore": "Restaurar Visibilidade",
            "copy": "Copiar",
            "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
            "copyTitle": "Copiar para a Área de Transferência",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
              "-1": "Mostrar todos os registros",
              "1": "Mostrar 1 registro",
              "_": "Mostrar %d registros"
            },
            "pdf": "PDF",
            "print": "Imprimir"
          },
          "autoFill": {
            "cancel": "Cancelar",
            "fill": "Preencher todas as células com",
            "fillHorizontal": "Preencher células horizontalmente",
            "fillVertical": "Preencher células verticalmente"
          },
          "lengthMenu": "Exibir _MENU_ resultados por página",
          "searchBuilder": {
            "add": "Adicionar Condição",
            "button": {
              "0": "Construtor de Pesquisa",
              "_": "Construtor de Pesquisa (%d)"
            },
            "clearAll": "Limpar Tudo",
            "condition": "Condição",
            "conditions": {
              "date": {
                "after": "Depois",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vazio",
                "equals": "Igual",
                "not": "Não",
                "notBetween": "Não Entre",
                "notEmpty": "Não Vazio"
              },
              "number": {
                "between": "Entre",
                "empty": "Vazio",
                "equals": "Igual",
                "gt": "Maior Que",
                "gte": "Maior ou Igual a",
                "lt": "Menor Que",
                "lte": "Menor ou Igual a",
                "not": "Não",
                "notBetween": "Não Entre",
                "notEmpty": "Não Vazio"
              },
              "string": {
                "contains": "Contém",
                "empty": "Vazio",
                "endsWith": "Termina Com",
                "equals": "Igual",
                "not": "Não",
                "notEmpty": "Não Vazio",
                "startsWith": "Começa Com"
              }
            },
            "data": "Data",
            "deleteTitle": "Excluir regra de filtragem",
            "logicAnd": "E",
            "logicOr": "Ou",
            "title": {
              "0": "Construtor de Pesquisa",
              "_": "Construtor de Pesquisa (%d)"
            },
            "value": "Valor"
          },
          "searchPanes": {
            "clearMessage": "Limpar Tudo",
            "collapse": {
              "0": "Painéis de Pesquisa",
              "_": "Painéis de Pesquisa (%d)"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Nenhum Painel de Pesquisa",
            "loadMessage": "Carregando Painéis de Pesquisa...",
            "title": "Filtros Ativos"
          },
          "searchPlaceholder": "Digite um termo para pesquisar",
          "thousands": "."
        }
      });
    });

    function deleteInfo(id, id_user) {
      Swal.fire({
        title: 'Remover',
        text: "Deseja remover está publicação do mural de informativos?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Remover Agora!',
        cancelButtonText: 'Não, Desistir!',
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Removido!',
            'Publicação removida com sucesso da lista ?',
            'success',
          )
          $.ajax({
            method: "GET",
            url: baseUrl + 'dashboard/arquivo_delete?id=' + id + '&id_user=' + id_user,
            success: function(data) {
              console.log(data)
            }
          });
        }
      })
    }
  </script>
</body>

</html>

<?php
if (isset($_GET['email_enviado']) && !empty($_GET['email_enviado'] == 1)) : ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Email(s) enviado com sucesso!',
      showConfirmButton: false,
      timer: 1500
    }).then(function(result) {
      console.log(result)
      if (true) {
        window.location = baseUrl + "sistemaEmails";
      }
    })
  </script>
<?php endif; ?>

<?php
if (isset($_GET['sucesso']) && !empty($_GET['sucesso'] == 1)) : ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Cadastro atualizado com sucesso!',
      showConfirmButton: false,
      timer: 1500
    }).then(function(result) {
      console.log(result)
      if (true) {
        window.location = baseUrl + "dashboard/curriculos";
      }
    })
  </script>
<?php endif; ?>