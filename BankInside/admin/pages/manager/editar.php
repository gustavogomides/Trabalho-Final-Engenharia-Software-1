	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_gerente = mysqli_query($mysqli, "SELECT name, gender, address, documentId
	                                                            FROM manager
	                                                            WHERE idManager = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_gerente) <= '0'){

	                    }else{
	                        while ($res_pega_gerente = mysqli_fetch_array($pega_gerente)) {
	                            $nome = $res_pega_gerente[0];
	                            $sexo = $res_pega_gerente[1];
	                            $endereco = $res_pega_gerente[2];
	                            $documento = $res_pega_gerente[3];
	                        }
	                    }
	                }
	            }

	        ?>
			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Alterar Gerente</h3>
							<ul class="breadcrumb">
								<li><a href="#"><i class="icon-flag"></i></a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Gerentes</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/manager/listar">Lista de Gerentes</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/manager/visualizar&id=<?php echo $pega_id; ?>">Visualizar Gerente</a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Alterar Gerente</a><span class="divider-last">&nbsp;</span></li>
							</ul>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="editar" action="" method="post" enctype="multipart/form-data">
									<?php 
						                    if(isset($_POST['editar']) && $_POST['editar'] == 'edit'){
													$nome = strip_tags(trim($_POST['senderNome']));
													$sexo = strip_tags(trim($_POST['senderSexo']));
													$endereco = strip_tags(trim($_POST['senderEndereco']));
													$documento = strip_tags(trim($_POST['senderDocumento']));
													
													$editar = mysqli_query($mysqli, "UPDATE manager
						                                                                SET name = '$nome',
						                                                                    gender = '$sexo',
																							address = '$endereco',
																							documentId = '$documento'
																						WHERE idManager = '$pega_id'
						                                                                LIMIT 1")
			                    				or die(mysqli_error($mysqli));
			        
						                        if($editar == '1'){
						                        	echo '<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Sucesso!</strong> Gerente alterado com sucesso! 
													Você será redirecionado em 3 segundos! 
													</div>';
													echo '<script>setTimeout(function () {
															window.location.href= "index.php?topicos=pages/manager/visualizar&id='.$pega_id.'";
															},3000);
														</script>';
						                        }else{
						                        	echo '<div class="alert alert-error">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Erro!</strong>A alteração do Gerente falhou!
													Tente novamente!
													</div>';
						                        }
						                	}   
						                ?>	

 									<div class="form-group"> <!-- inicio do grupo -->
						                <div class="control-group"> <!-- inicio do grupo -->
											<label class="control-label">Nome</label>
											<div class="controls">
												<input type="text" class="span6" name="senderNome" value="<?php echo $nome; ?>" required="required"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Sexo</label>
											<div class="controls">
												<select class="form-control" name="senderSexo" tabindex="1" required="required">
													<option <?php if($sexo == 'M') echo 'selected="selected"';?> value="M" />M
													<option <?php if($sexo == 'F') echo 'selected="selected"';?> value="F" />F
												</select>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">Endereço</label>
											<div class="controls">
												<input type="text" class="span6" name="senderEndereco" value="<?php echo $endereco; ?>" required="required"/>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">Documento</label>
											<div class="controls">
												<input type="text" class="span6" name="senderDocumento" value="<?php echo $documento; ?>" required="required"/>
											</div>
										</div>
									</div><!-- fim do grupo-->
									<div class="form-group"> <!-- inicio do grupo -->
										<div class="form-actions"><!-- inicio do grupo-->
												<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Editar Gerente</button>
												<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/manager/visualizar&id=<?php echo $pega_id; ?>';">Cancelar Alteração</button>
										</div>
									</div><!-- fim do grupo-->
										<input type="hidden" name="editar" value="edit" />
								</form>
							</div>
						</div>
					</div>
				</div>
