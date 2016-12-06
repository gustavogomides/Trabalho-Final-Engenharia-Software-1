			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Fatura do Cartão de Crédito</h3>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<table class="table table-striped table-bordered " id="sample_1">
										<thead>
											<tr>
												<th>ID</th>
												<th class="hidden-phone">Data de Criação</th>
												<th class="hidden-phone">Data Final</th>
												<th class="hidden-phone">Nome do Cliente</th>
												<th class="hidden-phone">ID do Cartão</th>
												<th class="hidden-phone">Número do Cartão</th>
												<th class="hidden-phone">Valor Total</th>
											</tr>
										</thead>
										<tbody>
											<?php

												$dataHora = DATE("Y/m/d");

												$listar = mysqli_query($mysqli, "SELECT idInvoice, creationDate, idCard, totalValue
				                                                                        FROM invoice
				                                                                        ORDER BY idInvoice ASC")
				                                										or die(mysqli_error($mysqli));

        									    if(@mysqli_num_rows($listar) <= '0'){
				                                     
				                                }else{
				                                    while($res_listar = mysqli_fetch_array($listar)){
				                                        $id = $res_listar[0];
				                                        $criacao = new DateTime($res_listar[1]);
				                                        $idCartao = $res_listar[2];
				                                        $valor = $res_listar[3];


				                                        $atualizaData = mysqli_query($mysqli, "UPDATE invoice
				                                                             SET period = '$dataHora'
																			 WHERE idCard = '$idCartao'
				                                                             LIMIT 1")
			                    										or die(mysqli_error($mysqli));

			                    						
				                                        $pega_data = mysqli_query($mysqli, "SELECT period
	                                   							FROM invoice
	                                   							WHERE idCard = '$idCartao'")
	                                   							or die(mysqli_error($mysqli));
	                                   					$result = mysqli_fetch_array($pega_data);
	                                   					$data = new DateTime($result[0]);


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

				                                        
				                            ?>
											
											<tr class="odd gradeX">
												<td><?php echo $id; ?></td>
												<td class="hidden-phone"><?php echo date_format($criacao, "j F, Y"); ?></td>
												<td class="hidden-phone"><?php echo date_format($data, "j F, Y"); ?></td>
												<td class="hidden-phone"><?php echo $nome; ?></td>
												<td class="hidden-phone"><?php echo $idCartao; ?></td>
												<td class="hidden-phone"><?php echo $numCartao; ?></td>
												<td class="hidden-phone"><?php echo "R$ $valor"; ?></td>
												<td class="hidden-phone">
													<a href="index.php?topicos=pages/invoice/visualizar&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Visualizar Fatura
														</button>
													</a>
												</td>
												<td class="hidden-phone">
													<a href="index.php?topicos=pages/invoice/pdf&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Gerar PDF Fatura
														</button>
													</a>
												</td>
											</tr>

											<?php
                                    				}
                                				}
                            				?>
										</tbody>
									</table>
									<div class="form-group"><!-- inicio do grupo-->
										<div class="form-actions">
											<button type="submit" name="senderTime" class="btn btn-primary btn-lg" onclick="window.location='../../../admin/index.php'">Voltar</button>
										</div>
									</div><!-- fim do grupo-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>		