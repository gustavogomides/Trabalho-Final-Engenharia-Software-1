			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Lista de Compras</h3>
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
												<th class="hidden-phone">Valor</th>
												<th class="hidden-phone">Descrição</th>
												<th class="hidden-phone">Data do Compra</th>
												<th class="hidden-phone">ID da Conta</th>
											</tr>
										</thead>
										<tbody>
											<?php

				                                $listar = mysqli_query($mysqli, "SELECT idBuy, value, transaction, buyDate, idCard
				                                                                        FROM buy
				                                                                        ORDER BY idBuy ASC")
				                                										or die(mysqli_error($mysqli));

        									    if(@mysqli_num_rows($listar) <= '0'){
				                                     
				                                }else{
				                                    while($res_listar = mysqli_fetch_array($listar)){
				                                        $id = $res_listar[0];
				                                        $valor = $res_listar[1];
				                                        $descricao = $res_listar[2];
				                                        $compra = new DateTime($res_listar[3]);
				                                        $contaID = $res_listar[4];
				                                        
				                            ?>
											
											<tr class="odd gradeX">
												<td><?php echo $id; ?></td>
												<td class="hidden-phone"><?php echo "R$ $valor"; ?></td>
												<td class="hidden-phone"><?php echo $descricao; ?></td>
												<td class="hidden-phone"><?php echo date_format($compra, "j F, Y"); ?></td>
												<td class="hidden-phone"><?php echo $contaID; ?></td>
												<td class="hidden-phone">
													<a href="index.php?topicos=pages/buy/visualizar&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Visualizar Compra
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