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
    }

?>
