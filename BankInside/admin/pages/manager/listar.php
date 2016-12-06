			<div id="main-content">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="page-title">Lista de Gerentes</h3>
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
												<th>Nome</th>
												<th class="hidden-phone">ID</th>
												<th class="hidden-phone">Sexo</th>
												<th class="hidden-phone">Endereço</th>
												<th class="hidden-phone">Documento</th>
											</tr>
										</thead>
										<tbody>
											<?php

				                                $listar = mysqli_query($mysqli, "SELECT idManager, name, gender, address, documentID
				                                                                        FROM manager
				                                                                        ORDER BY idManager ASC")
				                                or die(mysqli_error($mysqli));

				                                if(@mysqli_num_rows($listar) <= '0'){
				                                     
				                                }else{
				                                    while($res_listar = mysqli_fetch_array($listar)){
				                                        $id = $res_listar[0];
				                                        $nome = $res_listar[1];
				                                        $sexo = $res_listar[2];
				                                        $endereco = $res_listar[3];
				                                        $documento = $res_listar[4];
				                                        

				                            ?>
											
											<tr class="odd gradeX">
												<td><?php echo $nome; ?></td>
												<td class="hidden-phone"><?php echo $id; ?></td>
												<td class="hidden-phone"><?php echo $sexo; ?></td>
												<td class="hidden-phone"><?php echo $endereco; ?></td>
												<td class="hidden-phone"><?php echo $documento; ?></td>
												<td class="hidden-phone">
													<a href="index.php?topicos=pages/manager/visualizar&id=<?php echo $id; ?>">
														<button class="btn">
															<i class="icon-eye-open"></i> Visualizar Gerente
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