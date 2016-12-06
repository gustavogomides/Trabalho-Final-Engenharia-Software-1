			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Cadastrar Cartão</h3>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="cadastrar" action="" method="post" enctype="multipart/form-data">
									<?php 
										if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cad') {
											$numero = strip_tags(trim($_POST['inputNumero']));
											$data = new DateTime(strip_tags(trim($_POST['inputValidade'])));
											$validade = date_format($data, 'Y-m-d');								
											$flag = strip_tags(trim($_POST['inputFlag']));
											$limite = strip_tags(trim($_POST['inputLimite']));
											$IDconta = strip_tags(trim($_POST['inputIDConta']));
											$cadastrar = mysqli_query($mysqli, 
											"INSERT INTO card(numberCard, goodThru, flag, limitCard, idAccount)
											VALUES ('$numero', '$validade', '$flag', '$limite', '$IDconta')")
											or die(mysqli_error($mysqli)); 


											if($cadastrar == '1'){
											echo '<div class="alert alert-success">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Sucesso!</strong> Cartão cadastrado com sucesso! 
											Você será redirecionado em 3 segundos! 
											</div>';

											echo '<script>setTimeout(function () {
											window.location.href= "../../../admin/index.php";
											}, 3000);
											</script>';
											}else{
											echo '<div class="alert alert-error">
											<button class="close" data-dismiss="alert">×</button>
											<strong>Erro!</strong>O cadastro do Cartão falhou!
											Tente novamente!
											</div>';
											}

										}
									?>
								  <div class="form-group"> <!-- inicio do grupo -->
									<div class="control-group">
										<label for="inputNumero">Número</label>
										<input type="text" class="form-control" name="inputNumero" id="inputNumero" placeholder="Número">
									</div>
									<div class="control-group">
										<label for="inputValidade">Data de Validade</label>
										<div class='input-group date' id='datetimepicker'>
											<input type='text' class="form-control" name="inputValidade" id="inputValidade">
											<span class="input-group-addon" id="inputValidade">
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
										<label for="inputFlag">Bandeira</label>
										<input type="text" class="form-control" name="inputFlag" id="inputFlag" placeholder="Bandeira">
									</div>
									<div class="control-group">
										<label for="inputLimite">Limite</label>
										<input type="decimal" class="form-control" name="inputLimite" id="inputLimite" placeholder="Limite">
									</div>
									<div class="form-actions">
									    <div class="control-group">
									 	   <label for="inputIDConta">ID da Conta</label>
									 	   <input type="text" class="form-control" name="inputIDConta" id="inputIDConta" placeholder="ID da conta">
										</div>
									</div>
								 </div><!-- fim do grupo-->
								 
							     <div class="form-group"><!-- inicio do grupo-->
									<div class="form-actions">
										<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/account/listar';">Listar Contas</button>
										<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Inserir Cartão</button>
										<button type="button" class="btn btn-lg" onclick="window.location='../../../admin/index.php';">Cancelar Cadastro do Cartão</button>
									</div>
								  </div><!-- fim do grupo-->
								  
									<input type="hidden" name="cadastrar" value="cad" />
								</form>
							</div>
						</div>
					</div>
				</div>


