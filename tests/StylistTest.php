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
class StylistTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Stylist::deleteAll();
        Client::deleteAll();
    }
    function test_getters()
    {
        // Arrange
        $id = 1;
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty,$id);
        // Act
        $result = array($test_stylist->getStylistName(), $test_stylist->getSpecialty(), $test_stylist->getId());
        $expected_result = array($stylist_name,$specialty,$id);
        // Assert
        $this->assertEquals($result, $expected_result);
    }
    function test_setters()
    {
        // Arrange
        $id = 1;
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty,$id);
        $stylist_name2 = 'Phillipe';
        $specialty2 = "Wavy Mess";
        $test_stylist->setStylistName($stylist_name2);
        $test_stylist->setSpecialty($specialty2);
        // Act
        $result = array($test_stylist->getStylistName(), $test_stylist->getSpecialty());
        $expected_result = array($stylist_name2,$specialty2);
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function test_Save()
    {
        // Arrange
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        // Act
        $result = Stylist::getAll();
        // Assert
        $this->assertEquals($result[0], $test_stylist);
    }

    function test_getAll()
    {
        // Arrange
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        $stylist_name2 = 'Phillipe';
        $specialty2 = "Wavy Mess";
        $test_stylist2 = new Stylist ($stylist_name2,$specialty2);
        $test_stylist2->save();
        // Act
        $result = Stylist::getAll();
        // Assert
        $this->assertEquals($result, [$test_stylist,$test_stylist2]);
    }

    function test_find()
    {
        // Arrange
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        $stylist_name2 = 'Phillipe';
        $specialty2 = "Wavy Mess";
        $test_stylist2 = new Stylist ($stylist_name2,$specialty2);
        $test_stylist2->save();
        // Act
        $result = Stylist::find($test_stylist->getId());
        // Assert
        $this->assertEquals($result, $test_stylist);
    }

    function test_delete()
    {
        // Arrange
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        $stylist_name2 = 'Phillipe';
        $specialty2 = "Wavy Mess";
        $test_stylist2 = new Stylist ($stylist_name2,$specialty2);
        $test_stylist2->save();
        // Act
        $test_stylist->delete();
        $result = Stylist::getAll();
        // Assert
        $this->assertEquals($result[0], $test_stylist2);
    }

    function test_update()
    {
        // Arrange
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        $id = $test_stylist->getId();
        $stylist_name2 = 'Phillipe';
        $specialty2 = "Wavy Mess";
        $test_stylist->update("stylist_name",$stylist_name2);
        $test_stylist->update("specialty",$specialty2);
        // Act
        $result_stylist= Stylist::getAll();
        $result = array($result_stylist[0]->getStylistName(), $result_stylist[0]->getSpecialty(), $result_stylist[0]->getId());
        $expected_result = array($stylist_name2,$specialty2,$id);
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function test_getClients()
    {
        // Arrange
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();
        $stylist_name2 = 'Phillipe';
        $specialty2 = "Wavy Mess";
        $test_stylist2 = new Stylist ($stylist_name2,$specialty2);
        $test_stylist2->save();
        $stylist_id2 = $test_stylist->getId();
        $client_name = 'Mr. Dude';
        $next_appointment = "2017-02-24 15:00:00";
        $test_client = new Client ($client_name,$next_appointment,$stylist_id);
        $test_client->save();
        $client_name2 = 'El Duderino';
        $next_appointment2 = "2017-02-24 17:00:00";
        $test_client2 = new Client ($client_name2,$next_appointment2,$stylist_id2);
        $test_client2->save();
        $client_name3 = 'Monsieur Fancee';
        $next_appointment3 = "2017-02-24 19:00:00";
        $test_client3 = new Client ($client_name3,$next_appointment3,$stylist_id);
        $test_client2->save();
        // Act
        $result = $test_stylist->findClients();
        // Assert
        $this->assertEquals($result, [$test_client1,$test_client3]);
    }



}
?>
