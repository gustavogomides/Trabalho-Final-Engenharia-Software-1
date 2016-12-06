	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_cliente = mysqli_query($mysqli, "SELECT name, gender, birthday,address, documentId
	                                                            FROM customer
	                                                            WHERE idCustomer = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_cliente) <= '0'){

	                    }else{
	                        while ($res_pega_cliente = mysqli_fetch_array($pega_cliente)) {
	                            $nome = $res_pega_cliente[0];
	                            $sexo = $res_pega_cliente[1];
	                            $nascimento = new DateTime($res_pega_cliente[2]);
	                            $endereco = $res_pega_cliente[3];
	                            $documento = $res_pega_cliente[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Visualizar Cliente</h3>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<h4><i class="icon-flag"></i>Informações do Cliente</h4>
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<?php

								        if(isset($_GET['action']) && $_GET['action'] == 'deletar'){
								            	
								            $deletar = mysqli_query($mysqli,"DELETE FROM customer
							                                                   WHERE idCustomer = '$pega_id'
							                                                   LIMIT 1")
							                                        or die(mysql_error($mysqli));
												
											if($deletar == '1'){
												echo '<div class="alert alert-success">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Sucesso!</strong> Cliente deletado com sucesso! 
														Você será redirecionado em 3 segundos! 
													</div>';

												echo '<script>setTimeout(function () {
														window.location.href= "index.php?topicos=pages/customer/listar";
														},3000);
													</script>';
											}else{
												echo '<div class="alert alert-error">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Erro!</strong>ao deletar Cliente!
													</div>';
											}
								        }

								    ?>
									<div class="span6">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<td class="span2">Nome:</td>
													<td><?php echo $nome; ?></td>
												</tr>
												<tr>
													<td class="span2">Sexo:</td>
													<td><?php echo $sexo; ?></td>
												</tr>
												<tr>
													<td class="span2">Data de Nascimento:</td>
													<td><?php echo date_format($nascimento, "j F, Y"); ?></td>
												</tr>

												<tr>
													<td class="span2">Endereço:</td>
													<td><?php echo $endereco; ?></td>
												</tr>
												<tr>
													<td class="span2">Documento:</td>
													<td><?php echo $documento; ?></td>
												</tr>

											</tbody>
										</table>
										<a href="index.php?topicos=pages/customer/editar&id=<?php echo $pega_id ;?>">
											<button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Editar Cliente</button> 
										</a>  
										<a role="button" data-toggle="modal">
											<button data-dismiss="modal" class="btn btn-danger" onclick="window.location='index.php?topicos=pages/customer/visualizar&id=<?php echo $pega_id; ?>&action=deletar';">Deletar Cliente</button>
										</a>
										<a href="index.php?topicos=pages/customer/listar&id=<?php echo $pega_id ;?>">
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
