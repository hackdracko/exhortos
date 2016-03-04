<?php



class Solicitud {

    private $_fachada;
    private $_metodo;
    private $_argumentos;

    public function __construct() {
        
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            
            $url = explode('/', $url);
            $url = array_filter($url);

            $this->_fachada = strtolower(array_shift($url));
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
        }

        if (!$this->_fachada) {
            $this->_fachada = "index";
        }

        if (!$this->_metodo) {
            $this->_metodo = "index";
        }

        if (!isset($this->_argumentos)) {
            $this->_argumentos = array();
        }
    }

    public function getFachada() {
        return $this->_fachada;
    }

    public function getMetodo() {
        return $this->_metodo;
    }

    public function getArgumentos() {
        return $this->_argumentos;
    }

}

?>
