<section class="mt-4">
  <div class="card mx-auto" style="max-width: 600px;">
    <div class="card-body">
      <h3 class="card-title mb-4 text-center">Formulario de Registro</h3>
      <form>
        <div class="row mb-3">
          <div class="col">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" required>
          </div>
          <div class="col">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="cedula" class="form-label">Cédula</label>
          <input type="text" class="form-control" id="cedula" required>
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo electrónico</label>
          <input type="email" class="form-control" id="correo" required>
        </div>

        <div class="row mb-3">
          <div class="col">
            <label for="provincia" class="form-label">Provincia</label>
            <input type="text" class="form-control" id="provincia" required>
          </div>
          <div class="col">
            <label for="canton" class="form-label">Cantón</label>
            <input type="text" class="form-control" id="canton" required>
          </div>
          <div class="col">
            <label for="distrito" class="form-label">Distrito</label>
            <input type="text" class="form-control" id="distrito" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="telefono" class="form-label">Número de celular</label>
          <input type="tel" class="form-control" id="telefono" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-success">Registrarse</button>
        </div>
      </form>
    </div>
  </div>
</section>
