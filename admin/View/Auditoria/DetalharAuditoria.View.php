<div class="main-content">
    <div class="container">
        <!-- start: PAGE HEADER -->
        <div class="row">
            <div class="col-sm-12">
                <!-- start: PAGE TITLE & BREADCRUMB -->
                <ol class="breadcrumb">
                    <li>
                        <i class="clip-home-3"></i>
                        <a href="#">
                            Auditoria
                        </a>
                    </li>
                    <li class="active">
                        Auditoria
                    </li>
                </ol>
                <div class="page-header">
                    <h1>Auditoria
                        <small> Detalhes da Auditoria</small>
                    </h1>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>
        <!-- end: PAGE HEADER -->
        <!-- start: PAGE CONTENT -->
        <div class="row">
            <div class="col-sm-6" style="padding: 10px; background-color: #fbfbfb; 
                                                 margin-left: 15px;">
                <p><span style="font-weight: bolder; color: #900;">Usuário:</span><br/>
                    <big><b>
                            <?= ($result->getCoUsuario()
                                ? $result->getCoUsuario()->getCoPessoa()->getNoPessoa()
                                : 'Via Site'); ?>
                        </b></big></p>
                <?php
                if ($perfis != $result->getDsPerfilUsuario()) {
                    echo '<p><span style="font-weight: bolder; color: #900;">Perfil Quando Realizado:</span><br/>
                                                                        <big><b style="text-transform: capitalize;">';
                    echo " " . $result->getDsPerfilUsuario();
                    echo '</b></big></p>';
                    echo '<p><span style="font-weight: bolder; color: #900;">Perfil Agora:</span><br/>
                                                                        <big><b style="text-transform: capitalize;">';
                    echo " " . $perfis;
                    echo '</b></big></p>';
                } elseif
                ($perfis
                ) {
                    echo '<p><span style="font-weight: bolder; color: #900;">Perfil:</span><br/>
                                                                        <big><b style="text-transform: capitalize;">';
                    echo " " . $perfis;
                    echo '</b></big></p>';
                }
                ?>
                <p><span style="font-weight: bolder; color: #900;">Realizado Em:</span><br/>
                    <big><b><?php echo Valida::DataShow($result->getDtRealizado(), "d/m/Y H:i:s"); ?>
                        </b></big></p>
                <p><span style="font-weight: bolder; color: #900;">Operação:</span><br/>
                    <big><b><?php echo FuncoesSistema::OperacaoAuditoria($result->getNoOperacao()); ?>
                        </b></big></p>
                <p><span style="font-weight: bolder; color: #900;">Banco de Dados:</span><br/>
                    <big><b style="text-transform: capitalize;"><?php
                            $tabela = str_replace("tb_", "", $result->getNoTabela());
                            $tabela = str_replace("_", " ", $tabela);
                            echo "Tabela: " . $tabela;
                            ?>
                        </b></big></p>

                <div class="panel panel-default">
                    <div class="panel-heading" style="font-weight: bolder; color: #069;">
                        <i class="fa fa-external-link-square"></i>
                        Registro
                        <?php
                        if ($result->getNoOperacao() == "I"):
                            echo "INSERIDO";
                        elseif ($result->getNoOperacao() == "U"):
                            echo "ATUALIZADO";
                        else:
                            echo "DELETADO";
                        endif;
                        ?>
                    </div>
                    <div class="panel-body">
                        <?php
                        if ($result->getNoOperacao() == "I" || $result->getNoOperacao() == "D"):
                            if ($result->getNoOperacao() == "I"):
                                $dado = explode(";/", $result->getDsItemAtual());
                            elseif ($result->getNoOperacao() == "D"):
                                $dado = explode(";/", $result->getDsItemAnterior());
                            endif;
                            foreach ($dado as $value) {
                                $reg = explode("==", $value);
                                if (!empty($reg[1])):
                                    $pre = substr($reg[0], 0, 2);
                                    $coluna = str_replace("_", " ", substr($reg[0], 3, strlen($reg[0])));
                                    if ($reg[0] != "dt_cadastro" && $coluna != "senha"):
                                        if ($pre == "co"):
                                            $coluna = "Código " . $coluna;
                                        endif;
                                        echo '<div class="form-group">
                                        <label for="form-field-22" style="font-weight: bolder; color: #666; text-transform: capitalize;">';
                                        echo $coluna;
                                        echo '</label>
                                        <p><big><b>';
                                        if ($pre == "dt"):
                                            $data = explode(" ", $reg[1]);
                                            echo Valida::DataShow($data[0], "d/m/Y") . " - " . $data[1];
                                        else:
                                            echo $reg[1];
                                        endif;
                                        echo '</b></big></p>
                                                                                                      </div>';
                                    endif;
                                endif;
                            }
                        endif;
                        if ($result->getNoOperacao() == "U"):
                            $dado_atual = explode(";/", $result->getDsItemAtual());
                            $dado_anterior = explode(";/", $result->getDsItemAnterior());
                            foreach ($dado_atual as $value):
                                $reg = explode("==", $value);
                                $dados_atual[$reg[0]] = $reg[1];
                            endforeach;
                            foreach ($dado_anterior as $value2):
                                $reg2 = explode("==", $value2);
                                $dados_anterior[$reg2[0]] = $reg2[1];
                            endforeach;
                            foreach ($dados_anterior as $key => $res2):
                                if ($res2):
                                    $pre = substr($key, 0, 2);
                                    $coluna = str_replace("_", " ", substr($key, 3, strlen($key)));
                                    if ($key != "dt_cadastro" && $coluna != "senha"):
                                        if ($pre == "co"):
                                            $coluna = "Código " . $coluna;
                                        endif;
                                        echo '<div class="form-group">
                                            <label for="form-field-22" style="font-weight: bolder; color: #666; text-transform: capitalize;">';
                                        echo $coluna;
                                        echo '</label>
                                            <p><big><b>';
                                        if ($pre == "dt"):
                                            $data = explode(" ", $res2);
                                            echo "De: " . Valida::DataShow($data[0], "d/m/Y");
                                            if (isset($data[1])):
                                                echo " - " . $data[1];
                                            endif;
                                            if (!empty($dados_atual[$key])):
                                                $data2 = explode(" ", $dados_atual[$key]);
                                                echo "<br>Para: " . Valida::DataShow($data2[0], "d/m/Y");
                                                if (isset($data2[1])):
                                                    echo " - " . $data2[1];
                                                endif;
                                            endif;
                                        else:
                                            echo "De: " . $res2 . "<br>Para: " . (isset($dados_atual[$key]) ? $dados_atual[$key] : "");
                                        endif;
                                        echo '</b></big></p>
                                                                                                      </div>';
                                    endif;
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>

                <a href="<?php echo PASTAADMIN . 'Auditoria/ListarAuditoria'; ?>" class="btn btn-primary tooltips"
                   data-original-title="Editar Registro" data-placement="top">
                    Voltar <i class="clip-arrow-right-2"></i>
                </a>
                <br/><br/>
            </div>

        </div>
        <!-- end: PAGE CONTENT-->
    </div>
</div>