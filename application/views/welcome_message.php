<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 60px;
            max-width: 900px;
        }
        h2 {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 30px;
            font-weight: bold;
            color: #007bff;
        }
        .form-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #ff6f61; /* Rosa coral */
            border: none;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            padding: 8px 16px; /* Tamaño reducido */
        }
        .btn-custom:hover {
            background-color: #ff4d4d; /* Rosa más oscuro */
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f1f1f1;
        }
        .btn-warning, .btn-danger, .btn-edit {
            font-weight: bold;
            text-transform: uppercase;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-edit {
            background-color: #28a745; /* Verde */
            border: none;
            color: white;
        }
        .btn-edit:hover {
            background-color: #218838; /* Verde más oscuro */
        }
        .form-section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Título de la página -->
        <div class="row">
            <h2>Registro de Empleados</h2>
        </div>

        <!-- Formulario -->
        <div class="card form-card mb-4">
            <h5 class="card-header">Añadir Persona</h5>
            <?php echo form_open('welcome/agregar', ['id' => 'form-persona']); ?>
                <div class="form-section">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required placeholder="Nombre" id="nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Apellido1">Apellido paterno</label>
                            <input type="text" name="Apellido1" class="form-control" required placeholder="Apellido paterno" id="Apellido1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Apellido2">Apellido materno</label>
                            <input type="text" name="Apellido2" class="form-control" required placeholder="Apellido materno" id="Apellido2">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" required id="fecha_nacimiento">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="genero">Género</label>
                            <select name="genero" class="form-control" required id="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-custom btn-sm">Guardar</button> <!-- Botón más pequeño -->
            <?php echo form_close(); ?>
        </div>

        <!-- Tabla de datos -->
        <div class="card">
            <div class="card-header">
                <h4>Listado de Empleados</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha de nacimiento</th>
                            <th scope="col">Género</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 0;
                            foreach ($personas as $persona) {
                                echo '
                                    <tr>
                                        <td>'.++$count.'</td>
                                        <td>'.$persona->nombre.' '.$persona->Apellido1.' '.$persona->Apellido2.'</td>
                                        <td>'.$persona->fecha_nacimiento.'</td>
                                        <td>'.$persona->genero.'</td>
                                        <td><button type="button" class="btn btn-edit text-white" onclick="llenar_datos('.$persona->id.', `'.$persona->nombre.'`, `'.$persona->Apellido1.'`, `'.$persona->Apellido2.'`, `'.$persona->fecha_nacimiento.'`, `'.$persona->genero.'`)">Actualizar</button></td>
                                        <td><a href="'.base_url('welcome/eliminar/'.$persona->id).'" type="button" class="btn btn-danger">Eliminar</a></td>
                                    </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let url = "<?php echo base_url('welcome/editar'); ?>";
        const llenar_datos = (id, nombre, Apellido1, Apellido2, fecha_nacimiento, genero) => {
            let path = url+"/"+id;
            document.getElementById('form-persona').setAttribute('action', path);
            document.getElementById('nombre').value = nombre;
            document.getElementById('Apellido1').value = Apellido1;
            document.getElementById('Apellido2').value = Apellido2;
            document.getElementById('fecha_nacimiento').value = fecha_nacimiento;
            document.getElementById('genero').value = genero;
        };
    </script>
</body>
</html>
