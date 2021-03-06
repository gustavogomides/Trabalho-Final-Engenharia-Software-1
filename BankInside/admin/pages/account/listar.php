			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Lista de Contas</h3>
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
												<th class="hidden-phone">Tipo</th>
												<th class="hidden-phone">Saldo</th>
												<th class="hidden-phone">Data de Criação</th>
												<th class="hidden-phone">ID do Cliente</th>
											</tr>
										</thead>
										<tbody>
											<?php

				                                $listar = mysqli_query($mysqli, "SELECT idAccount, type, balance, creationDate, idCustomer
				                                                                        FROM account
				                                                                        ORDER BY idAccount ASC")
				                                or die(mysqli_error($mysqli));

				                                if(@mysqli_num_rows($listar) <= '0'){
				                                     
				                                }else{
				                                    while($res_listar = mysqli_fetch_array($listar)){
				                                        $id = $res_listar[0];
				                                        $tipo = $res_listar[1];
				                                        $saldo = $res_listar[2];		
				                                        $dataCriacao = new DateTime($res_listar[3]);
				                                        $contaID = $res_listar[4];
				                            ?>
											
											<tr class="odd gradeX">
												<td><?php echo $id; ?></td>
												<td class="hidden-phone"><?php echo $tipo; ?></td>
												<td class="hidden-phone"><?php echo "R$ $saldo"; ?></td>
												<td class="hidden-phone"><?php echo date_format($dataCriacao, "j F, Y"); ?></td>
												<td class="hidden-phone"><?php echo $contaID; ?></td>
											<td class="hidden-phone">
													<a href="index.php?topicos=pages/account/visualizar&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Visualizar Conta
														</button>
													</a>
												</td>
											<td class="hidden-phone">
													<a href="index.php?topicos=pages/relatorioSaldo/relatorioIndividual&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Relatório Saldo
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