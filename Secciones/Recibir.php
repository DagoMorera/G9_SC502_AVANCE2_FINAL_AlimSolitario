<section id="recibir" class="container mt-4">
  <h2>Recibir alimentos</h2>
  <p>Busca donaciones disponibles por ubicación:</p>

  <form method="GET" action="Paginas.php" class="row g-3 mb-4">
    <input type="hidden" name="seccion" value="recibir" />
    
    <div class="col-md-4">
      <label for="provincia" class="form-label">Provincia</label>
      <input type="text" id="provincia" name="provincia" class="form-control" 
             value="<?php echo isset($_GET['provincia']) ? htmlspecialchars($_GET['provincia']) : ''; ?>" />
    </div>
    
    <div class="col-md-4">
      <label for="canton" class="form-label">Cantón</label>
      <input type="text" id="canton" name="canton" class="form-control"
             value="<?php echo isset($_GET['canton']) ? htmlspecialchars($_GET['canton']) : ''; ?>" />
    </div>

    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-primary w-100">Buscar</button>
    </div>
  </form>

  <?php
  // Datos simulados para donaciones
  $donaciones = [
    ['alimento' => 'Pan fresco', 'cantidad' => '10 unidades', 'provincia' => 'San José', 'canton' => 'Central'],
    ['alimento' => 'Frutas', 'cantidad' => '5 kg', 'provincia' => 'Alajuela', 'canton' => 'Central'],
    ['alimento' => 'Verduras', 'cantidad' => '3 kg', 'provincia' => 'Heredia', 'canton' => 'Barva'],
  ];

  // Obtener filtros del GET
  $filtroProvincia = isset($_GET['provincia']) ? strtolower(trim($_GET['provincia'])) : '';
  $filtroCanton = isset($_GET['canton']) ? strtolower(trim($_GET['canton'])) : '';

  // Filtrar donaciones
  $donacionesFiltradas = array_filter($donaciones, function($d) use ($filtroProvincia, $filtroCanton) {
    $provinciaMatch = $filtroProvincia === '' || strpos(strtolower($d['provincia']), $filtroProvincia) !== false;
    $cantonMatch = $filtroCanton === '' || strpos(strtolower($d['canton']), $filtroCanton) !== false;
    return $provinciaMatch && $cantonMatch;
  });

  if (count($donacionesFiltradas) > 0):
  ?>
    <ul class="list-group">
      <?php foreach ($donacionesFiltradas as $donacion): ?>
        <li class="list-group-item">
          <strong><?php echo htmlspecialchars($donacion['alimento']); ?></strong> - Cantidad: <?php echo htmlspecialchars($donacion['cantidad']); ?> - Ubicación: <?php echo htmlspecialchars($donacion['provincia']); ?>, <?php echo htmlspecialchars($donacion['canton']); ?>
          <button class="btn btn-sm btn-success float-end">Solicitar</button>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>No se encontraron donaciones que coincidan con los filtros.</p>
  <?php endif; ?>
</section>
