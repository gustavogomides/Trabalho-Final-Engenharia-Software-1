	        <?php
	            if(isset($_GET['id']) && $_GET['id'] != ''){

	                $pega_id = $_GET['id'];

	                if(is_numeric($pega_id)){
	                    $pega_DOC = mysqli_query($mysqli, "SELECT value, dateTransfer, idAccount, bank, accountDestin
	                                                            FROM transference
	                                                            WHERE idTransference = '$pega_id'
	                                                            LIMIT 1")
	                                   							or die(mysqli_error($mysqli));
						if(@mysqli_num_rows($pega_DOC) <= '0'){

	                    }else{
	                        while ($res_listar = mysqli_fetch_array($pega_DOC)) {
	                            $valor = $res_listar[0];
                                $dataTED = new DateTime($res_listar[1]);		
                                $remetente = $res_listar[2];
                                $banco = $res_listar[3];
                                $destinatario = $res_listar[4];
	                        }
	                    }
	                }
	            }

	        ?>
			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Visualizar DOC</h3>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-title">
									<h4><i class="icon-flag"></i>Informações do DOC</h4>
									<span class="tools"><a href="javascript:;" class="icon-chevron-down"></a></span>
								</div>
								<div class="widget-body">
									<?php

								        if(isset($_GET['action']) && $_GET['action'] == 'deletar'){
								            	
								            $deletar = mysqli_query($mysqli,"DELETE FROM transference
							                                                   WHERE idTransference = '$pega_id'
							                                                   LIMIT 1")
							                                        or die(mysql_error($mysqli));
												
											if($deletar == '1'){
												echo '<div class="alert alert-success">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Sucesso!</strong> DOC deletado com sucesso! 
														Você será redirecionado em 3 segundos! 
													</div>';

												echo '<script>setTimeout(function () {
														window.location.href= "index.php?topicos=pages/transference/doc/listarDOC";
														},3000);
													</script>';
											}else{
												echo '<div class="alert alert-error">
														<button class="close" data-dismiss="alert">×</button>
														<strong>Erro!</strong>ao deletar DOC!
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
													<td class="span2">Data do DOC:</td>
													<td><?php echo date_format($dataTED, "j F, Y"); ?></td>
												</tr>
												<tr>
													<td class="span2">ID Conta Remetente:</td>
													<td><?php echo $remetente; ?></td>
												</tr>
												<tr>
													<td class="span2">Banco de Destino:</td>
													<td><?php echo $banco; ?></td>
												</tr>
												<tr>
													<td class="span2">ID Conta Destinatário:</td>
													<td><?php echo $destinatario; ?></td>
												</tr>

											</tbody>
										</table>
										<a href="index.php?topicos=pages/transference/doc/cancelar&id=<?php echo $pega_id ;?>">
											<button class="btn btn-danger"><i class="icon-pencil icon-white"></i> Cancelar DOC</button> 
										</a>  
										<a href="index.php?topicos=pages/transference/doc/listarDOC">
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
