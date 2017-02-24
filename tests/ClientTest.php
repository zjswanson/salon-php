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
    // protected function tearDown()
    // {
    //     Stylist::deleteAll();
    // }
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
    // function test_setters()
    // {
    //     // Arrange
    //     $id = 1;
    //     $client_name = 'Mr. Dude';
    //     $next_appointment = "2017-02-24 15:00:00";
    //     $test_client = new Stylist ($client_name,$next_appointment,$id);
    //     $client_name2 = 'El Duderino';
    //     $next_appointment2 = "2017-02-24 17:00:00";
    //     $test_client->setStylistName($client_name2);
    //     $test_client->setSpecialty($next_appointment2);
    //     // Act
    //     $result = array($test_client->getStylistName(), $test_client->getSpecialty());
    //     $expected_result = array($client_name2,$next_appointment2);
    //     // Assert
    //     $this->assertEquals($result, $expected_result);
    // }





}
?>
