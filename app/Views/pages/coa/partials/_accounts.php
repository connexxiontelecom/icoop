<select name="parent_account" id="parent_account" class="form-control">
    <option disabled selected>Select account</option>
    <?php foreach($accounts as $account) : ?>
            <option value="<?= $account['glcode'] ?>"><?= ucfirst($account['account_name']) ?> - (<?= $account['glcode'] ?>)</option>
        <?php endforeach ?>
</select>