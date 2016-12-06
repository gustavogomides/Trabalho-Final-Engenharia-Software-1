	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_compra = mysqli_query($mysqli, "SELECT value, transaction, buyDate, idCard
	                                                            FROM buy
	                                                            WHERE idBuy = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_compra) <= '0'){

	                    }else{
	                        while ($res_pega_compra = mysqli_fetch_array($pega_compra)) {
	                            $valor = $res_pega_compra[0];
                                $descricao = $res_pega_compra[1];
                                $compra = new DateTime($res_pega_compra[2]);
                                $idConta = $res_pega_compra[3];
	                        }
	                    }
	                }
	            }

	        ?>
			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Cancelar Compra</h3>
							<ul class="breadcrumb">
								<li><a href="#"><i class="icon-flag"></i></a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Compras</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/buy/listar">Lista de Compras</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/buy/visualizar&id=<?php echo $pega_id; ?>">Visualizar Compra</a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Cancelar Compra</a><span class="divider-last">&nbsp;</span></li>
							</ul>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="editar" action="" method="post" enctype="multipart/form-data">
									<?php 
						                    if(isset($_POST['editar']) && $_POST['editar'] == 'edit'){
													/*$valor = strip_tags(trim($_POST['senderValor']));
													$numeroDocumento = strip_tags(trim($_POST['senderDocumento']));
													$idConta = strip_tags(trim($_POST['senderIDconta']));*/
													
													
													$editar = mysqli_query($mysqli, "DELETE FROM buy
																						WHERE idBuy = '$pega_id'
						                                                                LIMIT 1")
			                    											or die(mysqli_error($mysqli));
			                    					
			                    					$estorno = mysqli_query($mysqli, "UPDATE account
				                                                                SET balance = balance + '$valor'
																				WHERE idAccount = '$idConta'
				                                                                LIMIT 1")
			                    					or die(mysqli_error($mysqli));

			                    					$atualizaContador = mysqli_query($mysqli, "UPDATE account
				                                                             SET counter = counter + 1
																			 WHERE idAccount = '$idConta'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));
			                    					
			                    					$dataHora = DATE("Y/m/d");

			                    					$atualizaData = mysqli_query($mysqli, "UPDATE account
				                                                             SET lastUpdate = '$dataHora'
																			 WHERE idAccount = '$idConta'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));					
			        
						                        if($editar == '1'){
						                        	echo '<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Sucesso!</strong> Compra cancelada com sucesso! 
													Estorno realizado com sucesso!
													Você será redirecionado em 5 segundos! 
													</div>';
													echo '<script>setTimeout(function () {
															window.location.href= "index.php?topicos=pages/buy/listar";
															},5000);
														</script>';
						                        }else{
						                        	echo '<div class="alert alert-error">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Erro!</strong>O cancelamento da compra falhou!
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
											<label class="control-label">Descrição</label>
											<div class="controls">
												<td><?php echo $descricao; ?></td>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">ID da Conta</label>
											<div class="controls">
												<td><?php echo $idConta; ?></td>
											</div>
										</div>
									</div><!-- fim do grupo-->
									<div class="form-group"> <!-- inicio do grupo -->
										<div class="form-actions"><!-- inicio do grupo-->
												<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Cancelar Compra</button>
												<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/buy/visualizar&id=<?php echo $pega_id; ?>';">Voltar</button>
										</div>
									</div><!-- fim do grupo-->
										<input type="hidden" name="editar" value="edit" />
								</form>
							</div>
						</div>
					</div>
				</div>
