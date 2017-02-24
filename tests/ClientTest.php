<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            // Client::deleteAll();
        }

        function test_getId()
        {
            // Arrange
            $stylist_name = "test stylist 1";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $id = 1;
            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id, $id);

            // Act
            $result = $test_client->getId();

            // Assert
            $this->assertEquals($id, $result);
        }
    }
?>
