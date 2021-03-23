<select name="contribution_type" id="contribution_type" required id="contribution_type" class="form-control">
    <option selected disabled>--Select contribution type--</option>
    <?php foreach($contribution_types as $ct): ?>
        <option value="<?= $ct->contribution_type_id ?? '' ?>"><?= $ct->contribution_type_name  ?? '' ?></option>
    <?php endforeach; ?>
</select>