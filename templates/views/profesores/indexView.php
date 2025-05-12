<?php require_once INCLUDES.'inc_header.php'; ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
	  <h6 class="m-0 font-weight-bold text-primary"><?php echo $d->title; ?></h6>
  </div>
  <div class="card-body">
		<?php if (!empty($d->profesores->rows)): ?>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>Nombre completo</th>
							<th>Correo electrónico</th>
							<th>Status</th>
							<th width="10%">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($d->profesores->rows as $p): ?>
							<tr>
								<td><?php echo sprintf('<a href="profesores/ver/%s">%s</a>', $p->numero, $p->numero); ?></td>
								<td><?php echo empty($p->nombre_completo) ? '<span class="text-muted">Sin nombre</span>' : add_ellipsis($p->nombre_completo, 50); ?></td>
								<td><?php echo empty($p->email) ? '<span class="text-muted">Sin correo electrónico</span>' : $p->email; ?></td>
								<td><?php echo format_estado_usuario($p->status); ?></td>
								<td>
									<div class="btn-group">
										<a href="<?php echo 'profesores/ver/'.$p->numero; ?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
										<a href="<?php echo buildURL('profesores/borrar/'.$p->id); ?>" class="btn btn-sm btn-danger confirmar"><i class="fas fa-trash"></i></a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<?php echo $d->profesores->pagination; ?>
			</div>
		<?php else: ?>
			<div class="py-5 text-center">
				<img src="<?php echo IMAGES.'undraw_empty.png'; ?>" alt="No hay registros" style="width: 250px;">
				<p class="text-muted">No hay registros en la base de datos.</p>
			</div>
		<?php endif; ?>
  </div>
</div>
	  
<?php require_once INCLUDES.'inc_footer.php'; ?>