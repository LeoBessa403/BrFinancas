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
									Cadastro de Recebimento
								</li>								
							</ol>
							<div class="page-header">
								<h1>Recebimento <small> Realizar Cadastro e Edição</small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
                                                        <?php
                                                            if($result):
                                                                 Valida::Mensagem("O Cadastro foi Realizado.", 1);
                                                            endif;
                                                            if($resultAlt):
                                                                 Valida::Mensagem("O Cadastro foi Atualizado.", 1);
                                                            endif;
                                                        ?>
                                                                        
                                        <div class="row">
                                            
                                             <?php
                                             
                                                echo $form;
                                             ?>
                                            
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>