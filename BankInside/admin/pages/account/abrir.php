			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Abrir Conta</h3>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="cadastrar" action="" method="post" enctype="multipart/form-data">
									<?php 
										if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cad') {
											$tipo = strip_tags(trim($_POST['inputTipo']));
											$saldo = strip_tags(trim($_POST['inputBalance']));
											$data = new DateTime(strip_tags(trim($_POST['inputCriacao'])));
											$dataCriacao = date_format($data, 'Y-m-d');
											$IDcliente = strip_tags(trim($_POST['inputcustomerID']));
											

											$cadastrar = mysqli_query($mysqli, 
																"INSERT INTO account(type, balance, creationDate, idCustomer)
																VALUES ('$tipo', '$saldo', '$dataCriacao', '$IDcliente')")
																or die(mysqli_error($mysqli)); 

																

											if($cadastrar == '1'){
											echo '<div class="alert alert-success">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Sucesso!</strong> Conta cadastrada com sucesso! 
											Você será redirecionado em 3 segundos! 
											</div>';

											echo '<script>setTimeout(function () {
											window.location.href= "../../../admin/index.php";
											}, 3000);
											</script>';
											}else{
											echo '<div class="alert alert-error">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Erro!</strong>O cadastro da Conta falhou!
											Tente novamente!
											</div>';
											}

										}
									?>
									<div class="form-group"> <!-- inicio do grupo -->
										<div class="control-group">
											<label for="inputTipo">Tipo</label>
											<input type="text" class="form-control" name="inputTipo" id="inputTipo" placeholder="Tipo">
										</div>
									
										<div class="control-group">
											<label for="inputBalance">Saldo</label>
											<input type="decimal" class="form-control" name="inputBalance" id="inputBalance" placeholder="Saldo">
										</div>
										<div class="control-group">
											<label for="inputAddress">Data de Criação</label>
											<div class='input-group date' id='datetimepicker'>
												<input type='text' class="form-control" name="inputCriacao" id="inputCriacao">
												<span class="input-group-addon" id="inputCriacaoo">
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
											<label for="inputcustomerID">ID do Cliente</label>
											<input type="text" class="form-control" name="inputcustomerID" id="inputcustomerID" placeholder="ID do Cliente">
										</div>
									</div>	<!-- fim do grupo-->
									<div class="form-group"> <!-- inicio do grupo -->
										<div class="form-actions">
											<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/customer/listar';">Listar Clientes</button>
											<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Abrir Conta</button>
											<button type="button" class="btn btn-lg" onclick="window.location='../../../admin/index.php';">Cancelar Cadastro da Conta</button>
										</div>
									</div><!-- fim do grupo-->
									<input type="hidden" name="cadastrar" value="cad" />
								</form>
							</div>
						</div>
					</div>
				</div>
