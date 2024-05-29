<?php
class Event {
    public $name;
    public $description;
    public $date;
    public $location;
    public $note;
    public $participating;

    public function __construct($name, $description, $date, $location, $note, $participating) {
        $this->name = $name;
        $this->description = $description;
        $this->date = $date;
        $this->location = $location;
        $this->note = $note;
        $this->participating = $participating;
    }

    public function save($conn, $user_id) {
        $stmt = $conn->prepare("INSERT INTO calendar_events (idUzytkownika, name, description, date, location, note, participating) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssi", $user_id, $this->name, $this->description, $this->date, $this->location, $this->note, $this->participating);
        return $stmt->execute();
    }

    public function update($conn, $event_id, $user_id) {
        $stmt = $conn->prepare("UPDATE calendar_events SET name = ?, description = ?, date = ?, location = ?, note = ?, participating = ? WHERE id = ? AND idUzytkownika = ?");
        $stmt->bind_param("sssssiis", $this->name, $this->description, $this->date, $this->location, $this->note, $this->participating, $event_id, $user_id);
        return $stmt->execute();
    }

    
}
?>
