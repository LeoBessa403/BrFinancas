<div class="main-content">
        <div class="container">
                    <div class="row">
                                  <div class="col-sm-12">
							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-grid-6"></i>
									<a href="#">
										Cadastro
									</a>
								</li>
								<li class="active">
									Pagamento
								</li>
							</ol>
							<div class="page-header">
								<h1>Pagamentos <small>Realizadas</small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
                                    <style>
                                        .alerta-pagamento {padding: 2px; margin: 0 0 2px; width: 100%;}
                                        .h5-pagamento {padding: 2px; margin: 0;}
                                    </style>
        
                                    <div class="row">
					<div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Pagamentos Realizadas
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
								<div class="panel-body">                                                                  
									<?php
                                                                            Modal::load(); 
                                                                            Modal::deletaRegistro("Pagamento");
                                                                            Modal::confirmacao("confirma_Pagamento");
                                                                            
                                                                            $arrColunas = array('Pagamento','Data','Nome / Razão Social','Total','Pagamento em','Vencimento','Parcelas','Ação');
                                                                            $grid = new Grid();
                                                                            $grid->setColunasIndeces($arrColunas);
                                                                            $grid->criaGrid();
                                                                            
                                                                            foreach ($result as $res): 
                                                                                $pagamentos_totais = '<p class="text" style="padding: 0; margin: 0;">
                                                                                                Total de Parcelas: <b>'.$res['numero_parcelas'].'</b>
                                                                                            </p>
                                                                                            <p class="text-danger" style="padding: 0; margin: 0;">
                                                                                                Parcelas Vencidas: <b>'.$parc[$res['id_negociacao']]['vencidas'].'</b>
                                                                                            </p>';
                                                                            
                                                                                            if ($parc[$res['id_negociacao']]['vencendo'] > 0): 
                                                                                               $pagamentos_totais .= '<p class="text-warning" style="padding: 0; margin: 0;">
                                                                                                    Parcelas Vencendo: <b>'.$parc[$res['id_negociacao']]['vencendo'].'</b>
                                                                                                </p>';
                                                                                            endif; 
                                                                                            $pagamentos_totais .= '<p class="text-info" style="padding: 0; margin: 0;">
                                                                                                Parcelas A vencer: <b>'.$parc[$res['id_negociacao']]['avencer'].'</b>
                                                                                            </p>                                                                                                                                                                                       
                                                                                            <p class="text-success" style="padding: 0; margin: 0;">
                                                                                                Parcelas Pagas: <b>'.$parc[$res['id_negociacao']]['pagas'].'</b>
                                                                                            </p>';
                                                                                            
                                                                                            if($res['numero_parcelas'] >= 60):
                                                                                                   $actionF = "CadastroContasMensais";
                                                                                               else:
                                                                                                   $actionF =  "CadastroPagamento";
                                                                                               endif;
                                                                                            
                                                                                            $acao = '<a href="'.PASTAADMIN.'Pagamento/'.$actionF.'/'.Valida::GeraParametro("neg/".$res['id_negociacao']).'" class="btn btn-primary tooltips" 
                                                                                               data-original-title="Editar Registro" data-placement="top">
                                                                                                <i class="fa fa-clipboard"></i>
                                                                                            </a>
                                                                                            <a data-toggle="modal" role="button" class="btn btn-bricky tooltips deleta" id="'.$res['id_negociacao'].'" 
                                                                                               href="#Pagamento" data-original-title="Excluir Pagamento" data-placement="top">
                                                                                                <i class="fa fa-trash-o"></i>
                                                                                            </a>
                                                                                            <a href="'.PASTAADMIN.'Pagamento/DetalhaPagamento/'.Valida::GeraParametro("neg/".$res['id_negociacao']).'" class="btn btn-dark-grey tooltips" 
                                                                                               data-original-title="Detalhes do Pagamento" data-placement="top">
                                                                                                <i class="fa fa-indent"></i>
                                                                                            </a>';
                                                                                $grid->setColunas($res['id_negociacao']);
                                                                                $grid->setColunas(Valida::DataShow($res['cadastro'],"d/m/Y"));
                                                                                $grid->setColunas($res['nome_razao']);
                                                                                $grid->setColunas(Valida::formataMoeda($res['valor_total']));
                                                                                $grid->setColunas(FuncoesSistema::tipoPagamento($res['tipo_pagamento']));
                                                                                $grid->setColunas($parcelamento[$res['id_negociacao']]);
                                                                                $grid->setColunas($pagamentos_totais);
                                                                                $grid->setColunas($acao,4);
                                                                                $grid->criaLinha($res['id_negociacao']);
                                                                            endforeach;
                                                                           
                                                                            $grid->finalizaGrid();
                                                                        ?>
                                                                 </div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
					</div>
                                        <!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->