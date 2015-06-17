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
									Recebimento
								</li>
							</ol>
							<div class="page-header">
								<h1>Recebimentos <small>Realizadas</small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
                                    <style>
                                        .alerta-recebimento {padding: 2px; margin: 0 0 2px; width: 100%;}
                                        .h5-recebimento {padding: 2px; margin: 0;}
                                    </style>
        
                                    <div class="row">
					<div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Recebimentos Realizadas
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
                                                                            Modal::deletaRegistro("Recebimento");
                                                                            Modal::confirmacao("confirma_Recebimento");
                                                                        ?>
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                                                                                <thead>
                                                                                    <tr style="background-color: #006699; color: #ffffff">
                                                                                        <th>Recebimento</th>
                                                                                        <th>Data</th>
                                                                                        <th>Nome / Razão Social</th>
                                                                                        <th>Total</th>
                                                                                        <th>Recebimento em</th>
                                                                                        <th>Vencimento</th>
                                                                                        <th>Parcelas</th>
                                                                                        <th>Ações</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>           
                                                                                 <?php
                                                                                    foreach ($result as $res):                                                                                        
                                                                                 ?>
                                                                                    <tr id="registro-<?php echo $res['id_entidade']; ?>" style="background-color: #cfcfcf;">
                                                                                        <td><?php echo $res['id_negociacao']; ?></td>
                                                                                        <td><?php echo Valida::DataShow($res['cadastro'],"d/m/Y"); ?></td>
                                                                                        <td><?php echo $res['nome_razao']; ?></td>
                                                                                        <td><?php echo Valida::formataMoeda($res['valor_total']); ?></td>
                                                                                        <td><?php echo FuncoesSistema::tipoPagamento($res['tipo_pagamento']); ?></td>                                                                                       
                                                                                        <td><?php echo $parcelamento[$res['id_negociacao']]; ?></td>                                                       
                                                                                        <td>
                                                                                            <p class="text" style="padding: 0; margin: 0;">
                                                                                                Total de Parcelas: <b><?php  echo $res['numero_parcelas']; ?></b>
                                                                                            </p>
                                                                                            <p class="text-danger" style="padding: 0; margin: 0;">
                                                                                                Parcelas Vencidas: <b><?php  echo $parc[$res['id_negociacao']]['vencidas']; ?></b>
                                                                                            </p><?php  if ($parc[$res['id_negociacao']]['vencendo'] > 0): ?>
                                                                                            <p class="text-warning" style="padding: 0; margin: 0;">
                                                                                                Parcelas Vencendo: <b><?php  echo $parc[$res['id_negociacao']]['vencendo']; ?></b>
                                                                                            </p> <?php endif; ?>
                                                                                            <p class="text-info" style="padding: 0; margin: 0;">
                                                                                                Parcelas A vencer: <b><?php  echo $parc[$res['id_negociacao']]['avencer']; ?></b>
                                                                                            </p>                                                                                                                                                                                       
                                                                                            <p class="text-success" style="padding: 0; margin: 0;">
                                                                                                Parcelas Pagas: <b><?php  echo $parc[$res['id_negociacao']]['pagas']; ?></b>
                                                                                            </p>                                                                                            
                                                                                        </td>
                                                                                        <td>
                                                                                            <a href="
                                                                                               <?php 
                                                                                               echo "admin/Recebimento/";
                                                                                               if($res['numero_parcelas'] >= 60):
                                                                                                   echo "CadastroContasMensais";
                                                                                               else:
                                                                                                   echo "CadastroRecebimento";
                                                                                               endif;
                                                                                                 echo "/neg/";
                                                                                                 echo $res['id_negociacao']; ?>" class="btn btn-primary tooltips" 
                                                                                               data-original-title="Editar Registro" data-placement="top">
                                                                                                <i class="fa fa-clipboard"></i>
                                                                                            </a>
                                                                                            <a data-toggle="modal" role="button" class="btn btn-bricky tooltips deleta" id="<?php echo $res['id_negociacao']; ?>" 
                                                                                               href="#Recebimento" data-original-title="Excluir Recebimento" data-placement="top">
                                                                                                <i class="fa fa-trash-o"></i>
                                                                                            </a>
                                                                                            <a href="admin/Recebimento/DetalhaRecebimento/neg/<?php echo $res['id_negociacao']; ?>" class="btn btn-dark-grey tooltips" 
                                                                                               data-original-title="Detalhes do Recebimento" data-placement="top">
                                                                                                <i class="fa fa-indent"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                    endforeach;
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>
                                                                 </div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
					</div>
                                        <!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->