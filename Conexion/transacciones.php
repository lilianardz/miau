<?php
if(!isset($_POST["accion"])){
    $respuesta = array("Mensaje" => "Error al invocar las transacciones");
}
else{
    include("../Conexion/cn.php");
    if($_POST["accion"] == "getProductos"){
            $cmd= 'select producto.Id, producto.Nombre as NombreProducto,
            proveedor.Nombre as NombreProveedor, producto.Stock
            from Productos as producto inner join Proveedores
            as proveedor on producto.Id_Proveedor = proveedor.Id';

            $resultado = $conexion->query($cmd);
            $i = 0;
            $productos = array();
            while($row = $resultado->fetch_array(MYSQLI_ASSOC)){
                $productos[$i]=$row;
                $i++;
            }
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($productos);
        }
        else if($_POST["accion"]=="getProveedores"){
            $cmd=" select * from Proveedores";

                        $resultado = $conexion->query($cmd);
                        $i = 0;
                        $proveedores = array();
                        while($row = $resultado->fetch_array(MYSQLI_ASSOC)){
                            $proveedores[$i]=$row;
                            $i++;
                        }
                        header("Content-type: application/json; charset=utf-8");
                        echo json_encode($proveedores);

        }else if($_POST["accion"]=="insertar"){
            $producto=$_POST["txtNombre"];
            $id_proveedor=$_POST["cmbProveedores"];
            $stock = $_POST["txtStock"];
            $cmd = $conexion->prepare("insert into Productos (Nombre, Id_Proveedor, Stock)
            value (?,?,?)"); 
            $cmd->bind_param("sii",$producto,$id_proveedor,$stock);
            $cmd->execute();
            $Mensaje = array("Mensaje" => "El producto ha sido insertado correctamente");
            echo json_encode($Mensaje);
        }
    }
