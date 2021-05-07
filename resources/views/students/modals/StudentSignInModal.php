<div class="row">
    <?= Form::open(['url' => 'admin/students/signInStudent', 'method' => 'POST', 'id' => 'student_login_time_form']) ?>
    <?= Form::hidden('student_id', $studentObj->id, ['id' => 'student_id']) ?>
    <div class="col-sm-12">
        <div class="form-group">
            <?= Form::label('login_time', 'Login Time', ['class' => 'text-primary form-label']) ?>
            <input type="datetime-local" id="login_time" name="login_time" class="form-control" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class='btn btn-sm btn-primary'>Proceed</button>
            <button onclick="$('#common_modal').modal('hide');" type="button" class='btn btn-sm btn-danger'>Cancel</button>
        </div>
    </div>
    <?= Form::close() ?>
</div>