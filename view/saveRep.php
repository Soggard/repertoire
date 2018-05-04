<div class="container">
    <div class="row">
        <div class="col-md-6">

            <form action="" method="post">

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="<?= $entry ? $entry['nom'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $entry ? $entry['prenom'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="telephone">N° de téléphone</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" value="<?= $entry ? $entry['telephone'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="profession">Profession</label>
                    <input type="text" name="profession" id="profession" class="form-control" value="<?= $entry ? $entry['profession'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" id="ville" class="form-control" value="<?= $entry ? $entry['ville'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="codepostal">Code postal</label>
                    <input type="text" name="codepostal" id="codepostal" class="form-control" value="<?= $entry ? $entry['codepostal'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="form-control" value="<?= $entry ? $entry['adresse'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="date_de_naissance">Date de naissance</label>
                    <input type="date" name="date_de_naissance" id="date_de_naissance" class="form-control" value="<?= $entry ? $entry['date_de_naissance'] : '' ?>">
                </div>
                <div class="form-group">
                    <label>Sexe</label> <br>
                    <input type="radio" name="sexe" id="sexem" value="m" <?= $entry && $entry['sexe'] == "m" ? 'checked="checked"' : '' ?> > <label for="sexem">M</label> <br>
                    <input type="radio" name="sexe" id="sexef" value="f" <?= $entry && $entry['sexe'] == "f" ? 'checked="checked"' : '' ?> > <label for="sexef">F</label> <br>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="10"><?= $entry ? $entry['description'] : '' ?></textarea>
                </div>

                <input type="submit" class="btn btn-large btn-info">
            </form>

        </div>
    </div>
</div><!-- /.container -->
