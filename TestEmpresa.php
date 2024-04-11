<?php 

include_once "Cliente.php";
include_once "Moto.php";
include_once "Venta.php";
include_once "Empresa.php";

// Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2
$objCliente = new Cliente("Yael","Machaique","baja","DNI",44481078);
$objCliente2 = new Cliente("Luciana","Lopez","alta","DNI",36784269);

// Cree 3 objetos Motos con la información visualizada en la tabla: código, costo, año fabricación,
// descripción, porcentaje incremento anual, activo.
$objMoto = new Moto(11,2230000,2022,"Benelli Imperiale 400",85,true);
$objMoto2 = new Moto(12,584000,2021,"Zanella Zr 150 Ohc",70,true);
$objMoto3 = new Moto(13,999900,2023,"Zanella Patagonian Eagle 250",55,false);

// Se crea un objeto Empresa con la siguiente información: denominación =” Alta Gama”, dirección= “Av
// Argenetina 123”, colección de motos= [$obMoto1, $obMoto2, $obMoto3] , colección de clientes =
// [$objCliente1, $objCliente2 ], la colección de ventas realizadas=[]


$colClientes = [$objCliente,$objCliente2];
$colMotos = [$objMoto,$objMoto2,$objMoto3];
$objEmpresa = new Empresa("Alta Gama","Av Argentina 123",$colClientes,$colMotos,[]);

// Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el
// $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
// punto 1) y la colección de códigos de motos es la siguiente [11,12,13]. Visualizar el resultado obtenido
$colCodigos = [11,12,13];
// Realizar un echo de la variable Empresa creada en 2
echo $objEmpresa->registrarVenta($colCodigos,$objCliente2);

// Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
// $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
// punto 1) y la colección de códigos de motos es la siguiente [0]. Visualizar el resultado obtenido
$colCodigos2 = [0];
$objEmpresa->registrarVenta($colCodigos2,$objCliente2);

// Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
// $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
// punto 1) y la colección de códigos de motos es la siguiente [2]. Visualizar el resultado obtenido

$colCodigos3 = [2];
$objEmpresa->registrarVenta($colCodigos3,$objCliente2);




 $arreglo = $objEmpresa->retornarVentasXCliente("DNI",44481078);
// print_r($arreglo);
for ($i=0; $i < count($arreglo); $i++) { 
    echo $arreglo[$i]."\n";
}

$arreglo2 = $objEmpresa->retornarVentasXCliente("DNI",36784269);
for ($i=0; $i < count($arreglo2); $i++) { 
    echo $arreglo2[$i]."\n";
}

