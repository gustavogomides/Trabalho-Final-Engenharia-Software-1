
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Relatório Extrato</h3>
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
												<th class="hidden-phone">ID do Cliente</th>
												<th class="hidden-phone">Nome do Cliente</th>
												<th class="hidden-phone">Saldo</th>												
												<th class="hidden-phone">Quantidade de Alterações</th>
												<th class="hidden-phone">Tipo de Conta</th>
												<th class="hidden-phone">Última Alteração</th>
												<th class="hidden-phone">Visualizar Extrato</th>
											</tr>
										</thead>
										<tbody>
											<?php

				                                $pega_saldo = mysqli_query($mysqli, "SELECT counter, balance, idCustomer, type, lastUpdate, idAccount
	                                                            FROM account
	                                                            ORDER BY idCustomer ASC")
	                                   							or die(mysqli_error($mysqli));
												if(@mysqli_num_rows($pega_saldo) <= '0'){

							                    }else{
							                    	$data = date("d/m/Y");
	                    							$hora = date("h:i:s A");
	                    							
							                        while ($res_pega_saldo = mysqli_fetch_array($pega_saldo)) {
							                            $contador = $res_pega_saldo[0];
							                            $saldo = $res_pega_saldo[1];
							                            $IDcliente = $res_pega_saldo[2];
							                            $conta = $res_pega_saldo[3];
							                            $alteracao = new DateTime($res_pega_saldo[4]);
							                            $idConta = $res_pega_saldo[5];

							                            $pega_nome = mysqli_query($mysqli, "SELECT name
	                                   							FROM customer
	                                   							WHERE idCustomer = '$IDcliente'")
	                                   							or die(mysqli_error($mysqli));
	                                   					$resultado = mysqli_fetch_array($pega_nome);
	                                   					$nome = $resultado[0];


							                ?>
											
											<tr class="odd gradeX">
												<td class="hidden-phone"><?php echo $IDcliente; ?></td>
												<td class="hidden-phone"><?php echo $nome; ?></td>
												<td class="hidden-phone"><?php echo "R$ $saldo"; ?></td>
												<td class="hidden-phone"><?php echo $contador; ?></td>
												<td class="hidden-phone"><?php echo $conta; ?></td>
												<td><?php echo date_format($alteracao, "j F, Y"); ?></td>
												<td>
													<a href="index.php?topicos=pages/relatorioExtrato/relatorioIndividual&id=<?php echo $idConta; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Extrato Detalhado
														</button>
													</a>
												</td>
											</tr>

											<?php

                                    				}
                                				}
                                				echo "Relatório gerado em $data às $hora";
                            				?>
										</tbody>
									</table>

									<table class="table table-striped table-bordered " id="sample_1">
										<thead>
											<tr>
												<th class="hidden-phone">Média de Alterações</th>
												<th class="hidden-phone">Média do Saldo</th>
											</tr>
										</thead>
										<div class="span12">
											<h4 class="page-title">Informações Gerais do Saldo</h4>
										</div>
										<?php 
											
											$pega_S = mysqli_query($mysqli, "SELECT ROUND(AVG(balance),2)
	                                                            FROM account")
	                                   							or die(mysqli_error($mysqli));
	                                   		$resultadoS = mysqli_fetch_array($pega_S);
	                                   		$somaS = $resultadoS[0];	


											$pega_C = mysqli_query($mysqli, "SELECT ROUND(AVG(counter),1)
	                                                            FROM account")
	                                   							or die(mysqli_error($mysqli));
	                                   		$resultadoC = mysqli_fetch_array($pega_C);
	                                   		$somaContador = $resultadoC[0];	
										 ?>
										<tbody>
											<tr class="odd gradeX">
												<td class="hidden-phone"><?php echo "$somaContador alterações"; ?></td>
												<td class="hidden-phone"><?php echo "R$ $somaS"; ?></td>
											</tr>

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



