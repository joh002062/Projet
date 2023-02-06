<?php
$pdo = new PDO("sqlite:./products.db", null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$query = "SELECT * FROM products";
$params = [];

if (!empty($_GET['q'])) {
    $query .= " WHERE city LIKE :city";
    $params['city'] = '%' . $_GET['q'] . '%';
}

$query .= " LIMIT 50";

$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Bien immobilier</title>
</head>
<body class="p-4">

    <h1> Les Bien immobiliers</h1>

    <form action="" class="mb-4">
        <div class="form-group mb-4">
            <input type="text" class="form-control" name="q" placeholder="Rechercher par ville">
        </div>
        <button class="btn btn-primary">Rechercher</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Ville</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
            <tr>
                <td>#<?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= number_format($product['price'], 0, '', ' '); ?> €</td>
                <td><?= $product['city'] ?></td>
                <td><?= $product['address'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>