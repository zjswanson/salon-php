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
class CuisineTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Stylist::deleteAll();
    }
    function test_getters()
    {
        // Arrange
        $id = 1;
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty,$id);
        // Act
        $result = array($test_stylist->getName(), $test_stylist->getSpecialty(), $test_stylist->getId());
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
        $test_stylist->setName($stylist_name2);
        $test_stylist->setName($specialty2);
        // Act
        $result = array($test_stylist->getName(), $test_stylist->getSpecialty());
        $expected_result = array($stylist_name2,$specialty2);
        // Assert
        $this->assertEquals($result, $expected_result);
    }

}
?>
