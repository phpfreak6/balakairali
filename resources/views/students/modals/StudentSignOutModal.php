<div class="row">
    <?= Form::open(['url' => 'admin/students/signOutStudent', 'method' => 'POST', 'id' => 'student_logout_time_form']) ?>
    <?= Form::hidden('id', $record_id, ['id' => 'id']) ?>
    <div class="col-sm-12">
        <div class="form-group">
            <?= Form::label('logout_time', 'Logout Time', ['class' => 'text-primary form-label']) ?>
            <input type="datetime-local" id="logout_time" name="logout_time" class="form-control" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class='btn btn-sm btn-primary'>Proceed</button>
            <button onclick="$('#common_modal').modal('hide');" type="button" class='btn btn-sm btn-danger'>Cancel</button>
        </div>
    </div>
    <?= Form::close() ?>
</div>