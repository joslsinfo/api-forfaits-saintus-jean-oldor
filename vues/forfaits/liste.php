<!-- Affichage en mode "liste" -->
<h2>Affichage en mode "liste"</h2>
<ul>
    <?php foreach ($forfaits as $forfait) {  ?>
    <li><?= $forfait->nom ?> (<?= $forfait->description ?>)</li>
    <?php  } ?>
</ul>

