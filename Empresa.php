<?php 
class Empresa{
    private $denominacion;
    private $direccion;
    private $coleccionClientes;
    private $coleccionMotos;
    private $colVentasRealizadas;

	public function __construct($denominacionV, $direccionV, $colClientesV, $colMotosV, $colVentasV) {

		$this->denominacion = $denominacionV;
		$this->direccion = $direccionV;
		$this->coleccionClientes = $colClientesV;
		$this->coleccionMotos = $colMotosV;
		$this->colVentasRealizadas = $colVentasV;
	}

	public function getDenominacion() {
		return $this->denominacion;
	}

	public function setDenominacion($denominacionV) {
		$this->denominacion = $denominacionV;
	}

	public function getDireccion() {
		return $this->direccion;
	}

	public function setDireccion($direccionV) {
		$this->direccion = $direccionV;
	}

	public function getColeccionClientes() {
		return $this->coleccionClientes;
	}

	public function setColeccionClientes($colClientesV) {
		$this->coleccionClientes = $colClientesV;
	}

	public function getColeccionMotos() {
		return $this->coleccionMotos;
	}

	public function setColeccionMotos($colMotosV) {
		$this->coleccionMotos = $colMotosV;
	}

	public function getColVentasRealizadas() {
		return $this->colVentasRealizadas;
	}

	public function setColVentasRealizadas($colVentasV) {
		$this->colVentasRealizadas = $colVentasV;
	}

	public function retornarMoto($codigoMoto){
		$colMotos = $this->getColeccionMotos();
		$i = 0;
		$encontrado = false;
		$n = count($colMotos);
		while ($i < $n && !$encontrado) {
			$unaMoto = $colMotos[$i];
			if ($codigoMoto == $unaMoto->getCodigo()) {
				$motoCodigo = $colMotos[$i];
				$encontrado = true;
			}
			$i++;
		}
		return $motoCodigo;
	}

	public function registrarVenta($colCodigosMotos,$objCliente){
			
			
			$colMotos = $this->getColeccionMotos();
			$n = count($colMotos);
			$precioTotal = 0;
			$arrayVentasRealizadas = [];
			$contadorVentas = 0;

			for ($i=0; $i< count($colCodigosMotos);$i++) {
				
				$codMoto = $colCodigosMotos[$i];
				
				
				for ($j=0;$j<$n;$j++) {
				
					$unaMoto = $colMotos[$j];
					if ($codMoto == $unaMoto->getCodigo()) {
						

						$precioTotal += $unaMoto->darPrecioVenta();
						if ($precioTotal > -1) {
							$num = ++$contadorVentas;
							$objVenta = new Venta($num,date('Y-m-d'),$objCliente,$colMotos,$precioTotal);
							$this->setColVentasRealizadas($objVenta);
							array_push($arrayVentasRealizadas,$objVenta);


							
						}
						
					}
					
				}
			
			}
			$this->setColVentasRealizadas($arrayVentasRealizadas);
			return $precioTotal;
	}


	public function retornarVentasXCliente($tipo,$numDoc){
		$colVentas= $this->getColVentasRealizadas();
		$colVentasXCliente = [];
		for ($i=0; $i < count($colVentas); $i++) { 
			$venta = $colVentas[$i];
			$cliente = $venta->getCliente();
			if ($cliente->getTipoDocumento() == $tipo && $cliente->getNumeroDocumento() == $numDoc) {
				array_push($colVentasXCliente,$venta);
			}
		}
		return $colVentasXCliente;
	}

	public function recorrerColClientes(){
		$colClientes = $this->getColeccionClientes();
		$cad = "";
		for ($i=0; $i < count($colClientes); $i++) { 
			$cliente = $colClientes[$i];
			$cad .= "Cliente ".($i+1).":".$cliente."\n"; 
		}
		return $cad;
	}
	
	public function recorrerColMotos(){
		$colMotos = $this->getColeccionMotos();
		$cad = "";
		for ($i=0; $i < count($colMotos); $i++) { 
			$moto = $colMotos[$i];
			$cad .= "Moto ".($i+1).":".$moto."\n"; 
		}
		return $cad;
	}
		public function recorrerVentas(){
			$colVentas = $this->getColVentasRealizadas();
			$cad = "";
			for ($i=0; $i < count($colVentas); $i++) { 
				$venta = $colVentas[$i];
				$cad .= "Venta ".($i+1).":".$venta."\n"; 
			}
			return $cad;
		}

		public function __toString(){
			return "\nDenomicacion: ".$this->getDenominacion()."\n".
				"Direccion:".$this->getDireccion()."\n".
				$this->recorrerColClientes()."\n".$this->recorrerColMotos()."\n".
				$this->recorrerVentas();
		}
}