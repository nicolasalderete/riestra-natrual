<?php 
    class Carrito {

        public $items;

        function __construct() {
            $this->items = array();
          }
    
        function add_item($item) {
            array_push($this->items, $item);
        }

        function get_cant_items() {
            return count($this->items);
        }
    }


?>