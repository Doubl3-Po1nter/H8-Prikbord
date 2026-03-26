<!doctype html>
<html lang="nl">

<head>
    <title>Prikbord</title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <?php require_once 'header.php'; ?>
    
    <div class="container home">

        <p>Berichten:</p>

        <?php
        require_once 'backend/conn.php';
        $query = "SELECT * FROM berichten";
        $statement = $conn->prepare($query);
        $statement->execute();
        $berichten = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <ul>
            <?php foreach ($berichten as $bericht): ?>
                <li>
                    <a href="berichten/edit.php?id=<?php echo urlencode($bericht['id']); ?>">
                        <?php echo htmlspecialchars($bericht['title'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

</body>

</html>
