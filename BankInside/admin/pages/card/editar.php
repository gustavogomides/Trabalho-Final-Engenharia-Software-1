	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_cartao = mysqli_query($mysqli, "SELECT numberCard, goodThru, flag, limitCard, idAccount
	                                                            FROM card
	                                                            WHERE idCard = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_cartao) <= '0'){

	                    }else{
	                        while ($res_pega_cartao = mysqli_fetch_array($pega_cartao)) {
	                            $numero = $res_pega_cartao[0];
	                            $data = new DateTime($res_pega_cartao[1]);
	                            $bandeira = $res_pega_cartao[2];
	                            $limite = $res_pega_cartao[3];
	                            $idConta = $res_pega_cartao[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div class="main-content">
				<div class="container">
					<div class="row">
						<h3 class="page-title">Alterar Cartão</h3>
							<ul class="breadcrumb">
								<li><a href="#"><i class="icon-flag"></i></a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Cartões</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/card/listar">Lista de Cartões</a><span class="divider">&nbsp;</span></li>
								<li><a href="index.php?topicos=pages/card/visualizar&id=<?php echo $pega_id; ?>">Visualizar Cartão</a><span class="divider">&nbsp;</span></li>
								<li><a href="#">Alterar Cartão</a><span class="divider-last">&nbsp;</span></li>
							</ul>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" nome="editar" action="" method="post" enctype="multipart/form-data">
									<?php 
						                    if(isset($_POST['editar']) && $_POST['editar'] == 'edit'){
													$numero = strip_tags(trim($_POST['senderNumero']));
													$data = new DateTime(strip_tags(trim($_POST['senderData'])));
  													$date = date_format($data, 'Y-m-d');
													$bandeira = strip_tags(trim($_POST['senderBandeira']));
													$limite = strip_tags(trim($_POST['senderLimite']));
													$idConta = strip_tags(trim($_POST['senderIDconta']));
													
													
													$editar = mysqli_query($mysqli, "UPDATE card
						                                                                SET numberCard = '$numero',
							                                                                goodThru = '$date', 
							                                                                flag = '$bandeira', 
							                                                                limitCard = '$limite', 
							                                                                idAccount = '$idConta'
																						WHERE idCard = '$pega_id'
						                                                                LIMIT 1")
			                    				or die(mysqli_error($mysqli));
			        
						                        if($editar == '1'){
						                        	echo '<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Sucesso!</strong> Cartão alterado com sucesso! 
													Você será redirecionado em 3 segundos! 
													</div>';
													echo '<script>setTimeout(function () {
															window.location.href= "index.php?topicos=pages/card/visualizar&id='.$pega_id.'";
															},3000);
														</script>';
						                        }else{
						                        	echo '<div class="alert alert-error">
													<button class="close" data-dismiss="alert">×</button>
													<strong>Erro!</strong>A alteração do Cartão falhou!
													Tente novamente!
													</div>';
						                        }
						                	}   
						                ?>	

 									<div class="form-group"> <!-- inicio do grupo -->
						                <div class="control-group"> <!-- inicio do grupo -->
											<label class="control-label">Número</label>
											<div class="controls">
												<input type="text" class="span6" name="senderNumero" value="<?php echo $numero; ?>" required="required"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Data de Validade</label>
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
											<label class="control-label">Bandeira</label>
											<div class="controls">
												<input type="text" class="span6" name="senderBandeira" value="<?php echo $bandeira; ?>" required="required"/>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">Limite</label>
											<div class="controls">
												<input type="text" class="span6" name="senderLimite" value="<?php echo $limite; ?>" required="required"/>
											</div>
										</div>
										<div class="control-group">  
											<label class="control-label">ID da Conta</label>
											<div class="controls">
												<input type="text" class="span6" name="senderIDconta" value="<?php echo $idConta; ?>" required="required"/>
											</div>
										</div>
									</div><!-- fim do grupo-->
									<div class="form-group"> <!-- inicio do grupo -->
										<div class="form-actions"><!-- inicio do grupo-->
												<button type="submit" name="senderTime" class="btn btn-primary btn-lg">Editar Cartão</button>
												<button type="button" class="btn btn-lg" onclick="window.location='index.php?topicos=pages/card/visualizar&id=<?php echo $pega_id; ?>';">Cancelar Alteração</button>
										</div>
									</div><!-- fim do grupo-->
										<input type="hidden" name="editar" value="edit" />
								</form>
							</div>
						</div>
					</div>
				</div>
