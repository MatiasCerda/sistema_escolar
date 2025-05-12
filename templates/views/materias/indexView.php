<?php require_once INCLUDES.'inc_header.php'; ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
	  <h6 class="m-0 font-weight-bold text-primary"><?php echo $d->title; ?></h6>
  </div>
  <div class="card-body">
		<?php if (!empty($d->materias->rows)): ?>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>Nombre</th>
							<th width="10%">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($d->materias->rows as $m): ?>
							<tr>
								<td><?php echo sprintf('<a href="materias/ver/%s">%s</a>', $m->id, $m->id); ?></td>
								<td><?php echo add_ellipsis($m->nombre, 50); ?></td>
								<td>
									<div class="btn-group">
										<a href="<?php echo 'materias/ver/'.$m->id; ?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
										<a href="<?php echo buildURL('materias/borrar/'.$m->id); ?>" class="btn btn-sm btn-danger confirmar"><i class="fas fa-trash"></i></a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<?php echo $d->materias->pagination; ?>
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