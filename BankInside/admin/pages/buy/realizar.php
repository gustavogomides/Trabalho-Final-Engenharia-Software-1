			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Realizar Compra</h3>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="cadastrar" action="" method="post" enctype="multipart/form-data">
									<?php 
										if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cad') {
											$descricao = strip_tags(trim($_POST['inputDescricao']));
											$data = new DateTime(strip_tags(trim($_POST['inputData'])));
											$dataCompra = date_format($data, 'Y-m-d');	
											$valor = strip_tags(trim($_POST['inputValor']));											
											$IDconta = strip_tags(trim($_POST['inputIDConta']));


											$pega_cartao = mysqli_query($mysqli, "SELECT idCard
	                                   							FROM card
	                                   							WHERE idAccount = '$IDconta'")
	                                   							or die(mysqli_error($mysqli));
	                                   		$resultado = mysqli_fetch_array($pega_cartao);
	                                   		$cartao = $resultado[0];

	                                   		$cadastrar = mysqli_query($mysqli, 
												"INSERT INTO buy(transaction, buyDate, value, idCard)
												VALUES ('$descricao', '$dataCompra', '$valor', '$cartao')")
												or die(mysqli_error($mysqli)); 

																	
											$editar = mysqli_query($mysqli, "UPDATE account
				                                                                SET balance = balance - '$valor'
																				WHERE idAccount = '$IDconta'
				                                                                LIMIT 1")
			                    				or die(mysqli_error($mysqli));
											
											$dataHora = DATE("Y/m/d");


											$pega_fatura = mysqli_query($mysqli, "SELECT *
	                                                            FROM invoice
	                                                            WHERE idCard = '$cartao'
	                                                            /*LIMIT 1 */")
	                                   							or die(mysqli_error($mysqli));

							                if(@mysqli_num_rows($pega_fatura) <= '0'){
							                	$fatura = mysqli_query($mysqli, 
												"INSERT INTO invoice(idCard, period)
												VALUES ('$cartao', '$dataHora')")
												or die(mysqli_error($mysqli)); 	
							                }

			                    			

											$pega_data = mysqli_query($mysqli, "SELECT period
                                   							FROM invoice
                                   							WHERE idCard = '$cartao'")
                                   							or die(mysqli_error($mysqli));
                                   			$result = mysqli_fetch_array($pega_data);
                                   			$data = new DateTime($result[0]);

                                   			if($data < $dataCompra) {
                                   				$editarDataFatura = mysqli_query($mysqli, "UPDATE invoice
				                                                                SET creationDate = '$dataCompra'
																				WHERE idCard = '$cartao'
				                                                                LIMIT 1")
			                    											or die(mysqli_error($mysqli));	
                                   			}

			                    			$editarFatura = mysqli_query($mysqli, "UPDATE invoice
				                                                                SET totalValue = totalValue + '$valor'
																				WHERE idCard = '$cartao'
				                                                                LIMIT 1")
			                    											or die(mysqli_error($mysqli));	

			                    			$atualizaContador = mysqli_query($mysqli, "UPDATE account
				                                                             SET counter = counter + 1
																			 WHERE idAccount = '$IDconta'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));
			                    			
			                    			

			                    			$atualizaData = mysqli_query($mysqli, "UPDATE account
				                                                             SET lastUpdate = '$dataHora'
																			 WHERE idAccount = '$IDconta'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));
							


											if($cadastrar == '1'){
											echo '<div class="alert alert-success">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Sucesso!</strong> Compra realizada com Sucesso! 
											Você será redirecionado em 3 segundos! 
											</div>';

											echo '<script>setTimeout(function () {
											window.location.href= "../../../admin/index.php";
											}, 3000);
											</script>';
											}else{
											echo '<div class="alert alert-error">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Erro!</strong>Compra não realizada!
											Tente novamente!
											</div>';
											}

										}

									?>

									<div class="form-group"> <!-- inicio do grupo -->
										<div class="control-group">
											<label for="inputDescricao">Descrição da Compra</label>
											<input type="text" class="form-control" name="inputDescricao" id="inputDescricao" placeholder="Descrição da Compra">
										</div>
										<div class="control-group">
											<label for="inputData">Data da Compra</label>
											<div class='input-group date' id='datetimepicker'>
												<input type='text' class="form-control" name="inputData" id="inputData" placeholder="01/01/2015">
												<span class="input-group-addon" id="inputPagamento">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
										<script type="text/javascript">
											$(function () {
												$('#datetimepicker').datetimepicker();
											});
										</script>										
										<div class="control-group">
											<label for="inputValor">Valor</label>
											<input type="text" class="form-control" name="inputValor" id="inputValor" placeholder="Valor da Compra">
										</div>
										<div class="control-group">
											<label for="inputIDConta">ID da Conta</label>
											<input type="text" class="form-control" name="inputIDConta" id="inputIDConta" placeholder="ID da Conta">
										</div>
										
									</div><!-- fim do grupo-->
									<div class="form-group"><!-- inicio do grupo-->
										<div class="form-actions">
											<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Realizar Compra</button>
											<button type="button" class="btn btn-lg" onclick="window.location='../../../admin/index.php'">Cancelar Compra</button>
										</div>
									</div><!-- fim do grupo-->
									
									<input type="hidden" name="cadastrar" value="cad" />
								</form>
							</div>
						</div>
					</div>
				</div>
