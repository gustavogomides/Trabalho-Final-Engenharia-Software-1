	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_fatura = mysqli_query($mysqli, "SELECT creationDate, period, idCard, totalValue
	                                                            FROM invoice
	                                                            WHERE idInvoice = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_fatura) <= '0'){

	                    }else{
	                        while ($res_pega_fatura = mysqli_fetch_array($pega_fatura)) {
	                            $criacao = new DateTime($res_pega_fatura[0]);
                                $fim = new DateTime($res_pega_fatura[1]);
                                $idCartao = $res_pega_fatura[2];
                                $valor = $res_pega_fatura[3];

                                $pega_cartao = mysqli_query($mysqli, "SELECT numberCard
	                                   							FROM card
	                                   							WHERE idCard = '$idCartao'")
	                                   							or die(mysqli_error($mysqli));
               					$re = mysqli_fetch_array($pega_cartao);
               					$numCartao = $re[0];


                                $pega_id = mysqli_query($mysqli, "SELECT idAccount
               							FROM card
               							WHERE idCard = '$idCartao'")
               							or die(mysqli_error($mysqli));
               					$resultado = mysqli_fetch_array($pega_id);
               					$idConta = $resultado[0];

								
								$pega_id_cliente = mysqli_query($mysqli, "SELECT idCustomer
               							FROM account
               							WHERE idAccount = '$idConta'")
               							or die(mysqli_error($mysqli));
               					$resul = mysqli_fetch_array($pega_id_cliente);
               					$idCliente = $resul[0];


               					$pega_nome = mysqli_query($mysqli, "SELECT name
               							FROM customer
               							WHERE idCustomer = '$idCliente'")
               							or die(mysqli_error($mysqli));
               					$res = mysqli_fetch_array($pega_nome);
               					$nome = $res[0];	
   							 }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Visualizar Fatura</h3>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<h4><i class="icon-flag"></i>Informações da Fatura</h4>
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<?php

								        if(isset($_GET['action']) && $_GET['action'] == 'deletar'){
								            	
								            $deletar = mysqli_query($mysqli,"DELETE FROM invoice
							                                                   WHERE idInvoice = '$pega_id'
							                                                   LIMIT 1")
							                                        or die(mysql_error($mysqli));

							                                    
												
											if($deletar == '1'){
												echo '<div class="alert alert-success">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Sucesso!</strong> Fatura deletada com sucesso! 
														Você será redirecionado em 3 segundos! 
													</div>';

												echo '<script>setTimeout(function () {
														window.location.href= "index.php?topicos=pages/invoice/gerarFatura";
														},3000);
													</script>';
											}else{
												echo '<div class="alert alert-error">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Erro!</strong>ao deletar Fatura!
													</div>';
											}
								        }

								       

				                    ?>

									<div class="span6">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<td class="span2">Data de Criação:</td>
													<td><?php echo date_format($criacao, "j F, Y"); ?></td>
												</tr>
												<tr>
													<td class="span2">Data Final:</td>
													<td><?php echo date_format($fim, "j F, Y"); ?></td>
												</tr>
												<tr>
													<td class="span2">Nome do Cliente:</td>
													<td><?php echo $nome; ?></td>
												</tr>
												<tr>
													<td class="span2">ID do Cartão:</td>
													<td><?php echo $idCartao; ?></td>
												</tr>
												<tr>
													<td class="span2">Número do Cartão:</td>
													<td><?php echo $numCartao; ?></td>
												</tr>
												<tr>
													<td class="span2">Valor Total:</td>
													<td><?php echo "R$ $valor"; ?></td>
												</tr> 



											</tbody>
										</table>
										</div>

										<div class="span6">

										<h4><i class="icon-flag"></i>Compras</h4>
											<table class="table table-striped table-bordered " id="sample_1">
												<thead>
													<tr>
														<th>ID da Compra</th>
														<th class="hidden-phone">Valor da Compra</th>
														<th class="hidden-phone">Descrição da Compra</th>
														<th class="hidden-phone">Data da Compra</th>
													</tr>
												</thead>
												<tbody>
													<?php

						                                $listar = mysqli_query($mysqli, "SELECT idBuy, transaction, buyDate, value
		                                                                        FROM buy
		                                                                        WHERE idCard = '$idCartao'
		                                                                        ORDER BY buyDate")
		                                										or die(mysqli_error($mysqli));

		        									    if(@mysqli_num_rows($listar) <= '0'){
						                                     
						                                }else{
						                                    while($res_listar = mysqli_fetch_array($listar)){
						                                        $idBuy = $res_listar[0];
						                                        $descricao = $res_listar[1];
						                                        $compra = new DateTime($res_listar[2]);
						                                        $valorCompra = $res_listar[3];	
						                            ?>
													
													<tr class="odd gradeX">
														<td><?php echo $idBuy; ?></td>
														<td class="hidden-phone"><?php echo "R$ $valorCompra"; ?></td>
														<td class="hidden-phone"><?php echo $descricao; ?></td>
														<td class="hidden-phone"><?php echo date_format($compra, "j F, Y"); ?></td>
													</tr>

													<?php
		                                    				}
		                                				}
		                            				?>
											</tbody>
									</table>
									<a href="index.php?topicos=pages/invoice/cancelar&id=<?php echo $pega_id ;?>">
										<button class="btn btn-danger"><i class="icon-pencil icon-white"></i> Cancelar Fatura</button> 
									</a>  
									<a href="index.php?topicos=pages/invoice/gerarFatura&id=<?php echo $pega_id ;?>">
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



									
									