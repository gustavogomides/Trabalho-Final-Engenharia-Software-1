	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                	
	                    $pega_saldo = mysqli_query($mysqli, "SELECT counter, balance, lastUpdate
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
	                        }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Relatório Saldo</h3>
						</div>
					</div>
					<?php 
						echo "Relatório gerado em $data às $hora";
						
					?>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<!-- <h4><i class="icon-flag"></i>Informações do saldo</h4> -->
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<div class="span6">
										<table class="table table-borderless">
											<tbody>
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

