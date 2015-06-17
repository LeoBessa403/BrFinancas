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
									Pagamentos de contas
								</li>								
							</ol>
							<div class="page-header">
								<h1>Pagamento <small> Detalhes do Pagamento</small></h1>
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
                                            <div class="col-sm-6" style="padding: 10px; background-color: #fbfbfb; 
                                                 margin-left: 15px;">
                                               <p>Nome / Razão:<br/>
                                               <big><b>
                                                   <?php echo $negociacao['nome_razao']; ?>
                                                   </b></big></p>
                                                <p>Valor Total:<br/>
                                                <big><b>
                                                    <?php echo Valida::formataMoeda($negociacao['valor_total'],"R$"); ?>
                                                    </b></big></p>
                                                <p>Pagamento Em:<br/>
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
                                                <p>Situação do Pagamento:<br/>
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
                                                <form action="admin/Pagamento/ListarPagamento" method="post">
                                                    <button data-style="zoom-out" class="btn btn-primary ladda-button" type="submit" style="margin-top: 10px;">
                                                        <span class="ladda-label"> Voltar aos pagamentos </span>
                                                        <i class="clip-arrow-right-2"></i>
                                                        <span class="ladda-spinner"></span>
                                                    </button>
                                                </form>                                               
                                            </div>
                                             
                                       	<div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Parcelas do Pagamento
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
                                                                   .alerta-pagamento {padding: 2px; margin: 0 0 2px; width: 100%;}
                                                                   .h5-pagamento {padding: 2px; margin: 0;}
                                                               </style>
								<div class="panel-body"> 
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                                                                                <thead>
                                                                                    <tr style="background-color: #006699; color: #ffffff">
                                                                                        <th>parcela</th>
                                                                                        <th>Valor R$</th>
                                                                                        <th>Vencimento</th>
                                                                                        <th>Situação</th>                                                                                        
                                                                                        <th>Observação</th>
                                                                                        <th>Ações</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    foreach ($parcelas as $res):
                                                                                    ?>
                                                                                    <tr id="registro-<?php echo $res['id_entidade']; ?>" style="background-color: #cfcfcf;">
                                                                                         <td><?php 
                                                                                            if($res['parcela'] < 10):
                                                                                                echo "0";
                                                                                            endif;
                                                                                            echo $res['parcela']; ?></td>
                                                                                        <td><?php 
                                                                                            if($res['valor_parcela_pago'] == ""):
                                                                                                echo Valida::formataMoeda($res['valor_parcela']);
                                                                                            else:
                                                                                                echo Valida::formataMoeda($res['valor_parcela_pago']);
                                                                                            endif;
                                                                                         ?></td>                                                                                       
                                                                                        <td><?php 
                                                                                            if($res['vencimento_pago'] == ""):
                                                                                                echo Valida::DataShow($res['vencimento'],"d/m/Y");
                                                                                            else:
                                                                                                echo Valida::DataShow($res['vencimento_pago'],"d/m/Y");
                                                                                            endif;
                                                                                         ?></td>   
                                                                                        <td><?php echo $parcelamento[$res['id_parcelamento']]; ?></td>  
                                                                                        <td><?php echo $res['observacao_parcela']; ?></td>                                                                                     
                                                                                        <td>
                                                                                            <a href="admin/Pagamento/EditaParcelamento/parc/<?php echo $res['id_parcelamento']; ?>" class="btn btn-primary tooltips" 
                                                                                               data-original-title="Pagar Parcela" data-placement="top">
                                                                                                <i class="fa fa-clipboard"></i>
                                                                                            </a>
                                                                                            <a data-toggle="modal" role="button" class="btn btn-bricky tooltips deleta" id="<?php echo $res['id_parcelamento']; ?>" 
                                                                                               href="#Pagamento" data-original-title="Excluir Pagamento" data-placement="top">
                                                                                                <i class="fa fa-trash-o"></i>
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