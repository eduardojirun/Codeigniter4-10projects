<h3>Sitio</h3>
<?= $nameSite ?>

<h3>Inicio</h3>
<?= $home ?>

<h3>Productos</h3>
<ul>
<?php foreach($products as $p): ?>
    <li><?= $p ?></li>
<?php endforeach ?>
</ul>

<h3>Servicios</h3>
<ul>
<?php foreach($services as $s): ?>
    <li><?= $s ?></li>
<?php endforeach ?>
</ul>

<h3>Áreas</h3>
<ul>
<?php foreach($areas as $a): ?>
    <li><?= $a ?></li>
<?php endforeach ?>
</ul>

<h3>Acerca de</h3>
<?= $about ?>

<h3>Equipo</h3>
<ul>
<?php foreach($team as $t): ?>
    <li><?= $t ?></li>
<?php endforeach ?>
</ul>

<h3>Contacto</h3>
<?= $contact ?>

           