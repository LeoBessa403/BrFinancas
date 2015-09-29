<div class="main-content">
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-home-3"></i>
									<a href="admin/index/index">
										Home
									</a>
								</li>
								<li class="active">
									Recebimentos de contas
								</li>								
							</ol>
							<div class="page-header">
								<h1>Recebimento <small> Detalhes do Recebimento</small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT --> 
                                        <?php
                                           if($resultAlt):
                                                Valida::Mensagem("O Cadastro foi Atualizado.", 1);
                                           endif;
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-6" style="padding: 10px; background-color: #fbfbfb; margin-left: 15px;">
                                               <p>Nome / Razão:<br/>
                                               <big><b>
                                                   <?php echo $negociacao['nome_razao']; ?>
                                                   </b></big></p>
                                                <p>Valor Total:<br/>
                                                <big><b>
                                                    <?php echo Valida::formataMoeda($negociacao['valor_total'],"R$"); ?>
                                                    </b></big></p>
                                                <p>Recebimento Em:<br/>
                                                <big><b>
                                                    <?php  echo FuncoesSistema::tipoPagamento($negociacao['tipo_pagamento']); ?>
                                                    </b></big></p>
                                                <p>Parcelas:<br/>
                                                <big><b> 
                                                    <?php 
                                                    if($negociacao['numero_parcelas'] < 10):
                                                        echo "0";
                                                    endif;
                                                    echo $negociacao['numero_parcelas']; ?>
                                                </b></big></p>
                                                <p>Situação do Recebimento:<br/>
                                                 <big><b><?php 
                                                    if($negociacao['situacao'] == "A"):
                                                        echo "Em Aberto";
                                                    else:
                                                        echo "Finalizado";
                                                    endif;
                                                  ?></b></big></p>
                                                <p>Cadastrado:<br/>
                                                <big><b><?php echo Valida::DataShow($negociacao['cadastro'],"d/m/Y"); ?>
                                                    </b></big></p>                                                
                                                <p>Observação:<br/>
                                                <big><b><?php echo $negociacao['observacao']; ?>
                                                    </b></big></p>                                                
                                                <form action="admin/Recebimento/ListarRecebimento" method="post">
                                                    <button data-style="zoom-out" class="btn btn-primary ladda-button" type="submit" style="margin-top: 10px;">
                                                        <span class="ladda-label"> Voltar aos recebimentos </span>
                                                        <i class="clip-arrow-right-2"></i>
                                                        <span class="ladda-spinner"></span>
                                                    </button>
                                                </form>                                               
                                            </div>
                                             
<!--                                       	<div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Parcelas do Recebimento
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="fa fa-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
                                                               <style>
                                                                   .alerta-recebimento {padding: 2px; margin: 0 0 2px; width: 100%;}
                                                                   .h5-recebimento {padding: 2px; margin: 0;}
                                                               </style>
								<div class="panel-body"> -->
                                                                    <?php
//                                                                            $arrColunas = array('Parcela','Valor R$','Vencimento','Situação','Observação','Ação');
//                                                                            $grid = new Grid();
//                                                                            $grid->setColunasIndeces($arrColunas);
//                                                                            $grid->criaGrid();
//                                                                            
////                                                                            debug($result);
//                                                                            
//                                                                            foreach ($result as $res): 
//                                                                                if($res['parcela'] < 10):
//                                                                                    $parc = "0".$res['parcela'];
//                                                                                else:
//                                                                                    $parc = $res['parcela'];
//                                                                                endif;
//                                                                                if($res['valor_parcela_pago'] == ""):
//                                                                                    $valor = $res['valor_parcela'];
//                                                                                else:
//                                                                                    $valor = $res['valor_parcela_pago'];
//                                                                                endif;
//                                                                                if($res['vencimento_pago'] == ""):
//                                                                                    $venc = Valida::DataShow($res['vencimento'],"d/m/Y");
//                                                                                else:
//                                                                                    $venc = Valida::DataShow($res['vencimento_pago'],"d/m/Y");
//                                                                                endif;
//                                                                                $acao = '<a href="'.PASTAADMIN.'Recebimento/EditaParcelamento/'.Valida::GeraParametro("parc/".$res['id_parcelamento']).'" class="btn btn-primary tooltips" 
//                                                                                               data-original-title="Editar Registro" data-placement="top">
//                                                                                                <i class="fa fa-clipboard"></i>
//                                                                                            </a>
//                                                                                            <a data-toggle="modal" role="button" class="btn btn-bricky tooltips deleta" id="'.$res['id_parcelamento'].'" 
//                                                                                               href="#Recebimento" data-original-title="Excluir Registro" data-placement="top">
//                                                                                                <i class="fa fa-trash-o"></i>
//                                                                                            </a>';
//                                                                                $grid->setColunas($parc);
//                                                                                $grid->setColunas(Valida::formataMoeda($valor));
//                                                                                $grid->setColunas($venc);
//                                                                                $grid->setColunas($parcelamento[$res['id_parcelamento']]);
//                                                                                $grid->setColunas($res['observacao_parcela']);
//                                                                                $grid->setColunas($acao,2);
//                                                                                $grid->criaLinha($res['id_entidade']);
//                                                                            endforeach;
//                                                                           
//                                                                            $grid->finalizaGrid();
                                                                        ?>
<!--                                                                 </div>
							</div>
							 end: DYNAMIC TABLE PANEL 
						</div>-->
					                                                
                                            
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>