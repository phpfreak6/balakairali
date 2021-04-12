<select id="filter_by_class" class="form-control input-sm term" name="classes" required>
    <option value="">Select Class</option>
    <?php foreach ($classes as $class) { ?>
        <option value="<?= $class->id ?>"><?= $class->name ?></option>
    <?php } ?>
</select>