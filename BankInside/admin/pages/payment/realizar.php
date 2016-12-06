			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Realizar Pagamento</h3>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="cadastrar" action="" method="post" enctype="multipart/form-data">
									<?php 
										if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cad') {
											$valor = strip_tags(trim($_POST['inputValor']));
											$numDocumento = strip_tags(trim($_POST['inputDocumento']));
											$codBarras = strip_tags(trim($_POST['inputBarras']));
											$data = new DateTime(strip_tags(trim($_POST['inputPagamento'])));
											$pagamentoData = date_format($data, 'Y-m-d');	
											$IDconta = strip_tags(trim($_POST['inputIDConta']));

											$cadastrar = mysqli_query($mysqli, 
												"INSERT INTO payment(value, documentNumber, barcode, paymentDate, idAccount)
												VALUES ('$valor', '$numDocumento', '$codBarras', '$pagamentoData', '$IDconta')")
												or die(mysqli_error($mysqli)); 
																	
							                
						                    $editar = mysqli_query($mysqli, "UPDATE account
				                                                             SET balance = balance - '$valor'
																			 WHERE idAccount = '$IDconta'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));

			                    			$atualizaContador = mysqli_query($mysqli, "UPDATE account
				                                                             SET counter = counter + 1
																			 WHERE idAccount = '$IDconta'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));	
			                    			
			                    			$dataHora = DATE("Y/m/d");

			                    			$atualizaData = mysqli_query($mysqli, "UPDATE account
				                                                             SET lastUpdate = '$dataHora'
																			 WHERE idAccount = '$IDconta'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));													


											if($cadastrar == '1'){
											echo '<div class="alert alert-success">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Sucesso!</strong> Pagamento realizado com Sucesso! 
											Você será redirecionado em 3 segundos! 
											</div>';

											echo '<script>setTimeout(function () {
											window.location.href= "../../../admin/index.php";
											}, 3000);
											</script>';
											}else{
											echo '<div class="alert alert-error">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Erro!</strong>Pagamento não realizado!
											Tente novamente!
											</div>';
											}

										}
									?>

									<div class="form-group"> <!-- inicio do grupo -->
										<div class="control-group">
											<label for="inputDocumento">Número do Documento</label>
											<input type="text" class="form-control" name="inputDocumento" id="inputDocumento" placeholder="Número do Documento">
										</div>
										<div class="control-group">
											<label for="inputBarras">Código de Barras</label>
											<input type="text" class="form-control" name="inputBarras" id="inputBarras" placeholder="Código de Barras">
										</div>
										<div class="control-group">
										<label for="inputPagamento">Data do Pagamento</label>
										<div class='input-group date' id='datetimepicker'>
											<input type='text' class="form-control" name="inputPagamento" id="inputPagamento" placeholder="01/01/2015">
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
											<label for="inputIDConta">ID da Conta</label>
											<input type="text" class="form-control" name="inputIDConta" id="inputIDConta" placeholder="ID da Conta">
										</div>
										<div class="control-group">
											<label for="inputValor">Valor</label>
											<input type="text" class="form-control" name="inputValor" id="inputValor" placeholder="Valor">
										</div>
									</div><!-- fim do grupo-->
									<div class="form-group"><!-- inicio do grupo-->
										<div class="form-actions">
											<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Realizar Pagamento</button>
											<button type="button" class="btn btn-lg" onclick="window.location='../../../admin/index.php'">Cancelar Pagamento</button>
										</div>
									</div><!-- fim do grupo-->
									<input type="hidden" name="cadastrar" value="cad" />
								</form>
							</div>
						</div>
					</div>
				</div>
