<!doctype html>
<html lang="nl">

<head>
    <title>Prikbord / Aanpassen</title>
    <?php require_once "../head.php"; ?>
</head>

<body>

    <?php require_once "../header.php"; ?>

    <div class="container">
        <h1>Aanpassen bericht</h1>

        <?php
        $id = isset($_GET["id"]) ? $_GET["id"] : null;

        require_once "../backend/conn.php";

        $query = "SELECT * FROM berichten WHERE id = :id";

        $statement = $conn->prepare($query);
       
        $executed = $statement->execute([":id" => $id]);

        $bericht = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$bericht) {
            die("Bericht niet gevonden");
        }
        ?>

        <!-- Formulier voor edit: -->
        <form action="../backend/berichtenController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $bericht["id"]; ?>">

            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($bericht["title"], ENT_QUOTES, "UTF-8"); ?>">
            </div>

            <div class="form-group">
                <label for="content">Inhoud</label>
                <textarea name="content" id="content"><?php echo htmlspecialchars($bericht["content"], ENT_QUOTES, "UTF-8"); ?></textarea>
            </div>

            <input type="submit" value="Opslaan">
        </form>

        <!-- Formulier voor delete: -->
        <form action="../backend/berichtenController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $bericht["id"]; ?>">
            <input type="submit" value="Verwijder bericht">
        </form>

    </div>  

</body>

</html>
