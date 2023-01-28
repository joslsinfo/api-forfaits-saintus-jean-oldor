<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
  </head>
  <body>
<div class="card">
    <img src="https://picsum.photos/200" alt="une photo aléatoire">
    <div class="container">
        <h3><b>Nom du forfait : <?= $forfait->nom ?></b></h3>
        <h4>Description: <?= $forfait->description ?></h4>
        <h4>Code: <?= $forfait->code ?></h4>
        <h4>Du: <?= $forfait->dateDebut ?></h4>
        <h4>Au: <?= $forfait->dateFin ?></h4>
        <h4>Prix: <?= $forfait->prix ?></h4>
   
        

    </div>
</div>

</body>
</html>
