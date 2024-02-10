<?php

class JsonFileManager {
    private $file_path;

    public function __construct($file_path) {
        $this->file_path = $file_path;
    }

    public function read() {
        if (file_exists($this->file_path)) {
            $json_content = file_get_contents($this->file_path);
            return json_decode($json_content, true);
        }
        return null;
    }

    public function write($data) {
        $json_content = json_encode($data);
        file_put_contents($this->file_path, $json_content);
    }

    public function update($data) {
        if (file_exists($this->file_path)) {
            $current_data = $this->read();
            $current_data = array_merge($current_data, $data);
            $this->write($current_data);
        }
    }

    public function delete() {
        if (file_exists($this->file_path)) {
            unlink($this->file_path);
        }
    }
    // Les autres méthodes (write, update, delete) restent inchangées...

    public function getPlayerNames() {
        $players_data = $this->read();
        $names = array();
        if ($players_data) {
            foreach ($players_data as $player) {
                if (isset($player['name'])) {
                    $names[] = $player['name'];
                }
            }
        }
        return $names;
    }
    public function getQuestionID() {
        $questions_data = $this->read();
        $last_id = 0;
        if ($questions_data) {
            foreach ($questions_data as $question) {
                if (isset($question['id']) && $question['id'] > $last_id) {
                    $last_id = $question['id'];
                }
            }
        }
        return $last_id;
    }


}

// Exemple d'utilisation :

$file_path = 'data.json';
$jsonFileManager = new JsonFileManager($file_path);

// Lecture du fichier JSON
$result = $jsonFileManager->read();


// Écriture des données dans le fichier JSON
$data = array('name' => 'John Doe', 'age' => 30, 'email' => 'john@example.com');
$jsonFileManager->write($data);

// Mise à jour des données dans le fichier JSON
$data_to_update = array('age' => 35);
$jsonFileManager->update($data_to_update);

// Suppression du fichier JSON
$jsonFileManager->delete();

