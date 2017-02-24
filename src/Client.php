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

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }
    }
?>
