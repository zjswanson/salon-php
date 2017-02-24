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



}
?>
