<?php

class Event {
    private $name;
    private $description;
    private $date;
    private $location;
    private $note;
    private $participating;

    public function __construct($name, $description, $date, $location, $note, $participating = 0) {
        $this->name = $name;
        $this->description = $description;
        $this->date = $date;
        $this->location = $location;
        $this->note = $note;
        $this->participating = $participating;
    }

    public function save($conn, $idUzytkownika) {
        $sql = "INSERT INTO calendar_events (idUzytkownika, name, description, date, location, note, participating) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log('Prepare failed: ' . htmlspecialchars($conn->error));
            return false;
        }
        $stmt->bind_param("isssssi", $idUzytkownika, $this->name, $this->description, $this->date, $this->location, $this->note, $this->participating);
        if ($stmt->execute()) {
            return true;
        } else {
            error_log('Execute failed: ' . htmlspecialchars($stmt->error));
            return false;
        }
    }
}
?>
