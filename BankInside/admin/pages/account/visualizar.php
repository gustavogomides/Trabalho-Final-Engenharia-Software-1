	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_conta = mysqli_query($mysqli, "SELECT idAccount, type, balance, creationDate, idCustomer
	                                                            FROM account
	                                                            WHERE idAccount = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_conta) <= '0'){

	                    }else{
	                        while ($res_pega_conta = mysqli_fetch_array($pega_conta)) {
	                            $id = $res_pega_conta[0];
                                $tipo = $res_pega_conta[1];
                                $saldo = $res_pega_conta[2];		
                                $dataCriacao = new DateTime($res_pega_conta[3]);
                                $contaID = $res_pega_conta[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Visualizar Conta</h3>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<h4><i class="icon-flag"></i>Informações da Conta</h4>
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<?php

								        if(isset($_GET['action']) && $_GET['action'] == 'deletar'){
								            	
								            $deletar = mysqli_query($mysqli,"DELETE FROM account
							                                                   WHERE idAccount = '$pega_id'
							                                                   LIMIT 1")
							                                        or die(mysqli_error($mysqli));
												
											if($deletar == '1'){
												echo '<div class="alert alert-success">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Sucesso!</strong> Conta deletada com sucesso! 
														Você será redirecionado em 3 segundos! 
													</div>';

												echo '<script>setTimeout(function () {
														window.location.href= "index.php?topicos=pages/account/listar";
														},3000);
													</script>';
											}else{
												echo '<div class="alert alert-error">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Erro!</strong>ao deletar Conta!
													</div>';
											}
								        }

								    ?>
									<div class="span6">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<td class="span2">Tipo:</td>
													<td><?php echo $tipo; ?></td>
												</tr>
												<tr>
													<td class="span2">Saldo:</td>
													<td><?php echo "R$ $saldo"; ?></td>
												</tr>
												<tr>
													<td class="span2">Data de Criação:</td>
													<td><?php echo date_format($dataCriacao, "j F, Y"); ?></td>
												</tr>
												<tr>
													<td class="span2">ID do Cliente:</td>
													<td><?php echo $contaID; ?></td>
												</tr>

											</tbody>
										</table>
										<a href="index.php?topicos=pages/account/editar&id=<?php echo $pega_id ;?>">
											<button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Editar Conta</button> 
										</a>  
										<a role="button" data-toggle="modal">
											<button data-dismiss="modal" class="btn btn-danger" onclick="window.location='index.php?topicos=pages/account/visualizar&id=<?php echo $pega_id; ?>&action=deletar';">Deletar Conta</button>
										</a>
										<a href="index.php?topicos=pages/account/listar&id=<?php echo $pega_id ;?>">
											<button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Voltar</button> 
										</a>
										

									</div>
									<div class="space5"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
