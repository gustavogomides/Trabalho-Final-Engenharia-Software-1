			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Inserir Cliente</h3>
						<div class="col-md-6 col-md-offset-3">
							<form class="form-horizontal" nome="cadastrar" action="" method="post" enctype="multipart/form-data">
								<?php 
									if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cad') {
										$nome = strip_tags(trim($_POST['inputName']));
										$sexo = strip_tags(trim($_POST['inputSex']));
										$data = new DateTime(strip_tags(trim($_POST['inputBirthdate'])));
										$dataNascimento = date_format($data, 'Y-m-d');
										$endereco = strip_tags(trim($_POST['inputAddress']));
										$documento = strip_tags(trim($_POST['inputDocument']));

  										$user = mysqli_query($mysqli, "SELECT MAX(id_user)
	                                                            FROM bnk_user")
	                                   							or die(mysqli_error($mysqli));
	                                   	
	                                   	$resultado = mysqli_fetch_array($user);
	                                   	$atualizaUser = $resultado[0];

	                                   	$cadastrar = mysqli_query($mysqli, 
										"INSERT INTO customer(name, gender, birthday, address, documentId, id_user)
										VALUES ('$nome', '$sexo', '$dataNascimento', '$endereco', '$documento', '$atualizaUser')")
										or die(mysqli_error($mysqli)); 

										if($cadastrar == '1'){
										echo '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Sucesso!</strong> Cliente cadastrado com sucesso! 
										Você será redirecionado em 3 segundos! 
										</div>';

										echo '<script>setTimeout(function () {
										window.location.href= "../../../admin/index.php";
										}, 3000);
										</script>';
										}else{
										echo '<div class="alert alert-error">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Erro!</strong>O cadastro do Cliente falhou!
										Tente novamente!
										</div>';
										}

									}
								?>
							   <div class="form-group"> <!-- inicio do grupo -->
								<div class="control-group">
									<label for="inputName">Nome</label>
									<input type="text" class="form-control" name="inputName" id="inputName" placeholder="Nome">
								</div>
								<div class="control-group">
									<label for="inputSex">Sexo</label>
									<select class="form-control" name="inputSex" id="inputSex">
										<option>F</option>
										<option>M</option>
									</select>
								</div>
								<div class="control-group">
									<label for="inputAddress">Data de Nascimento</label>
									<div class='input-group date' id='datetimepicker'>
										<input type='text' class="form-control" name="inputBirthdate" id="inputBirthdate">
										<span class="input-group-addon" id="inputDataNascimento">
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
									<label for="inputAddress">Endereço</label>
									<input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="Endereço">
								</div>
								<div class="control-group">
									<label for="inputDocument">Documento</label>
									<input type="text" class="form-control" name="inputDocument" id="inputDocument" placeholder="Documento">
								</div>
							  </div><!-- fim do grupo-->
							  <div class="form-group"><!-- inicio do grupo-->
								<div class="form-actions">
									<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Cadastrar Cliente</button>
									<button type="button" class="btn btn-lg" onclick="window.location='../../../admin/index.php';">Cancelar Cadastro</button>
								</div>
							  </div><!-- fim do grupo-->
								<input type="hidden" name="cadastrar" value="cad" />
							</form>
						</div>
					</div>
				</div>
			</div>
