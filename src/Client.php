<?php

    class Client
    {
        private $client_name;
        private $next_appointment;
        private $stylist_id;
        private $id;

        function __construct($client_name,$next_appointment,$stylist_id=null,$id=null)
        {
            $this->client_name = $client_name;
            $this->next_appointment = $next_appointment;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

        function getClientName()
        {
            return $this->client_name;
        }
        function setClientName($new_name)
        {
            $this->client_name = $new_name;
        }
        function getNextAppointment()
        {
            return $this->next_appointment;
        }
        function setNextAppointment($new_next_appointment)
        {
            $this->next_appointment = $new_next_appointment;
        }
        function getStylistId()
        {
            return $this->stylist_id;
        }
        function getId()
        {
            return $this->id;
        }
        // Note: Set ID methods intentionally excluded to avoid overrwriting primary key from database.




    }

?>
