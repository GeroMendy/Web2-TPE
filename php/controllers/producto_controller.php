<?php

    require_once "./models/cervezas_model.php";
    require_once "./models/estilos_model.php";
    require_once "./views/cervezas_view.php";
    require_once "./views/estilos_view.php";

    // Controller para Cervezas y Estilos.

    class producto_controller{

        private $cervezas_model;
        private $estilos_model;

        private $cervezas_view;
        private $estilos_view;

        public function __construct(){

            $this->cervezas_model = new cervezas_model();
            $this->estilos_model = new estilos_model();
            $this->cervezas_view = new cervezas_view();
            $this->estilos_view = new estilos_view();
        }

        // Functions para Cerveza.

        public function getCervezasSortedByEstilo(){
            $list_cervezas = $this->cervezas_model->getCervezasSortedByEstilo();
            $this->cervezas_view->generateTable($list_cervezas);
        }
        public function getCervezas(){
            $list_cervezas = $this->cervezas_model->getCervezas();

            foreach ($list_cerveza as $cerv) {
                $cerv = reemplazarEstilo($cerv);
            }

            $this->cervezas_view->generateTable($list_cervezas);
        }
        public function getCerveza($id_cerveza){
            $cerveza = $this->cerveza_model->getCerveza($id_cerveza);

            $cerveza = reemplazarEstilo($cerveza);

            $this->cervezas_view->displayCerveza($cerveza);
        }

        private function reemplazarEstilo($cerveza){
            $cerveza->$id_estilo = $this->estilos_model->getNombre($cerveza->id_estilo);
            return $cerveza;
        }


        public function addCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol){
            $this->cervezas_model->addCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol);
            $this->getCervezas();
        }
        public function deleteCerveza($id_cerveza){
            $this->cervezas_model->deleteCerveza($id_cerveza);
            $this->getCervezas();
        }
        public function updateCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza){
            $this->cervezas_model->updateCerveza($nombre,$imagen,$id_estilo,$amargor,$alcohol,$id_cerveza);
            $this->getCervezas();
        }

        //Functions para Estilos.
        
        public function getEstilos(){
            $list_estilos = $this->estilos_model->getEstilos();
            $this->estilos_view->generateTable($list_estilos);
        }
        public function getEstilo($id_estilo){
            $this->estilos_model->getEstilo($id_estilo);
            $this->estilos_view->displayEstilo($id_estilo);
        }

    }