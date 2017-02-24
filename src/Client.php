<?php
    class Client
    {
        private $name;
        private $stylist_id;
        private $id;

        function __construct($new_name, $new_stylist_id, $id = null)
        {
            $this->name = $new_name;
            $this->stylist_id = $new_stylist_id;
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

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()});");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }
    }
?>
