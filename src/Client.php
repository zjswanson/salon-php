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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (client_name,next_appointment,stylist_id) VALUES ('{$this->client_name}','{$this->next_appointment}',{$this->stylist_id});");
            $this->id = $GLOBALS['DB']->lastInsertID();
        }

        static function getAll()
        {
            $returned_query = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach ($returned_query as $client)
            {
                $new_client = new Client($client['client_name'],$client['next_appointment'], $client['stylist_id'],$client['id']);
                array_push($clients,$new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->query("DELETE FROM clients;");
        }

        function delete()
        {
            $GLOBALS['DB']->query("DELETE FROM clients WHERE id = {$this->id};");
        }

        static function find($search_id)
        {
            $returned_query = $GLOBALS['DB']->query("SELECT * FROM clients WHERE id = {$search_id};");
            $found_client = null;
            foreach ($returned_query as $client)
            {
                $new_client = new Client($client['client_name'],$client['next_appointment'], $client['stylist_id'],$client['id']);
                $found_client = $new_client;
            }
            return $found_client;
        }

        function update($property,$value)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET {$property}='{$value}' where id = {$this->getId()};");
            $this->$property = $value;
        }


    }

?>
