<div class="col-md-12">
    <a href="repertoire.php?op=add" class="btn btn-large btn-info"><span class="glyphicon glyphicon-plus"></span> Ajouter une entrée</a>
    <br><br>
</div>
<hr>

<table class="table table-bordered table-responsive">
   <thead>
       <tr>
            <?php foreach ($fields as $field) : ?>
                <th class="text-center"><?= $field['Field'] ?></th>
            <?php endforeach; ?>
           <th class="text-center">Editer</th>
           <th class="text-center">Supprimer</th>
        </tr>
   </thead>
    <tbody>
    <?php foreach ($donnees as $donnee) : ?>
        <tr class="text-center">
            <td><?= implode('</td><td>', $donnee) ?></td>
            <td><a href="repertoire.php?op=edit&id=<?= $donnee[$id] ?>"><span class="glyphicon glyphicon-edit"></span> </a></td>
            <td><a href="?op=confirmDelete&id=<?= $donnee[$id] ?>"><span class="glyphicon glyphicon-remove-circle"></span> </a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p>Le répertoire compte <?= $count['m'] ?> homme(s) et <?= $count['f'] ?> femme(s) </p>