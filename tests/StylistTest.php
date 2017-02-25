<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_getId()
        {
            // Arrange
            $id = 1;
            $name = "test1";
            $test_stylist = new Stylist($name, $id);

            // Act
            $result = $test_stylist->getId();

            // Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);

            // Act
            $result = $test_stylist->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);
            $new_name = "test1 rename";

            // Act
            $test_stylist->setName($new_name);
            $result = $test_stylist->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_save()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);


            // Act
            $test_stylist->save();
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "test2";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            // Act
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "test2";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            // Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "test2";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            // Act
            $result = Stylist::find($test_stylist->getId());

            // Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $new_name = "test1 update";

            // Act
            $test_stylist->update($new_name);
            $result = $test_stylist->getName();

            // Assert
            $this->assertEquals("test1 update", $result);
        }

        function testDelete()
        {
            // Arrange
            $name = "test1";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "test2";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            // Act
            $test_stylist->delete();
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals([$test_stylist2], $result);
        }

        function testGetClients()
        {
            //Arrange
            $stylist_name = "test stylist 1";
            $stylist_id = null;
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = "test client 1";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client2_name = "test client 2";
            $test_client2 = new Client($client2_name, $stylist_id);
            $test_client2->save();

            $stylist2_name = "test stylist 2";
            $stylist2_id = null;
            $test_stylist2 = new Stylist($stylist2_name);
            $test_stylist2->save();

            $client3_name = "test client 3";
            $stylist2_id = $test_stylist2->getId();
            $test_client3 = new Client($client3_name, $stylist2_id);
            $test_client3->save();

            $client4_name = "test client 4";
            $test_client4 = new Client($client4_name, $stylist2_id);
            $test_client4->save();

            //Act
            $result = $test_stylist->getClients();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

    }
?>
