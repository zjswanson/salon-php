<?php

    class Stylist
    {
        private $stylist_name;
        private $specialty;
        private $id;

        function __construct($stylist_name,$specialty,$id=null)
        {
            $this->stylist_name = $stylist_name;
            $this->specialty = $specialty;
            $this->id = $id;
        }

        // Hi Tyler, or whomever reivews this.  In the context of working with a database, isn't it somewhat dangerous to have generic setters for our properties?  Wouldn't it be better to use the update method to change both the object in local memory and the database entry at the same time?  It seems like having a setter that just changes the local object would be a good way to get my database out of sync with my local operations.  If a specific need came up to set the property value locally without saving, wouldn't it be better to handle that with a method for the specific case?  Thanks!

        function getStylistName()
        {
            return $this->stylist_name;
        }
        function setStylistName($new_name)
        {
            $this->stylist_name = $new_name;
        }
        function getSpecialty()
        {
            return $this->specialty;
        }
        function setSpecialty($new_specialty)
        {
            $this->specialty = $new_specialty;
        }
        function getId()
        {
            return $this->id;
        }
        // Note: Set ID method intentionally excluded to avoid overrwriting primary key from database.

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (stylist_name,specialty) VALUES ('{$this->stylist_name}','{$this->specialty}');");
            $this->id = $GLOBALS['DB']->lastInsertID();
        }

        static function getAll()
        {
            $returned_query = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach ($returned_query as $stylist)
            {
                $new_stylist = new Stylist($stylist['stylist_name'],$stylist['specialty'],$stylist['id']);
                array_push($stylists,$new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->query("DELETE FROM stylists;");
        }

        function delete()
        {
            $GLOBALS['DB']->query("DELETE FROM stylists WHERE id = {$this->id};");
        }

        static function find($search_id)
        {
            $returned_query = $GLOBALS['DB']->query("SELECT * FROM stylists WHERE id = {$search_id};");
            $found_stylist = null;
            foreach ($returned_query as $stylist)
            {
                $new_stylist = new Stylist($stylist['stylist_name'],$stylist['specialty'],$stylist['id']);
                $found_stylist = $new_stylist;
            }
            return $found_stylist;
        }


    }

?>
