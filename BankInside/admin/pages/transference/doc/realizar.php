			<?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_conta = mysqli_query($mysqli, "SELECT idAccount, idCustomer
	                                                            FROM account
	                                                            WHERE idAccount = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_conta) <= '0'){

	                    }else{
	                        while ($res_pega_conta = mysqli_fetch_array($pega_conta)) {
	                            $id = $res_pega_conta[0];
                                $contaID = $res_pega_conta[1];
	                        }
	                    }
	                }
	            }

	        ?>

	        <div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Realizar TED</h3>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="cadastrar" action="" method="post" enctype="multipart/form-data">
									<?php 
										if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cad') {
											$data = new DateTime(strip_tags(trim($_POST['inputData'])));
											$dataTED = date_format($data, 'Y-m-d');	
											$valor = strip_tags(trim($_POST['inputValor']));											
											$IDconta = strip_tags(trim($_POST['inputIDConta']));
											$banco = strip_tags(trim($_POST['inputBank']));
						
											$cadastrar = mysqli_query($mysqli, 
												"INSERT INTO transference(type, value, dateTransfer, idAccount, bank, accountDestin)
												VALUES ('DOC', '$valor', '$dataTED', '$pega_id', '$banco', '$IDconta')")
												or die(mysqli_error($mysqli)); 

											$editarRemetente = mysqli_query($mysqli, "UPDATE account
				                                                                SET balance = balance - '$valor'
																				WHERE idAccount = '$id'
				                                                                LIMIT 1")
			                    									or die(mysqli_error($mysqli));


											
        									$atualizaContadorRemente = mysqli_query($mysqli, "UPDATE account
							                                                     SET counter = counter + 1
																				 WHERE idAccount = '$id'
							                                                     LIMIT 1")
							        										or die(mysqli_error($mysqli));

			                    			$dataHora = DATE("Y/m/d");

			                    			$atualizaDataRemente = mysqli_query($mysqli, "UPDATE account
				                                                             SET lastUpdate = '$dataHora'
																			 WHERE idAccount = '$id'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));

			                    	    	if($cadastrar == '1'){
												
													echo '<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Sucesso!</strong> DOC realizado com Sucesso! 
													Você será redirecionado em 3 segundos! 
													</div>';

													echo '<script>setTimeout(function () {
													window.location.href= "../../../admin/index.php";
													}, 3000);
													</script>';
												
											}else{
												echo '<div class="alert alert-error">
												<button class="close" data-dismiss="alert">×</button>
												<strong>Erro!</strong>DOC não realizada!
												Tente novamente!
												</div>';
											}

										}


										$pega_nome = mysqli_query($mysqli, "SELECT name
	                                                            FROM customer
	                                                            WHERE idCustomer = '$contaID'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                                   		
	                                   	while ($resultado = mysqli_fetch_array($pega_nome)) {	
											$nome = $resultado[0];	
									?>
									

									<div class="span6">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<td class="span2">ID da Conta:</td>
													<td><?php echo $pega_id; ?></td>
												</tr>
												<tr>
													<td class="span2">ID do Cliente:</td>
													<td><?php echo $contaID; ?></td>
												</tr>
												<tr>
													<td class="span2">Nome do Cliente:</td>
													<td><?php echo $nome; ?></td>
												</tr>
												<tr>
													<td class="span2">Tipo da Transferência:</td>
													<td><?php echo "DOC"; ?></td>
												</tr>
												</tbody>
										</table>
									</div>
									<?php 
										}
									?>
									<div class="form-group"> <!-- inicio do grupo -->
										<div class="control-group">
											<label for="inputData">Data da Transferência</label>
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
											<input type="numer" class="form-control" name="inputValor" id="inputValor" placeholder="Valor da Transferência">
											
										</div>
										<div class="control-group">
											<label for="inputBank">Banco do Destinatário</label>
											<input type="text" class="form-control" name="inputBank" id="inputBank" placeholder="Banco do Destinatário">
										</div>
										<div class="control-group">
											<label for="inputIDConta">ID da Conta Destinatária</label>
											<input type="text" class="form-control" name="inputIDConta" id="inputIDConta" placeholder="ID da Conta">
										</div>
										
									</div><!-- fim do grupo-->
								
									<div class="form-group"><!-- inicio do grupo-->
										<div class="form-actions">
											<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Realizar DOC</button>
											<button type="button" class="btn btn-lg" onclick="window.location.href='index.php?topicos=pages/transference/doc/opcao'">Cancelar</button>
										</div>
									</div><!-- fim do grupo-->
									
									<input type="hidden" name="cadastrar" value="cad" />
								</form>
							</div>
						</div>
					</div>
				</div>

