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

        function test_getName()
        {
            // Arrange
            $stylist_name = "test stylist 1";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            // Act
            $result = $test_client->getName();

            // Assert
            $this->assertEquals($client_name, $result);
        }

        function test_getStylistId()
        {
            //Arrange
            $stylist_name = "test stylist 1";
            $stylist_id = null;
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();


            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setName()
        {
            // Arrange
            $stylist_name = "test stylist 1";
            $stylist_id = null;
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $new_name = "test client 1 rename";

            // Act
            $test_client->setName($new_name);
            $result = $test_client->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_save()
        {
            // Arrange
            $stylist_name = "test stylist 1";
            $stylist_id = null;
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            // Act
            // $test_client->save();
            // $result = Client::getAll();

            // Assert
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $stylist_name = "test stylist 1";
            $stylist_id = null;
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            $client2_name = "test client 2";
            $test_client2 = new Client($client2_name, $stylist_id);


            // Act
            // $result = Stylist::getAll();

            // Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $stylist_name = "test stylist 1";
            $stylist_id = null;
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            $client2_name = "test client 2";
            $test_client2 = new Client($client2_name, $stylist_id);

            // Act
            // Client::deleteAll();
            // $result = Client::getAll();

            // Assert
            $this->assertEquals([], $result);
        }


    }
?>
