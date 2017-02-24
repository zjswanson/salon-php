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
        Client::deleteAll();
    }
    function test_getters()
    {
        // Arrange
        $id = 1;
        $stylist_id = 2;
        $client_name = 'Mr. Dude';
        $next_appointment = "2017-02-24 15:00:00";
        $test_client = new Client ($client_name,$next_appointment,$stylist_id,$id);
        // Act
        $result = array($test_client->getClientName(), $test_client->getNextAppointment(),$test_client->getStylistId(), $test_client->getId());
        $expected_result = array($client_name,$next_appointment,$stylist_id,$id);
        // Assert
        $this->assertEquals($result, $expected_result);
    }
    function test_setters()
    {
        // Arrange
        $id = 1;
        $stylist_id = 2;
        $client_name = 'Mr. Dude';
        $next_appointment = "2017-02-24 15:00:00";
        $test_client = new Client ($client_name,$next_appointment,$stylist_id,$id);
        $client_name2 = 'El Duderino';
        $next_appointment2 = "2017-02-24 17:00:00";
        $test_client->setClientName($client_name2);
        $test_client->setNextAppointment($next_appointment2);
        // Act
        $result = array($test_client->getClientName(), $test_client->getNextAppointment(),$test_client->getStylistId(), $test_client->getId());
        $expected_result = array($client_name2,$next_appointment2,$stylist_id,$id);
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
        $stylist_id = $test_stylist->getId();
        $client_name = 'Mr. Dude';
        $next_appointment = "2017-02-24 15:00:00";
        $test_client = new Client ($client_name,$next_appointment,$stylist_id);
        $test_client->save();
        // Act
        $result = Client::getAll();
        // Assert
        $this->assertEquals($result[0], $test_client);
    }

    function test_getAll()
    {
        // Arrange
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();
        $client_name = 'Mr. Dude';
        $next_appointment = "2017-02-24 15:00:00";
        $test_client = new Client ($client_name,$next_appointment,$stylist_id);
        $test_client->save();
        $client_name2 = 'El Duderino';
        $next_appointment2 = "2017-02-24 17:00:00";
        $test_client2 = new Client ($client_name2,$next_appointment2,$stylist_id);
        $test_client2->save();
        // Act
        $result = Client::getAll();
        // Assert
        $this->assertEquals($result, [$test_client,$test_client2]);
    }






}
?>
