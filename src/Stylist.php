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

    }

?>
