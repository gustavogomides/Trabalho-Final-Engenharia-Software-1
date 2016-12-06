	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                	
	                    $pega_saldo = mysqli_query($mysqli, "SELECT counter, balance, lastUpdate, idAccount, idCustomer
	                                                            FROM account
	                                                            WHERE idAccount = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
	                    if(@mysqli_num_rows($pega_saldo) <= '0'){

	                    }else{
	                    	$data = date("d/m/Y");
	                    	$hora = date("h:i:s A");

	                        while ($res_pega_saldo = mysqli_fetch_array($pega_saldo)) {
	                            $contador = $res_pega_saldo[0];
	                            $saldo = $res_pega_saldo[1];
	                            $alteracao = new DateTime($res_pega_saldo[2]);
	                            $idConta = $res_pega_saldo[3];
	                            $IDcliente = $res_pega_saldo[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Extrato</h3>
						</div>
					</div>
					<?php 
						echo "Relatório gerado em $data às $hora";
					?>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<div class="span6">
										<table class="table table-borderless">
											<thead>
												<th><h4>Compras</h4></th>
												<th></th>
                            					<th></th>
                            					<th></th>
											</thead>
											<thead>
												<th>Data</th>
												<th>Transação</th>
												<th>Valor</th>
												<th>Visualizar Transação</th>
											</thead>
											
											<tbody>
											<?php
												// WRONG!!!!!!!!!!!
				                                $listar_compras = mysqli_query($mysqli, "SELECT buyDate, transaction, value FROM buy AS b INNER JOIN card as c ON b.idCard = c.idCard INNER JOIN account AS a ON c.idAccount = a.idAccount WHERE a.idAccount = $idConta
				                                                                        ORDER BY b.buyDate ASC")
				                                										or die(mysqli_error($mysqli));

        									    if(@mysqli_num_rows($listar_compras) <= '0'){
				                                     
				                                }else{
				                                    while($res_listar_compras = mysqli_fetch_array($listar_compras)){
				                                        $compra = new DateTime($res_listar_compras[0]);
				                                        $descricao = $res_listar_compras[1];
				                                        $valor = $res_listar_compras[2];
				                            ?>
											
											<tr class="odd gradeX">
												<td class="hidden-phone"><?php echo date_format($compra, "j F, Y"); ?></td>
												<td class="hidden-phone"><?php echo $descricao; ?></td>
												<td class="hidden-phone"><?php echo "R$ $valor"; ?></td>
												<td class="hidden-phone">
													<a href="index.php?topicos=pages/buy/visualizar&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Visualizar
														</button>
													</a>
												</td>
											</tr>

											<?php
                                    				}
                                				}
                            				?>

                            				<thead>
                            					<th></th>
                            					<th></th>
                            					<th></th>
                            					<th></th>
                            				</thead>

                            					
                            				<thead>
												<th><h4>Pagamentos</h4></th>
												<th></th>
                            					<th></th>
                            					<th></th>
											</thead>
											
											<thead>
												<th>Data</th>
												<th>Número do Documento</th>
												<th>Valor</th>
												<th>Visualizar Transação</th>
											</thead>


											<?php

				                                $listar_pagamentos = mysqli_query($mysqli, "SELECT paymentDate, documentNumber, value
				                                                                        FROM payment
				                                                                        WHERE idAccount = '$idConta'
				                                                                        ORDER BY paymentDate ASC")
				                                										or die(mysqli_error($mysqli));

        									    if(@mysqli_num_rows($listar_pagamentos) <= '0'){
				                                     
				                                }else{
				                                    while($res_listar_pagamentos = mysqli_fetch_array($listar_pagamentos)){
				                                        $pagamento = new DateTime($res_listar_pagamentos[0]);
				                                        $documento = $res_listar_pagamentos[1];
				                                        $valor = $res_listar_pagamentos[2];
				                                        
				                            ?>
											<tr class="odd gradeX">

												<td class="hidden-phone"><?php echo date_format($pagamento, "j F, Y"); ?></td>
												<td class="hidden-phone"><?php echo $documento; ?></td>
												<td class="hidden-phone"><?php echo "R$ $valor"; ?></td>
												<td class="hidden-phone">
													<a href="index.php?topicos=pages/payment/visualizar&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Visualizar
														</button>
													</a>
												</td>
											</tr>

											<?php
                                    				}
                                				}
                            				?>

                            				<thead>
                            					<th></th>
                            					<th></th>
                            					<th></th>
                            					<th></th>
                            				</thead>

                            				<thead>
												<th><h4>Transferências</h4></th>
												<th></th>
                            					<th></th>
                            					<th></th>
											</thead>
                            				<thead>
												<th>Data</th>
												<th>ID da Conta Destinatária</th>
												<th>Valor</th>
												<th>Visualizar Transação</th>
											</thead>

											
											<?php

				                                $listar_transferencias = mysqli_query($mysqli, "SELECT dateTransfer, accountDestin, value 
				                                										FROM transference
				                                										WHERE idAccount = '$idConta' and (type = 'TED' or type = 'DOC')
				                                                                        ORDER BY dateTransfer ASC")
				                                or die(mysqli_error($mysqli));

				                                if(@mysqli_num_rows($listar_transferencias) <= '0'){
				                                     
				                                }else{
				                                    while($res_listar_transferencias = mysqli_fetch_array($listar_transferencias)){
				                                        $data = new DateTime($res_listar_transferencias[0]);	
				                                        $remetente = $res_listar_transferencias[1];	
				                                        $valor = $res_listar_transferencias[2];
				                            ?>
											
											<tr class="odd gradeX">
												<td class="hidden-phone"><?php echo date_format($data, "j F, Y"); ?></td>
												<td class="hidden-phone"><?php echo $remetente; ?></td>
												<td class="hidden-phone"><?php echo "R$ $valor"; ?></td>
												
												
												<td class="hidden-phone">
													<a href="index.php?topicos=pages/transference/ted/visualizar&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Visualizar
														</button>
													</a>
												</td>
												
											</tr>

											<?php
                                    				}
                                				}
                            				?>

                            				<thead>
                            					<th></th>
                            					<th></th>
                            					<th></th>
                            					<th></th>
                            				</thead>
                            					
											<thead>
												<th><h4>Informações Extras do Saldo</h4></th>
												<th></th>
                            					<th></th>
                            					<th></th>
											</thead>
												<tr>
													<td class="span2">Quantidade de Alterações:</td>
													<td><?php echo $contador; ?></td>
												</tr>
												<tr>
													<td class="span2">Saldo:</td>
													<td><?php echo "R$ $saldo"; ?></td>
												</tr>
												<tr>
													<td class="span2">Última Alteração:</td>
													<td><?php echo date_format($alteracao, "j F, Y"); ?></td>
												</tr>
											</tbody>
										</table>
										<a href="index.php?topicos=pages/relatorioExtrato/relatorioGeral&id=<?php echo $pega_id ;?>">
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

