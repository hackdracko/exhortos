<?php
class exhortoGeneradoCliente{
	
    public function envia($host, $json) {
        ini_set("default_socket_timeout", 30);
        ini_set("soap.wsdl_cache_enabled", "0");
        $exhortosGenerados = new SoapClient( $host );
        $exhortosGenerados = $exhortosGenerados->insertaExhorto($json, '', '');
        if( json_decode($exhortosGenerados) != null ){
            return $exhortosGenerados;
        }else{
            return '';
        }
    }
    public function getOficialias($host) {
        ini_set("default_socket_timeout", 10);
        ini_set("soap.wsdl_cache_enabled", "0");
        try {
            $exhortosGenerados = new SoapClient( $host );
            $Oficialias = $exhortosGenerados->ObtenerOficialias();
            return $Oficialias;
        } catch (Exception $e) {
            return $e;
        }
    }
    public function actualizaExhortoGenerado($host, $json) {
        ini_set("default_socket_timeout", 10);
        ini_set("soap.wsdl_cache_enabled", "0");
        $exhortosGenerados = new SoapClient( $host );
        $exhortosGenerados = $exhortosGenerados->actualizaExhortoGenerado($json, '', '');
        if( json_decode($exhortosGenerados) != null ){
            return $exhortosGenerados;
        }else{
            return '';
        }
    }
}