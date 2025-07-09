<?php
if (!isset($_SESSION['usuario'])) {
  echo "<div class='alert alert-danger'>Iniciá sesión para ver tus donaciones.</div>";
  return;
}

$misDonaciones = $_SESSION['donaciones'] ?? [];
$cedula = $_SESSION['usuario']['cedula'];

$filtradas = array_filter($misDonaciones, fn($d) => $d['cedula'] === $cedula);
?>

<section class="container mt-4">
  <h2>Mis Donaciones</h2>
  <?php if (empty($filtradas)): ?>
    <p>No has realizado donaciones aún.</p>
  <?php else: ?>
    <ul class="list-group">
      <?php foreach ($filtradas as $d): ?>
        <li class="list-group-item">
          <strong><?php echo $d['alimento']; ?></strong> - <?php echo $d['cantidad']; ?> unidades (<?php echo $d['estado']; ?>) en <?php echo $d['provincia'] . ', ' . $d['canton']; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>
