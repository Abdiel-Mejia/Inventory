<?php
include 'db.php';
include 'functions/helpers.php';
include 'templates/header.php';

// Capturar filtros de forma segura
$orden = isset($_GET['orden']) ? sanitize($_GET['orden']) : '';
$gender = isset($_GET['gender']) ? sanitize($_GET['gender']) : 'todos';

// Construir SQL
$sql = "SELECT description, price, date_created, name_image, gender FROM sneakers WHERE 1=1";
$params = [];

if ($gender != 'todos') {
    $sql .= " AND gender = ?";
    $params[] = $gender;
}

switch ($orden) {
    case 'price_asc': $sql .= " ORDER BY price ASC"; break;
    case 'price_desc': $sql .= " ORDER BY price DESC"; break;
    case 'fecha_asc': $sql .= " ORDER BY date_created ASC"; break;
    case 'fecha_desc': $sql .= " ORDER BY date_created DESC"; break;
}

// Prepared statement
$stmt = $conn->prepare($sql);
if(count($params) > 0){
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Formulario de filtros -->
<form method="get" class="adj">
    <label for="orden" class="nombre">Ordenar por:</label>
    <select name="orden" id="orden" class="boton">
        <option value="price_asc" <?= $orden=='price_asc'?'selected':'' ?>>De menor a mayor</option>
        <option value="price_desc" <?= $orden=='price_desc'?'selected':'' ?>>De mayor a menor</option>
        <option value="fecha_asc" <?= $orden=='fecha_asc'?'selected':'' ?>>Antiguos</option>
        <option value="fecha_desc" <?= $orden=='fecha_desc'?'selected':'' ?>>Nuevos</option>
    </select>

    <label for="gender" class="nombre">Género:</label>
    <select name="gender" id="gender" class="boton">
        <option value="todos" <?= $gender=='todos'?'selected':'' ?>>Todos</option>
        <option value="Hombre" <?= $gender=='Hombre'?'selected':'' ?>>Para caballero</option>
        <option value="Mujer" <?= $gender=='Mujer'?'selected':'' ?>>Para dama</option>
        <option value="Unisex" <?= $gender=='Unisex'?'selected':'' ?>>Unisex</option>
    </select>

    <input class="bt" type="submit" name="consultar" value="Buscar">
</form>

<!-- Tabla de resultados -->
<?php if($result->num_rows > 0): ?>
<table>
<tr>
    <th>Sneakers</th>
    <th>Descripción</th>
    <th>Género</th>
    <th>Precio</th>
    <th>Fecha de Creación</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><img src="assets/img/<?= $row['name_image'] ?>" alt="<?= $row['description'] ?>" class="img-producto"></td>
    <td><?= $row['description'] ?></td>
    <td><?= $row['gender'] ?></td>
    <td>$<?= formatPrice($row['price']) ?></td>
    <td><?= $row['date_created'] ?></td>
</tr>
<?php endwhile; ?>
</table>
<?php else: ?>
<p>No se encontraron resultados.</p>
<?php endif; ?>

<?php
$stmt->close();
$conn->close();
include 'templates/footer.php';
?>
