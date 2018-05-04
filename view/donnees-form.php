<div class="row">
    <div class="col-md-6">

        <form action="" method="post">

            <?php foreach ($fields as $field) : ?>
                <div class="form-group">
                    <label for="<?= $field['Field'] ?>"><?= $field['Field'] ?></label>
                    <input type="text" name="<?= $field['Field'] ?>" id="<?= $field['Field'] ?>" class="form-control">
                </div>
            <?php endforeach; ?>

            <input type="submit" class="btn btn-large btn-info">
        </form>

    </div>
</div>
