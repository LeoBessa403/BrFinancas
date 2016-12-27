var Funcoes = function () {
    var inicio = function () {
        
                //VARIÁVEIS GLOBAIS
                var dados       = constantes();
                var urlValida   = dados['HOME'] + 'admin/Controller/Ajax.Controller.php';
                var upload      = dados['PASTAUPLOADS'];
                
               // MASCARA DE CADASTRO DE LIVROS 
               $("#nu_ano_publicacao").mask("9999").change(function(){
                    var ano = $(this).val();
                    var Hoje     = new Date();
                    var AnoAtual = Hoje.getFullYear();
                    
                    if(ano > AnoAtual){
                        Funcoes.Alerta(Funcoes.MSG02);
                        $(this).val("");
                        return false;
                    }else if(ano < 1950){
                        Funcoes.Alerta(Funcoes.MSG03);
                        $(this).val("");
                        return false;
                    }
               });
               $("#nu_edicao").mask("9?99");
               $("#quantidade").mask("9?99");
               $("#nu_paginas").mask("9?99");
               
               
               $("#ds_pastoral_ativo").change(function(){
                   disabilitaCamposRetiro();
               })
                
                
                // CADASTRO De Retiro de Carnaval
                function disabilitaCamposRetiro(){ 
                    if($("#ds_pastoral_ativo").prop('checked')){
                        $("#ds_pastoral").parent(".form-group").slideDown("slow");
                    }else{
                        $("#ds_pastoral").parent(".form-group").slideUp("fast");
                    }
                }

                disabilitaCamposRetiro();
                
                
                
               $("#st_status").change(function(){
                   disabilitaDtTermino();
               })
                
                // CADASTRO de Tarefa
                function disabilitaDtTermino(){ 
                    if($("#st_status").val() == "C"){
                        $("#dt_conclusao").parent().parent(".form-group").slideDown("slow");
                        $("#dt_conclusao").addClass("ob");
                    }else if($("#st_status").val() == "I"){
                        $("#dt_conclusao").parent().parent(".form-group").slideUp("fast").removeClass("has-error");
                        $("#dt_conclusao").removeClass("ob");
                    }else{
                        $("#dt_conclusao").parent().parent(".form-group").slideUp("fast").removeClass("has-error");
                        $("#dt_conclusao").val("").removeClass("ob");
                    }
                       
                }

                disabilitaDtTermino();
                
                // Valida data
                $("#dt_nascimento").change(function(){
                    var idade = 14; // Idade limite para aceitar o cadastro Maior que a Idade
                    var ano   = $(this).val().substring(6,10);
                    var Hoje     = new Date();
                    var AnoAtual = Hoje.getFullYear();
                    var novoAno  = AnoAtual - idade;
                    
                    if(ano > novoAno){
                        Funcoes.Alerta(Funcoes.MSG01);
                        $(this).val("");
                        $(".dt_nascimento").parent(".form-group").addClass('has-error').removeClass('has-success');
                        $('span#dt_nascimento-info').text("Para maiores de 14 anos");
                        return false;
                    }
                })
               
                function verificaTodas(){
                        var todas = true;
                        $(".funcionalidade").each(function() { 
                            $(".todas").prop("checked",$(".funcionalidade").prop('checked'));
                        if(!$(this).prop('checked')){    
                            todas = false;
                        } 
                    });
                    if(todas){
                        $(".todas").prop("checked",true);
                    }else{
                        $(".todas").prop("checked",false);
                }
                }
                
                
                // VINCULAÇÃO FUNCIONALIDADES AO PERFIL // BOTÃO TODOS FUNCIONALIDADES
                $(".todas").change(function(){
                    $(".funcionalidade").each(function() {
                        $(this).prop("checked",$(".todas").prop('checked'));
                    }); 
                });

                // VINCULAÇÃO DA FUNCIONALIDADE AO PERFIL
                $(".funcionalidade").change(function(){ 
                    verificaTodas();
                });
                
                verificaTodas();
                
                
                // CARREGA MODAL DE FOTOS DA CAPA DO LIVRO
                $(".fotos").click(function(){ 
                    var id = $(this).attr("id");
                    var title = $(this).attr("title");
                    $(".foto .modal-body.modal-body img").attr("src",""); 
                    $.ajax({
                        url: urlValida,
                        data: {valida: "capa_livro", id: id},
                        method: "GET",
                        type: 'json',
                        beforeSend: function(){
                             $("#load").click();
                        },
                        success: function(data){ 
                            $("#carregando .cancelar").click();
                            var objData = jQuery.parseJSON(data);
                            if(objData.ds_foto_capa){
                                $(".foto .modal-header .modal-title").text(title); 
                                $(".foto .modal-body.modal-body img").attr("src","../../" + upload + objData.ds_foto_capa);
                                $("#fotos").click();
                            }else{
                                Funcoes.Alerta(Funcoes.MSG04);
                            }
                        }
                    });
                });  
               
                // RECUPERA OS CÓDIGOS DO LIVRO
                $(".pesquisa_livro").click(function(){ 
                    var id = $(this).attr("id");
                    $("#codigos_livro b").text("");
                    $.ajax({
                        url: urlValida,
                        data: {valida: "pesquisa_livro", id: id},
                        method: "GET",
                        type: 'json',
                        beforeSend: function(){
                             $("#load").click();
                        },
                        success: function(data){ 
                            $("#codigos_livro b").append(data);
                            $("#carregando .cancelar").click();
                            $(".modal .btn-success").attr("id",id);
                        }
                    });
                });    
                
                $("#Reserva .btn-success").click(function(){
                    var id = $(this).attr("id");
                    $("#load").click();  

                    $.get(urlValida, {valida: 'reservar', id: id}, function(retorno) {
                            if(retorno != ""){
                                Funcoes.Sucesso("Reserva efetuada com sucesso!");
                            }else{          
                                Funcoes.Erro("Foi identificado um Erro<br>Favor entrar em contato com o Administrador do Sistema<br>Informando o erro ocorrido.");
                            }
                            
                            $("#carregando .cancelar").click(); 
                     });
                }); 
    };
    return {
        init: function () {
            inicio();
        },
        Modal: function(msg, classe, cor, icone, titulo){
            $(".aviso .modal-header").removeClass().addClass("modal-header btn btn-" + classe);
            $(".aviso #icone").removeClass().addClass("btn btn-" + cor);
            $(".aviso i").removeClass().addClass("fa " + icone);
            $(".aviso .modal-header .modal-title").text(titulo);
            $(".aviso #confirmacao_msg b").html(msg);
            $("#aviso").click();
        },
        Sucesso: function(msg){
            Funcoes.Modal(msg,"success","green","fa-check","SUCESSO");
        },
        Alerta: function(msg){
            Funcoes.Modal(msg,"warning","yellow","fa-exclamation-triangle","ALERTA");
        },
        Informativo: function(msg){
            Funcoes.Modal(msg,"info","primary","fa-info-circle","INFORMATIVO");
        },
        Erro: function(msg){
            Funcoes.Modal(msg,"bricky","bricky","fa-frown-o","Erro");
        },
        
        MSG_CONFIRMACAO: "CONFIRMAÇÃO",
        
        MSG01: "Sua Idade Não é Permitida.",
        MSG02: "Ano de publicação não pode ser maior que o ano atual.",
        MSG03: "Ano de publicação não pode ser menor que o ano de 1950.",
        MSG04: "Livro sem Foto de Capa"
        
    };
}();

