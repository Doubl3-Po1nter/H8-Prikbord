<?php
require_once "conn.php";

$action = $_POST["action"];
if($action == "edit")
{
    //Haal variabelen op, doe inputvalidatie
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    if(empty($title))
    {
        die("Vul een titel in");
    }
    if(empty($content))
    {
        die("Vul inhoud in");
    }


    //1. Haal de verbinding erbij


    //2. Schrijf query met placeholders 
    $query = "UPDATE berichten SET title = :title, content = :content WHERE id = :id";
    
    //3. Zet query om naar statement
    $statement = $conn->prepare($query);

    //4. Voer statement uit, geef nu waarden mee voor de placeholders
    $statement->execute([
        ":title" => $title,
        ":content" => $content,
        ":id" => $id
    ]);

    //5. Niet van toepassing bij een UPDATE-query

    //Stuur gebruiker terug naar lijst met berichten (index.php in hoofdmap)
    header("Location: ../index.php");
    exit;

}

//.... hier komt de delete-code

if($action == "delete")
{
    $id = $_POST["id"];

    if(empty($id))
    {
        die("Geen ID meegegeven");
    }

    $query = "DELETE FROM berichten WHERE id = :id";

    $statement = $conn->prepare($query);

    $statement->execute([":id" => $id]);

    header("Location: ../index.php");
    exit;
}