var Funcoes = function () {
    var inicio = function () {
        
                var home      = servidor_inicial();
                var upload    = home + pasta_upload();
                var urlValida = home + 'admin/Controller/Ajax.Controller.php';

                // CADASTRO DE FORNECEDOR
                function disabilitaCamposTipo(){
                     if($("#tipo").prop('checked')){
                         $("#cnpj").attr("disabled",true).val("");
                         $("#cpf").attr("disabled",false);
                     }else{
                         $("#cpf").attr("disabled",true).val("");
                         $("#cnpj").attr("disabled",false);
                     }
                }

                disabilitaCamposTipo();

                // CADASTRO DE FORNECEDOR
                $("#tipo").change(function(){
                    $('#cpf,#cnpj').parent(".form-group").removeClass('has-success has-error');
                    $('span#cpf-info').text("").append('<span class="help-block" id="cpf-info"><i class="fa fa-info-circle"></i> Caso seja Pessoa Física</span>');
                    $('span#cnpj-info').text("").append('<span class="help-block" id="cpf-info"><i class="fa fa-info-circle"></i> Caso seja Pessoa Jurídica</span>');
                    disabilitaCamposTipo();
                });
                
                $.mask.definitions['d'] = "[0-3]";
                $.mask.definitions['c'] = "[0-9]";
                $(".dia").mask("dc").change(function(){
                    var d   = $(this).val().substring(0,1);
                    var c = $(this).val().substring(1,2);
                    if((d > 3) || (d == 3 && c > 1)){
                        alert("Dia Inválido!");
                        $(this).val("");
                    }
                });  
                
    };
    return {
        init: function () {
            inicio();
        },
        Alerta: function(msg){
            $(".aviso .modal-header").removeClass().addClass("modal-header btn btn-warning");
            $(".aviso #icone").removeClass().addClass("btn btn-yellow");
            $(".aviso i").removeClass().addClass("fa fa-exclamation-triangle");
            $(".aviso .modal-header .modal-title").text("ALERTA");
            $(".aviso #confirmacao_msg b").html(msg);
            $("#aviso").click();
        },
        Sucesso: function(msg){
            $(".aviso .modal-header").removeClass().addClass("modal-header btn btn-success");
            $(".aviso #icone").removeClass().addClass("btn btn-green");
            $(".aviso i").removeClass().addClass("fa fa-check")
            $(".aviso .modal-header .modal-title").text("SUCESSO");
            $(".aviso #confirmacao_msg b").html(msg);
            $("#aviso").click();
        },
        Informativo: function(msg){
            $(".aviso .modal-header").removeClass().addClass("modal-header btn btn-info");
            $(".aviso #icone").removeClass().addClass("btn btn-primary");
            $(".aviso i").removeClass().addClass("fa fa-info-circle");
            $(".aviso .modal-header .modal-title").text("INFORMATIVO");
            $(".aviso #confirmacao_msg b").html(msg);
            $("#aviso").click();
        },
        
        MSG_CONFIRMACAO: "CONFIRMAÇÃO",
        
        MSG01: "Ano menor que o Permitido!",
        MSG02: "Sem Vinculo",
        MSG03: "Erro ao Vincular!",
        MSG04: "A Vinculação do Veterinário ao Credenciado, Foi realizada com Sucesso!",
        MSG05: "Esse Cliente não possui fotos!",
        
    };
}();

