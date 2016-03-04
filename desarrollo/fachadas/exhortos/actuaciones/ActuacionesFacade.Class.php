<?php
/*
*************************************************
*FRAMEWORK V1.0.0 (http://www.pjedomex.gob.mx)
*Copyright 2009-2015 FACADES
* Licensed under the MIT license 
* Autor: *
* Departamento de Desarrollo de Software
* Subdireccion de Ingenieria de Software
* Direccion de Teclogias de Informacion
* Poder Judicial del Estado de Mexico
*************************************************
*/

session_start();
include_once(dirname(__FILE__)."/../../../modelos/exhortos/dto/actuaciones/ActuacionesDTO.Class.php");
include_once(dirname(__FILE__)."/../../../controladores/exhortos/actuaciones/ActuacionesController.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/connect/Proveedor.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/dtotojson/DtoToJson.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../../tribunal/json/JsonDecod.Class.php");
class ActuacionesFacade {
private $proveedor;
public function __construct() {
}
public function validarActuaciones($ActuacionesDto){
$ActuacionesDto->setidActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getidActuacion(),"utf8"):strtoupper($ActuacionesDto->getidActuacion()))))));
if($this->esFecha($ActuacionesDto->getidActuacion())){
$ActuacionesDto->setidActuacion($this->fechaMysql($ActuacionesDto->getidActuacion()));
}
$ActuacionesDto->setnumActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getnumActuacion(),"utf8"):strtoupper($ActuacionesDto->getnumActuacion()))))));
if($this->esFecha($ActuacionesDto->getnumActuacion())){
$ActuacionesDto->setnumActuacion($this->fechaMysql($ActuacionesDto->getnumActuacion()));
}
$ActuacionesDto->setaniActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getaniActuacion(),"utf8"):strtoupper($ActuacionesDto->getaniActuacion()))))));
if($this->esFecha($ActuacionesDto->getaniActuacion())){
$ActuacionesDto->setaniActuacion($this->fechaMysql($ActuacionesDto->getaniActuacion()));
}
$ActuacionesDto->setcveTipoActuacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcveTipoActuacion(),"utf8"):strtoupper($ActuacionesDto->getcveTipoActuacion()))))));
if($this->esFecha($ActuacionesDto->getcveTipoActuacion())){
$ActuacionesDto->setcveTipoActuacion($this->fechaMysql($ActuacionesDto->getcveTipoActuacion()));
}
$ActuacionesDto->setnumeroExp(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getnumeroExp(),"utf8"):strtoupper($ActuacionesDto->getnumeroExp()))))));
if($this->esFecha($ActuacionesDto->getnumeroExp())){
$ActuacionesDto->setnumeroExp($this->fechaMysql($ActuacionesDto->getnumeroExp()));
}
$ActuacionesDto->setanioExp(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getanioExp(),"utf8"):strtoupper($ActuacionesDto->getanioExp()))))));
if($this->esFecha($ActuacionesDto->getanioExp())){
$ActuacionesDto->setanioExp($this->fechaMysql($ActuacionesDto->getanioExp()));
}
$ActuacionesDto->setcveTipo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcveTipo(),"utf8"):strtoupper($ActuacionesDto->getcveTipo()))))));
if($this->esFecha($ActuacionesDto->getcveTipo())){
$ActuacionesDto->setcveTipo($this->fechaMysql($ActuacionesDto->getcveTipo()));
}
$ActuacionesDto->setcarpetaInv(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcarpetaInv(),"utf8"):strtoupper($ActuacionesDto->getcarpetaInv()))))));
if($this->esFecha($ActuacionesDto->getcarpetaInv())){
$ActuacionesDto->setcarpetaInv($this->fechaMysql($ActuacionesDto->getcarpetaInv()));
}
$ActuacionesDto->setnuc(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getnuc(),"utf8"):strtoupper($ActuacionesDto->getnuc()))))));
if($this->esFecha($ActuacionesDto->getnuc())){
$ActuacionesDto->setnuc($this->fechaMysql($ActuacionesDto->getnuc()));
}
$ActuacionesDto->setcveMateria(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcveMateria(),"utf8"):strtoupper($ActuacionesDto->getcveMateria()))))));
if($this->esFecha($ActuacionesDto->getcveMateria())){
$ActuacionesDto->setcveMateria($this->fechaMysql($ActuacionesDto->getcveMateria()));
}
$ActuacionesDto->setcveCuantia(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcveCuantia(),"utf8"):strtoupper($ActuacionesDto->getcveCuantia()))))));
if($this->esFecha($ActuacionesDto->getcveCuantia())){
$ActuacionesDto->setcveCuantia($this->fechaMysql($ActuacionesDto->getcveCuantia()));
}
$ActuacionesDto->setnoFojas(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getnoFojas(),"utf8"):strtoupper($ActuacionesDto->getnoFojas()))))));
if($this->esFecha($ActuacionesDto->getnoFojas())){
$ActuacionesDto->setnoFojas($this->fechaMysql($ActuacionesDto->getnoFojas()));
}
$ActuacionesDto->setnumOficio(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getnumOficio(),"utf8"):strtoupper($ActuacionesDto->getnumOficio()))))));
if($this->esFecha($ActuacionesDto->getnumOficio())){
$ActuacionesDto->setnumOficio($this->fechaMysql($ActuacionesDto->getnumOficio()));
}
$ActuacionesDto->setcveJuzgado(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcveJuzgado(),"utf8"):strtoupper($ActuacionesDto->getcveJuzgado()))))));
if($this->esFecha($ActuacionesDto->getcveJuzgado())){
$ActuacionesDto->setcveJuzgado($this->fechaMysql($ActuacionesDto->getcveJuzgado()));
}
$ActuacionesDto->setsintesis(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getsintesis(),"utf8"):strtoupper($ActuacionesDto->getsintesis()))))));
if($this->esFecha($ActuacionesDto->getsintesis())){
$ActuacionesDto->setsintesis($this->fechaMysql($ActuacionesDto->getsintesis()));
}
$ActuacionesDto->setobservaciones(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getobservaciones(),"utf8"):strtoupper($ActuacionesDto->getobservaciones()))))));
if($this->esFecha($ActuacionesDto->getobservaciones())){
$ActuacionesDto->setobservaciones($this->fechaMysql($ActuacionesDto->getobservaciones()));
}
$ActuacionesDto->setcveConsignacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcveConsignacion(),"utf8"):strtoupper($ActuacionesDto->getcveConsignacion()))))));
if($this->esFecha($ActuacionesDto->getcveConsignacion())){
$ActuacionesDto->setcveConsignacion($this->fechaMysql($ActuacionesDto->getcveConsignacion()));
}
$ActuacionesDto->setcveJuzgadoDestino(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getcveJuzgadoDestino(),"utf8"):strtoupper($ActuacionesDto->getcveJuzgadoDestino()))))));
if($this->esFecha($ActuacionesDto->getcveJuzgadoDestino())){
$ActuacionesDto->setcveJuzgadoDestino($this->fechaMysql($ActuacionesDto->getcveJuzgadoDestino()));
}
$ActuacionesDto->setjuzgadoDestino(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getjuzgadoDestino(),"utf8"):strtoupper($ActuacionesDto->getjuzgadoDestino()))))));
if($this->esFecha($ActuacionesDto->getjuzgadoDestino())){
$ActuacionesDto->setjuzgadoDestino($this->fechaMysql($ActuacionesDto->getjuzgadoDestino()));
}
$ActuacionesDto->setactivo(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getactivo(),"utf8"):strtoupper($ActuacionesDto->getactivo()))))));
if($this->esFecha($ActuacionesDto->getactivo())){
$ActuacionesDto->setactivo($this->fechaMysql($ActuacionesDto->getactivo()));
}
$ActuacionesDto->setfechaRegistro(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getfechaRegistro(),"utf8"):strtoupper($ActuacionesDto->getfechaRegistro()))))));
if($this->esFecha($ActuacionesDto->getfechaRegistro())){
$ActuacionesDto->setfechaRegistro($this->fechaMysql($ActuacionesDto->getfechaRegistro()));
}
$ActuacionesDto->setfechaActualizacion(strtoupper(str_ireplace("'","",trim(utf8_decode((phpversion()<=5.5) ? mb_strtoupper($ActuacionesDto->getfechaActualizacion(),"utf8"):strtoupper($ActuacionesDto->getfechaActualizacion()))))));
if($this->esFecha($ActuacionesDto->getfechaActualizacion())){
$ActuacionesDto->setfechaActualizacion($this->fechaMysql($ActuacionesDto->getfechaActualizacion()));
}
return $ActuacionesDto;
}
public function selectActuaciones($ActuacionesDto){
$ActuacionesDto=$this->validarActuaciones($ActuacionesDto);
$ActuacionesController = new ActuacionesController();
$ActuacionesDto = $ActuacionesController->selectActuaciones($ActuacionesDto);
if($ActuacionesDto!=""){
$dtoToJson = new DtoToJson($ActuacionesDto);
return $dtoToJson->toJson("RESULTADOS DE LA CONSULTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
}
public function insertActuaciones($ActuacionesDto){
$ActuacionesDto=$this->validarActuaciones($ActuacionesDto);
$ActuacionesController = new ActuacionesController();
$ActuacionesDto = $ActuacionesController->insertActuaciones($ActuacionesDto);
if($ActuacionesDto!=""){
$dtoToJson = new DtoToJson($ActuacionesDto);
return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
}
public function updateActuaciones($ActuacionesDto){
$ActuacionesDto=$this->validarActuaciones($ActuacionesDto);
$ActuacionesController = new ActuacionesController();
$ActuacionesDto = $ActuacionesController->updateActuaciones($ActuacionesDto);
if($ActuacionesDto!=""){
$dtoToJson = new DtoToJson($ActuacionesDto);
return $dtoToJson->toJson("REGISTRO ACTUALIZADO");
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));
}
public function deleteActuaciones($ActuacionesDto){
$ActuacionesDto=$this->validarActuaciones($ActuacionesDto);
$ActuacionesController = new ActuacionesController();
$ActuacionesDto = $ActuacionesController->deleteActuaciones($ActuacionesDto);
if($ActuacionesDto==true){
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"REGISTRO ELIMINADO DE FORMA CORRECTA"));
}
$jsonDto = new Encode_JSON();
return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL LA BAJA"));
}
private function esFecha($fecha) {
if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
return true;
}
return false;
}
private function esFechaMysql($fecha) {
if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $fecha)) {
return true;
}
return false;
}
private function fechaMysql($fecha) {
list($dia, $mes, $year) = explode("/", $fecha);
return $year . "-" . $mes . "-" . $dia;
}
private function fechaNormal($fecha) {
list($dia, $mes, $year) = explode("/", $fecha);
return $year . "-" . $mes . "-" . $dia;
}
// ********************** EXHORTO GENERADO ******************
	public function guardarExhortoGenerado($ActuacionesDto,$param){
		$ActuacionesDto=$this->validarActuaciones($ActuacionesDto);
		$ActuacionesController = new ActuacionesController();
		$ActuacionesDto = $ActuacionesController->guardarExhortoGenerado($ActuacionesDto,$param);
        //print_r('Respuesta nuevo:'.$ActuacionesDto);
        return $ActuacionesDto;
/*		if($ActuacionesDto!=""){
            if(is_array($ActuacionesDto)){
    			$dtoToJson = new DtoToJson($ActuacionesDto);
    			return $dtoToJson->toJson("EXHORTO REGISTRADO CORRECTAMENTE");
            }else{                
        		$jsonDto = new Encode_JSON();
        		return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO."));
            }
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO!"));*/
	}

	public function actualizarExhortoGenerado($ActuacionesDto,$param){
		$ActuacionesDto=$this->validarActuaciones($ActuacionesDto);
		$ActuacionesController = new ActuacionesController();
		$ActuacionesDto = $ActuacionesController->actualizarExhortoGenerado($ActuacionesDto,$param);
        return $ActuacionesDto;
		/*if($ActuacionesDto!=""){
			$dtoToJson = new DtoToJson($ActuacionesDto);
			return $dtoToJson->toJson("EXHORTO ACTUALIZADO CORRECTAMENTE");
		}
		$jsonDto = new Encode_JSON();
		return $jsonDto->encode(array("totalCount"=>"0","text"=>"OCURRIO UN ERROR AL REALIZAR LA ACTUALIZACION"));*/
	}

	public function consultarExhortoGenerado($ActuacionesDto,$param){
		$ActuacionesDto=$this->validarActuaciones($ActuacionesDto);
		$ActuacionesController = new ActuacionesController();
		$ActuacionesDto = $ActuacionesController->consultarExhortoGenerado($ActuacionesDto,$param);
		if($ActuacionesDto!=""){
			return $ActuacionesDto;
		}
		$jsonDto = new Encode_JSON();
		return $jsonDto->encode(array("totalCount"=>"0","text"=>"SIN RESULTADOS A MOSTRAR"));
	}

	public function obtenerOficialias($param){
		$ActuacionesController = new ActuacionesController();
		return $ActuacionesController->obtenerOficialias($param);
	}
