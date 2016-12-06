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
	                            $validade = new DateTime($res_pega_cartao[1]);
	                            $bandeira = $res_pega_cartao[2];
	                            $limite = $res_pega_cartao[3];
	                            $idConta = $res_pega_cartao[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Visualizar Cartão</h3>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<h4><i class="icon-flag"></i>Informações do Cartão</h4>
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<?php

								        if(isset($_GET['action']) && $_GET['action'] == 'deletar'){
								            	
								            $deletar = mysqli_query($mysqli,"DELETE FROM card
							                                                   WHERE idCard = '$pega_id'
							                                                   LIMIT 1")
							                                        or die(mysql_error($mysqli));
												
											if($deletar == '1'){
												echo '<div class="alert alert-success">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Sucesso!</strong> Cartão deletado com sucesso! 
														Você será redirecionado em 3 segundos! 
													</div>';

												echo '<script>setTimeout(function () {
														window.location.href= "index.php?topicos=pages/card/listar";
														},3000);
													</script>';
											}else{
												echo '<div class="alert alert-error">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Erro!</strong>ao deletar Cartão!
													</div>';
											}
								        }

								    ?>
									<div class="span6">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<td class="span2">Número:</td>
													<td><?php echo $numero; ?></td>
												</tr>
												<tr>
													<td class="span2">Data de Validade:</td>
													<td><?php echo date_format($validade, "j F, Y"); ?></td>
												</tr>
												<tr>
													<td class="span2">Bandeira:</td>
													<td><?php echo $bandeira; ?></td>
												</tr>

												<tr>
													<td class="span2">Limite:</td>
													<td><?php echo "R$ $limite"; ?></td>
												</tr>
												<tr>
													<td class="span2">ID da conta:</td>
													<td><?php echo $idConta; ?></td>
												</tr>

											</tbody>
										</table>
										<a href="index.php?topicos=pages/card/editar&id=<?php echo $pega_id ;?>">
											<button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Editar Cartão</button> 
										</a>  
										<a role="button" data-toggle="modal">
											<button data-dismiss="modal" class="btn btn-danger" onclick="window.location='index.php?topicos=pages/card/visualizar&id=<?php echo $pega_id; ?>&action=deletar';">Deletar Cartão</button>
										</a>
										<a href="index.php?topicos=pages/card/listar&id=<?php echo $pega_id ;?>">
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
