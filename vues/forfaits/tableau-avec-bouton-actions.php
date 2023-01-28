<!-- Affichage en mode "tableau" -->
<h2>Affichage en mode "tableau" au format HTML </h2>
<table>
    <tr>
        <th>Nom du forfait</th>
        <th>Description</th>
        <th>Code</th>
        <th>Date de début</th>
        <th>Date de fin</th>
        <th>Prix</th>
        
        <th>Actions</th>
    </tr>

    <?php
    foreach ($forfaits as $forfait) {
    ?>
    <tr>
        <td><?= $forfait->nom ?></td>
        <td><?= $forfait->description ?></td>
        <td><?= $forfait->code ?></td>
        <td><?= $forfait->dateDebut ?></td>
        <td><?= $forfait->dateFin ?></td>
        <td><?= $forfait->prix ?></td>
        
        <td>
            <a href="fiche-forfait-html.php?id=<?= $forfait->id ?>">Afficher</a>
                 
        </td>
       
    </tr>
    <?php
    }
    ?>
</table>