<?php

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questionsData = $_POST["questions"];
    $id_survei = $_POST["id_survei"];
    print_r($questionsData);
    print_r($id_survei);

    foreach ($questionsData as $questionData) {
        $question = $questionData["question"];
        $questionType = $questionData["questionType"];

        $options = isset($questionData["options"]) ? implode(", ", $questionData["options"]) : null;

        $sql = "INSERT INTO pertanyaan (jenis_pertanyaan, pertanyaan, pilihan, id_survei) 
                VALUES ('$questionType', '$question', '$options', '$id_survei')";

        if ($koneksi->query($sql) === TRUE) {
            header("location: dashboard.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $koneksi->close();
}
?>
