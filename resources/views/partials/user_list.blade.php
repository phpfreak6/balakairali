<ul class="list-group">
    @foreach($students as $student)
    <li class="list-group-item"><span class="login_status{{ $student->id }}">{{ loginOrLogoutStatus($student->id) }}</span>{{ $student->name }}<span class="float-right stdnt{{ $student->id }} student_btn" data-login="{{ encryptID($student->id) }}">{{ loginOrLogout($student->id) }}</span></li>
    @endforeach
</ul>