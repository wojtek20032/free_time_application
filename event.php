<?php

class Event {
    private $description;
    private $date;
    private $location;
    private $note;
    private $participating;


    public function __construct($description, $date, $location, $note, $participating = 0) {
        $this->description = $description;
        $this->date = $date;
        $this->location = $location;
        $this->note = $note;
        $this->participating = $participating;
    }


    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

 
    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }


    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

 
    public function getParticipating() {
        return $this->participating;
    }

    public function setParticipating($participating) {
        $this->participating = $participating;
    }

  
    public function markAsParticipating() {
        $this->participating = 1;
    }

   
    public function markAsNotParticipating() {
        $this->participating = 0;
    }
}

