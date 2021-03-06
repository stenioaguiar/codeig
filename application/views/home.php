<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	</head>
	<body>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3>Cadastro</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<?php if ($this->session->flashdata('error') == TRUE): ?>
							<p><?php echo $this->session->flashdata('error'); ?></p>
						<?php endif; ?>
						<?php if ($this->session->flashdata('success') == TRUE): ?>
							<p><?php echo $this->session->flashdata('success'); ?></p>
						<?php endif; ?>
					
						<form method="post" action="<?=base_url('Salvar')?>" enctype="multipart/form-data">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-sm-2" for="nome">Nome:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="nome" placeholder="Insira o nome" value="<?=set_value('nome')?>" required>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group"></div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-sm-2" for="endereco">Endereço:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="endereco" placeholder="Insira o endereço" value="<?=set_value('endereco')?>" required>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group"></div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-sm-2" for="telefone">Telefone:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="telefone" placeholder="Insira o telefone" value="<?=set_value('endereco')?>" required>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group"></div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-sm-2" for="email">E-mail:</label>
										<div class="col-sm-6">
											<input type="e-mail" class="form-control" id="email" placeholder="Insira o e-mail" value="<?=set_value('email')?>" required>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<BR>
									<label><em>Todos os campos são obrigatórios.</em></label>
									<button type="submit" class="btn btn-primary">Salvar</button>
								</div>
						</form>
						<div class="col-md-8">
							<table class="table table-hover">
								<caption>Contatos</caption>
								<thead>
									<tr>
										<th>Nome</th>
										<th>Endereço</th>
										<th>Telefone</th>
										<th>E-mail</th>
										<th>Operações</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($cliente == FALSE): ?>
										<tr><td colspan="2">Nenhum contato encontrado</td></tr>
									<?php else: ?>
										<?php foreach ($cliente as $row): ?>
											<tr>
												<td><?= $row['nome'] ?></td>
												<td><?= $row['endereco'] ?></td>
												<td><?= $row['telefone'] ?></td>
												<td><?= $row['email'] ?></td>
												<td><a href="<?= $row['editar_url'] ?>">[Editar]</a> <a href="<?= $row['excluir_url'] ?>">[Excluir]</a></td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
							
		</div>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-3.3.1.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	</body>
</html>	