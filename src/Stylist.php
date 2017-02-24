<?php
    class Stylist
    {
        private $name;
        private $id;

        function __construct($new_name, $id = null)
        {
            $this->name = $new_name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }
    }
?>