// ********************** EXHORTO GENERADO/ ******************
        
//************************** INICIA PROMOCIONES *********************
public function guardarActuacion_Promocion($ActuacionesDto, $listaPromoventes) {
        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesController = new ActuacionesController();
        $ActuacionesDto = $ActuacionesController->guardarActuacion_Promocion($ActuacionesDto, null, $listaPromoventes);
       
        if ($ActuacionesDto != "") {
            $dtoToJson = new DtoToJson($ActuacionesDto);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }                
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }

    public function consultarActuacion_Promocion($ActuacionesDto, $params) {

        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesController = new ActuacionesController();
        $ActuacionesDto = $ActuacionesController->consultarActuacion_Promocion($ActuacionesDto, $params);
        $ActuacionesDto = json_encode($ActuacionesDto);

        return $ActuacionesDto;
    }

    public function eliminarActuacion_Promocion($ActuacionesDto) {

        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesController = new ActuacionesController();
        $ActuacionesDto = $ActuacionesController->eliminarActuacion_Promocion($ActuacionesDto);
        $ActuacionesDto = json_encode($ActuacionesDto);


        return $ActuacionesDto;
    }

    public function actualizarActuacion_Promocion($ActuacionesDto, $listaPromoventes, $param) {
        $ActuacionesDto = $this->validarActuaciones($ActuacionesDto);
        $ActuacionesController = new ActuacionesController();
        $ActuacionesDto = $ActuacionesController->actualizarActuacion_Promocion($ActuacionesDto, "", $listaPromoventes, $param);
        if ($ActuacionesDto != "" && $ActuacionesDto["Estatus"] == "Ok") {
            $dtoToJson = new DtoToJson($ActuacionesDto["ActuacionesDto"]);
            return $dtoToJson->toJson("REGISTRO REALIZADO DE FORMA CORRECTA");
        }
        if ($ActuacionesDto != "" && $ActuacionesDto["Estatus"] == "Error") {
            $jsonDto = new Encode_JSON();
            return $jsonDto->encode(array("totalCount" => "0", "text" => strtoupper($ActuacionesDto["Mensaje"])));
        }
        $jsonDto = new Encode_JSON();
        return $jsonDto->encode(array("totalCount" => "0", "text" => "OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
    }
        //************************** TERMINA PROMOCIONES *********************
}


@$idActuacion=$_POST["idActuacion"];
@$numActuacion=$_POST["numActuacion"];
@$aniActuacion=$_POST["aniActuacion"];
@$cveTipoActuacion=$_POST["cveTipoActuacion"];
@$numeroExp=$_POST["numeroExp"];
@$anioExp=$_POST["anioExp"];
@$cveTipo=$_POST["cveTipo"];
@$carpetaInv=$_POST["carpetaInv"];
@$nuc=$_POST["nuc"];
@$cveMateria=$_POST["cveMateria"];
@$cveCuantia=$_POST["cveCuantia"];
@$idReferencia = $_POST["idReferencia"];
@$noFojas=$_POST["noFojas"];
@$numOficio=$_POST["numOficio"];
@$cveJuzgado=$_POST["cveJuzgado"];
@$sintesis=$_POST["sintesis"];
@$observaciones=$_POST["observaciones"];
@$cveConsignacion=$_POST["cveConsignacion"];
@$cveJuzgadoDestino=$_POST["cveJuzgadoDestino"];
@$juzgadoDestino=$_POST["juzgadoDestino"];
@$activo=$_POST["activo"];
@$fechaRegistro=$_POST["fechaRegistro"];
@$fechaActualizacion=$_POST["fechaActualizacion"];
@$accion=$_POST["accion"];
//parametros adicionales
@$listaPromoventes = $_POST["listaPromoventes"];
@$param["cveEstadoDestino"] = $_POST['cveEstadoDestino'];
@$param["cveOficialia"] = $_POST['cveOficialia'];
@$param["cveJuicio"] = $_POST['cveJuicio'];
@$param["desJuicio"] = $_POST['desJuicio'];
@$param["otroJuicio"] = $_POST['otroJuicio'];
@$param["partes"] = $_POST['partes'];
@$param["fechaInicio"] = $_POST['fechaInicio'];
@$param["fechaFin"] = $_POST['fechaFin'];
@$param["enviarExhorto"] = $_POST['enviarExhorto'];
//$param = array();
@$param["pag"] = $_POST['pag'];
@$param["cantxPag"] = $_POST['cantxPag'];
@$param["paginacion"] = $_POST['paginacion'];
@$param["fechaDesde"] = $_POST['txtFecInicialBusqueda'];
@$param["fechaHasta"] = $_POST['txtFecFinalBusqueda'];
@$param["generico"] = $_POST['generico'];
@$param["asigNumero"] = $_POST['asigNumero'];
//parametros para buscar en -exhorto generado-
@$param["ExhNumero"] = $_POST['ExhNumero'];
@$param["ExhAnio"] = $_POST['ExhAnio'];
$actuacionesFacade = new ActuacionesFacade();
$actuacionesDto = new ActuacionesDTO();

$actuacionesDto->setIdActuacion($idActuacion);
$actuacionesDto->setNumActuacion($numActuacion);
$actuacionesDto->setAniActuacion($aniActuacion);
$actuacionesDto->setCveTipoActuacion($cveTipoActuacion);
$actuacionesDto->setNumeroExp($numeroExp);
$actuacionesDto->setAnioExp($anioExp);
$actuacionesDto->setCveTipo($cveTipo);
$actuacionesDto->setCarpetaInv($carpetaInv);
$actuacionesDto->setNuc($nuc);
$actuacionesDto->setCveMateria($cveMateria);
$actuacionesDto->setCveCuantia($cveCuantia);
$actuacionesDto->setIdReferencia($idReferencia);
$actuacionesDto->setNoFojas($noFojas);
$actuacionesDto->setNumOficio($numOficio);
$actuacionesDto->setCveJuzgado($cveJuzgado);
$actuacionesDto->setSintesis($sintesis);
$actuacionesDto->setObservaciones($observaciones);
$actuacionesDto->setCveConsignacion($cveConsignacion);
$actuacionesDto->setCveJuzgadoDestino($cveJuzgadoDestino);
$actuacionesDto->setJuzgadoDestino($juzgadoDestino);
$actuacionesDto->setActivo($activo);
$actuacionesDto->setFechaRegistro($fechaRegistro);
$actuacionesDto->setFechaActualizacion($fechaActualizacion);

if( ($accion=="guardar") && ($idActuacion=="") ){
$actuacionesDto=$actuacionesFacade->insertActuaciones($actuacionesDto);
echo $actuacionesDto;
} else if(($accion=="guardar") && ($idActuacion!="")){
$actuacionesDto=$actuacionesFacade->updateActuaciones($actuacionesDto);
echo $actuacionesDto;
} else if($accion=="consultar"){
$actuacionesDto=$actuacionesFacade->selectActuaciones($actuacionesDto);
echo $actuacionesDto;
} else if( ($accion=="baja") && ($idActuacion!="") ){
$actuacionesDto=$actuacionesFacade->deleteActuaciones($actuacionesDto);
echo $actuacionesDto;
} else if( ($accion=="seleccionar") && ($idActuacion!="") ){
$actuacionesDto=$actuacionesFacade->selectActuaciones($actuacionesDto);
echo $actuacionesDto;
} else if( $accion=="guardarExhortoGenerado" ){
    $actuacionesDto=$actuacionesFacade->guardarExhortoGenerado($actuacionesDto,$param);
    echo $actuacionesDto;
} else if( $accion == "actualizarExhortoGenerado" ){
    $actuacionesDto=$actuacionesFacade->actualizarExhortoGenerado($actuacionesDto,$param);
    echo $actuacionesDto;
} else if( $accion == "consultarExhortoGenerado" ){
    $actuacionesDto=$actuacionesFacade->consultarExhortoGenerado($actuacionesDto,$param);
    echo $actuacionesDto;
} else if( $accion == "obtenerOficialias"){
    $oficialias = $actuacionesFacade->obtenerOficialias($param);
    echo $oficialias;
} else if ($accion == "guardarActuacion_Promocion") {
    $actuacionesDto = $actuacionesFacade->guardarActuacion_Promocion($actuacionesDto, $listaPromoventes);
    echo $actuacionesDto;
} else if ($accion == "actualizarActuacion_Promocion") {
    //echo"actualizarActuacion_Promocion";
    $actuacionesDto = $actuacionesFacade->actualizarActuacion_Promocion($actuacionesDto, $listaPromoventes, $param);
    echo $actuacionesDto;
} else if ($accion == "consultarActuacion_Promocion") {
    if (isset($_POST["paginacion"])) {
        $param["paginacion"] = true;
    } else {
        $param = null;
    }
    //echo"actualizarActuacion_Promocion";
    $actuacionesDto = $actuacionesFacade->consultarActuacion_Promocion($actuacionesDto, $param);
    echo $actuacionesDto;
} else if ($accion == "eliminarActuacion_Promocion") {
    //echo"actualizarActuacion_Promocion";
    $actuacionesDto = $actuacionesFacade->eliminarActuacion_Promocion($actuacionesDto);
    echo $actuacionesDto;
}
?>