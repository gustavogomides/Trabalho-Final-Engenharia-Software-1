	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_conta = mysqli_query($mysqli, "SELECT type, balance, creationDate, idCustomer
	                                                            FROM account
	                                                            WHERE idAccount = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_conta) <= '0'){

	                    }else{
	                        while ($res_pega_conta = mysqli_fetch_array($pega_conta)) {
	                            $tipo = $res_pega_conta[0];
                                $saldo = $res_pega_conta[1];		
                                $data = new DateTime($res_pega_conta[2]);
                                $contaID = $res_pega_conta[3];
	                        }
	                    }
	                }
	            }
	         ?>
			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Alterar Conta</h3>
							<ul class="breadcrumb">
								<li><a href="#"><i class="icon-flag"></i></a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Contas</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/account/listar">Lista de Contas</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/account/visualizar&id=<?php echo $pega_id; ?>">Visualizar Contas</a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Alterar Conta</a><span class="divider-last">&nbsp;</span></li>
							</ul>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="editar" action="" method="post" enctype="multipart/form-data">
									<?php 
						                    if(isset($_POST['editar']) && $_POST['editar'] == 'edit'){
													$tipo = strip_tags(trim($_POST['senderTipo']));
													$saldo = strip_tags(trim($_POST['senderSaldo']));
													$data = new DateTime(strip_tags(trim($_POST['senderData'])));
  													$date = date_format($data, 'Y-m-d');
													$contaID = strip_tags(trim($_POST['senderClienteID']));
													
													$editar = mysqli_query($mysqli, "UPDATE account
							                                                             SET type = '$tipo',
							                                                             	 balance = '$saldo',
																							 creationDate = '$date',
																							 idCustomer = '$contaID'
																						WHERE idAccount = '$pega_id'
						                                                                LIMIT 1")
			                    				or die(mysqli_error($mysqli));
			        
						                        if($editar == '1'){
						                        	echo '<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Sucesso!</strong> Conta alterada com sucesso! 
													Você será redirecionado em 3 segundos! 
													</div>';
													echo '<script>setTimeout(function () {
															window.location.href= "index.php?topicos=pages/account/visualizar&id='.$pega_id.'";
															},3000);
														</script>';
						                        }else{
						                        	echo '<div class="alert alert-error">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Erro!</strong>A alteração da Conta falhou!
													Tente novamente!
													</div>';
						                        }
						                	}   
						                ?>	


					            	<div class="form-group"> <!-- inicio do grupo -->
						                <div class="control-group"> <!-- inicio do grupo -->
											<label class="control-label">Tipo</label>
											<div class="controls">
												<input type="text" class="span6" name="senderTipo" value="<?php echo $tipo; ?>" required="required"/>
											</div>
									</div>
										<div class="control-group"> 
											<label class="control-label">Saldo</label>
											<div class="controls">
												<input type="text" class="span6" name="senderSaldo" value="<?php echo $saldo; ?>" required="required"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Data de Criação</label>
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
											<label class="control-label">ID do Cliente</label>
											<div class="controls">
												<input type="text" class="span6" name="senderClienteID" value="<?php echo $contaID; ?>" required="required"/>
											</div>
										</div>
									</div><!-- fim do grupo-->
										<div class="form-group"> <!-- inicio do grupo -->
											<div class="form-actions"><!-- inicio do grupo-->
													<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Editar Conta</button>
													<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/account/visualizar&id=<?php echo $pega_id; ?>';">Cancelar Alteração</button>
											</div>
										</div><!-- fim do grupo-->
										<input type="hidden" name="editar" value="edit" />
								</form>
							</div>
						</div>
					</div>
				</div>

