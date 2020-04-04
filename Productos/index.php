<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
    <div class="container">
        <nav class="navbar navbar-light bg-info">
          <a class="navbar-brand text-white" href="index.php">Proyecto Productos con JQuery</a>
        </nav>
        <br>
        <p>
            <button class="btn btn-success" id="btnPanelAgregar">Agregar Producto</button>
        </p>
        <form action="../Conexion/transacciones.php" method="post" id="panelAgregar">
            <input type="hidden" name="accion" value="insertar" />
        <div class ="form-group row">
            <div class="col-md-4">
                <label>Nombre</label>
                <input type="text" class="form-control" id="txtNombre" name="txtNombre"/>
            </div>
            <div class="col-md-4">
                 <label>Proveedor</label>
                 <select name="cmbProveedores" id="cmbProveedores" class ="form-control"></select>
             </div>
             <div class="col-md-4">
                 <label>Stock</label>
                 <input type="number" class="form-control" id="txtStock" name="txtStock"/>
             </div>
        </div>
        </form>
    <div class="form-group row">
        <div class="col-md-12 text-center">
          <input type="submit" value="Guardar Producto" class="btn btn-primary"/>
        </div>
    </div>
    <table class="table table-bordered table-hover" >
        <thead class="thead-dark">
            <tr>
                <td> Id</td>
                <td>Nombre </td>
                <td>Proveedor</td>
                <td>Stock</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody id="DetalleProductos">

        </tbody>
    </table>
    </div>
    <br>

<body>
    <script
    			  src="https://code.jquery.com/jquery-3.4.1.min.js"
    			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    			  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script>
    function getProductos(){
        $.post( "../Conexion/transacciones.php", { accion : 'getProductos'},
        function(data){
            var salida ="";
            $("#DetalleProductos").empty();
            $.each(data, function(i, val){
                salida += "<tr>";
                salida += "<td>"+ val.Id+"</td>";
                salida += "<td>"+ val.NombreProducto+"</td>";
                salida += "<td>"+ val.NombreProveedor+"</td>";
                salida += "<td>"+ val.Stock+"</td>";
                salida += "<td><button class ='btn btn-warning update'>Actualizar</button></td>";
                salida += "<td><button class ='btn btn-danger delete'>Eliminar</button></td>";
                salida += "</tr>";
            });
            $("#DetalleProductos").append(salida);
        });
    }
    function getProveedores(){
            $.post( "../Conexion/transacciones.php", { accion : 'getProveedores'},
            function(data){
                var salida ="";
                $("#cmbProveedores").empty();
                $.each(data, function(i, val){
                    salida += "<option value='" + val.Id + "'>" + val.Nombre+"</option>";

                });
                $("#cmbProveedores").append(salida);
            });
        }
    $(document).ready(function(){
        getProductos();
        getProveedores();
    });
    $("#panelAgregar").submit(function(e){
        e.preventDefault(); //evita cargar la pagina
        alert($("#panelAgregar").serialize());
        //$.post("../Conexion/transacciones.php",{})
    });
</script>
</body>
</html>