	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_cliente = mysqli_query($mysqli, "SELECT name, gender, birthday,address, documentId
	                                                            FROM customer
	                                                            WHERE idCustomer = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_cliente) <= '0'){

	                    }else{
	                        while ($res_pega_cliente = mysqli_fetch_array($pega_cliente)) {
	                            $nome = $res_pega_cliente[0];
	                            $sexo = $res_pega_cliente[1];
	                            $data = new DateTime($res_pega_cliente[2]);
	                            $endereco = $res_pega_cliente[3];
	                            $documento = $res_pega_cliente[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Alterar Cliente</h3>
							<ul class="breadcrumb">
								<li><a href="#"><i class="icon-flag"></i></a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Clientes</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/customer/listar">Lista de Clientes</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/customer/visualizar&id=<?php echo $pega_id; ?>">Visualizar Clientes</a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Alterar Cliente</a><span class="divider-last">&nbsp;</span></li>
							</ul>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="editar" action="" method="post" enctype="multipart/form-data">
									<?php 
						                    if(isset($_POST['editar']) && $_POST['editar'] == 'edit'){
													$nome = strip_tags(trim($_POST['senderNome']));
													$sexo = strip_tags(trim($_POST['senderSexo']));
													$data = new DateTime(strip_tags(trim($_POST['senderData'])));
  													$date = date_format($data, 'Y-m-d');
													$endereco = strip_tags(trim($_POST['senderEndereco']));
													$documento = strip_tags(trim($_POST['senderDocumento']));

													
													$editar = mysqli_query($mysqli, "UPDATE customer
						                                                                SET name = '$nome',
						                                                                    gender = '$sexo',
						                                                                    birthday = '$date',
																							address = '$endereco',
																							documentId = '$documento'
																						WHERE idCustomer = '$pega_id'
						                                                                LIMIT 1")
			                    				or die(mysqli_error($mysqli));
			        
						                        if($editar == '1'){
						                        	echo '<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Sucesso!</strong> Cliente alterado com sucesso! 
													Você será redirecionado em 3 segundos! 
													</div>';
													echo '<script>setTimeout(function () {
															window.location.href= "index.php?topicos=pages/customer/visualizar&id='.$pega_id.'";
															},3000);
														</script>';
						                        }else{
						                        	echo '<div class="alert alert-error">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Erro!</strong>A alteração do Cliente falhou!
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
											<label class="control-label">Data de Nascimento</label>
											<div class="controls">
												<div class="input-append date date-picker" data-date="24/10/2015" data-date-format="mm/dd/yyyy" data-date-viewmode="years">
													<input class=" m-ctrl-medium date-picker" size="16" value="<?php echo date_format($data, "m/d/Y"); ?>" name="senderData" type="text" required="required"/>
													<span class="add-on">
														<i class="icon-calendar"></i>
													</span>
												</div>
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
												<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Editar Cliente</button>
												<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/customer/visualizar&id=<?php echo $pega_id; ?>';">Cancelar Alteração</button>
										</div>
									</div><!-- fim do grupo-->
										<input type="hidden" name="editar" value="edit" />
								</form>
							</div>
						</div>
					</div>
				</div>
