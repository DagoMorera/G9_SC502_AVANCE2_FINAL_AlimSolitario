<section id="donar" class="container mt-4">
  <h2>Donar alimentos</h2>
  <p>Aquí los usuarios podrán publicar donaciones de alimentos disponibles.</p>

  <form>
    <div class="mb-3">
      <label for="alimento" class="form-label">Tipo de alimento</label>
      <input type="text" class="form-control" id="alimento" required>
    </div>
    <div class="mb-3">
      <label for="cantidad" class="form-label">Cantidad</label>
      <input type="number" class="form-control" id="cantidad" required>
    </div>
    <div class="mb-3">
      <label for="estado" class="form-label">Estado del alimento</label>
      <select class="form-select" id="estado" required>
        <option value="">Seleccione...</option>
        <option value="fresco">Fresco</option>
        <option value="cocinado">Cocinado</option>
        <option value="enlatado">Enlatado</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="provincia" class="form-label">Provincia</label>
      <input type="text" class="form-control" id="provincia" required>
    </div>

    <div class="mb-3">
      <label for="canton" class="form-label">Cantón</label>
      <input type="text" class="form-control" id="canton" required>
    </div>

    <button type="submit" class="btn btn-primary">Publicar donación</button>
  </form>
</section>

