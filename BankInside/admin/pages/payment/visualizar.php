	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_pagamento = mysqli_query($mysqli, "SELECT value, documentNumber, barcode, paymentDate, idAccount
	                                                            FROM payment
	                                                            WHERE idPayment = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_pagamento) <= '0'){

	                    }else{
	                        while ($res_pega_pagamento = mysqli_fetch_array($pega_pagamento)) {
	                            $valor = $res_pega_pagamento[0];
	                            $numeroDocumento = $res_pega_pagamento[1];
	                            $codigoBarras = $res_pega_pagamento[2];
	                            $dataPagamento = new DateTime($res_pega_pagamento[3]);
	                            $idConta = $res_pega_pagamento[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Visualizar pagamento</h3>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<h4><i class="icon-flag"></i>Informações do pagamento</h4>
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<?php

								        if(isset($_GET['action']) && $_GET['action'] == 'deletar'){
								            	
								            $deletar = mysqli_query($mysqli,"DELETE FROM payment
							                                                   WHERE idPayment = '$pega_id'
							                                                   LIMIT 1")
							                                        or die(mysql_error($mysqli));
												
											if($deletar == '1'){
												echo '<div class="alert alert-success">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Sucesso!</strong> Pagamento deletado com sucesso! 
														Você será redirecionado em 3 segundos! 
													</div>';

												echo '<script>setTimeout(function () {
														window.location.href= "index.php?topicos=pages/payment/listar";
														},3000);
													</script>';
											}else{
												echo '<div class="alert alert-error">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Erro!</strong>ao deletar Pagamento!
													</div>';
											}
								        }

								    ?>
									<div class="span6">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<td class="span2">Valor:</td>
													<td><?php echo "R$ $valor"; ?></td>
												</tr>
												<tr>
													<td class="span2">Número do Documento:</td>
													<td><?php echo $numeroDocumento; ?></td>
												</tr>
												<tr>
													<td class="span2">Código de Barras:</td>
													<td><?php echo $codigoBarras; ?></td>
												</tr>
												<tr>
													<td class="span2">Data do Pagamento:</td>
													<td><?php echo date_format($dataPagamento, "j F, Y"); ?></td>
												</tr>
												<tr>
													<td class="span2">ID da Conta:</td>
													<td><?php echo $idConta; ?></td>
												</tr>

											</tbody>
										</table>
										<a href="index.php?topicos=pages/payment/cancelar&id=<?php echo $pega_id ;?>">
											<button class="btn btn-danger"><i class="icon-pencil icon-white"></i> Cancelar pagamento</button> 
										</a>  
										<a href="index.php?topicos=pages/payment/listar&id=<?php echo $pega_id ;?>">
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
