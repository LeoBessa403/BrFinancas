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
									Renda
								</li>
							</ol>
							<div class="page-header">
								<h1>Renda <small>Cadastrados</small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
        
        
                            <div class="row">
					<div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Renda Cadastrados
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
                                                                            Modal::deletaRegistro("Renda");
                                                                            Modal::confirmacao("confirma_Renda");
                                                                        ?>
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                                                                                <thead>
                                                                                    <tr style="background-color: #006699; color: #ffffff">
                                                                                        <th>Nome / Razão Social</th>
                                                                                        <th>Contatos</th>
                                                                                        <th>Site</th>
                                                                                        <th>Ação</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                 <?php
                                                                                    foreach ($result as $res):                                                                                        
                                                                                 ?>
                                                                                    <tr id="registro-<?php echo $res['id_entidade']; ?>" style="background-color: #cfcfcf;">
                                                                                        <td><?php echo $res['nome_razao']; ?></td>                                                                                       
                                                                                        <td><?php echo $res['tel1']." / ".$res['tel2']; ?></td>                                                                                      
                                                                                        <td><?php echo $res['site']; ?></td>                                                                                      
                                                                                        <td><a href="admin/Renda/CadastroRenda/ent/<?php echo $res['id_entidade']; ?>" class="btn btn-primary tooltips" 
                                                                                               data-original-title="Editar Registro" data-placement="top">
                                                                                                <i class="fa fa-clipboard"></i>
                                                                                            </a>
                                                                                            <a data-toggle="modal" role="button" class="btn btn-bricky tooltips deleta" id="<?php echo $res['id_entidade']; ?>" 
                                                                                               href="#Renda" data-original-title="Excluir Registro" data-placement="top">
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
			<!-- end: PAGE -->