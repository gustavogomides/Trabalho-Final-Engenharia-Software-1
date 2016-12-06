	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_DOC = mysqli_query($mysqli, "SELECT value, dateTransfer, idAccount, bank, accountDestin
	                                                            FROM transference
	                                                            WHERE idTransference = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
						if(@mysqli_num_rows($pega_DOC) <= '0'){

	                    }else{
	                        while ($res_listar = mysqli_fetch_array($pega_DOC)) {
	                            $valor = $res_listar[0];
                                $dataTED = new DateTime($res_listar[1]);		
                                $remetente = $res_listar[2];
                                $banco = $res_listar[3];
                                $destinatario = $res_listar[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Cancelar DOC</h3>
							<ul class="breadcrumb">
								<li><a href="#"><i class="icon-flag"></i></a><span class="divider">&nbsp;</span></li>
								<li><a href="#">DOC</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/transference/doc/listarDOC">Lista de DOCs</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/transference/doc/visualizar&id=<?php echo $pega_id; ?>">Visualizar DOC</a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Cancelar DOC</a><span class="divider-last">&nbsp;</span></li>
							</ul>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="editar" action="" method="post" enctype="multipart/form-data">
									<?php 
						                    if(isset($_POST['editar']) && $_POST['editar'] == 'edit'){
													/*$valor = strip_tags(trim($_POST['senderValor']));
													$numeroDocumento = strip_tags(trim($_POST['senderDocumento']));
													$idConta = strip_tags(trim($_POST['senderIDconta']));*/
													
													
													$editar = mysqli_query($mysqli, "DELETE FROM transference
																						WHERE idTransference = '$pega_id'
						                                                                LIMIT 1")
			                    											or die(mysqli_error($mysqli));
			                    					
			                    					$editarRemetente = mysqli_query($mysqli, "UPDATE account
				                                                                SET balance = balance + '$valor'
																				WHERE idAccount = '$remetente'
				                                                                LIMIT 1")
			                    									or die(mysqli_error($mysqli));

		        									$atualizaContadorRemente = mysqli_query($mysqli, "UPDATE account
									                                                     SET counter = counter + 1
																						 WHERE idAccount = '$remetente'
									                                                     LIMIT 1")
									        										or die(mysqli_error($mysqli));

					                    			$dataHora = DATE("Y/m/d");

					                    			$atualizaDataRemente = mysqli_query($mysqli, "UPDATE account
						                                                             SET lastUpdate = '$dataHora'
																					 WHERE idAccount = '$remetente'
						                                                             LIMIT 1")
					                    										or die(mysqli_error($mysqli));			
			        
						                        if($editar == '1'){
						                        	echo '<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Sucesso!</strong> DOC cancelado com sucesso! 
													Estorno realizado com sucesso!
													Você será redirecionado em 5 segundos! 
													</div>';
													echo '<script>setTimeout(function () {
															window.location.href= "index.php?topicos=pages/transference/doc/listarDOC";
															},5000);
														</script>';
						                        }else{
						                        	echo '<div class="alert alert-error">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Erro!</strong>O cancelamento do DOC falhou!
													Tente novamente!
													</div>';
						                        }
						                	}   
						                ?>	

 									<div class="form-group"> <!-- inicio do grupo -->
						                <div class="control-group"> <!-- inicio do grupo -->
											<label class="control-label">Valor</label>
											<div class="controls">
												<td><?php echo "R$ $valor"; ?></td>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">Data do TED</label>
											<div class="controls">
												<td><?php echo date_format($dataTED, "j F, Y"); ?></td>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">ID Conta Remetente</label>
											<div class="controls">
												<td><?php echo $remetente; ?></td>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">Banco de Destino</label>
											<div class="controls">
												<td><?php echo $banco; ?></td>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">ID Conta Destinatário</label>
											<div class="controls">
												<td><?php echo $destinatario; ?></td>
											</div>
										</div>
									</div><!-- fim do grupo-->
									<div class="form-group"> <!-- inicio do grupo -->
										<div class="form-actions"><!-- inicio do grupo-->
												<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Cancelar DOC</button>
												<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/transference/doc/visualizar&id=<?php echo $pega_id; ?>';">Voltar</button>
										</div>
									</div><!-- fim do grupo-->
										<input type="hidden" name="editar" value="edit" />
								</form>
							</div>
						</div>
					</div>
				</div>
