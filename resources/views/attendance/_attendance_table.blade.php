<div>
    <table id="mark_datatable1" class="table table-striped table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th class="center">Student ID</th>
                <th class="center">Name</th>
                <th class="center">Father/Mother</th>
                <th class="center">Mobile</th>
                @permission('editing_teacher')
                <th class="center">Mark Present</th>
                @endpermission
            </tr>
        </thead>
        <tbody>
            @php $c = 1; @endphp
            @forelse($users as $user) 
            <tr>
                <th class="text-center" scope="row">{{ $user->id }}</th>
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">
                    @if($user->student->p1_type == 'father')
                    {{ $user->student->p1_first_name.' '.$user->student->p1_last_name }}
                    @elseif($user->student->p1_type == 'mother')
                    {{ $user->student->p1_first_name.' '.$user->student->p1_last_name}}
                    @else
                    {{ $user->student->p1_first_name.' '.$user->student->p1_last_name.' ('.$user->student->p1_type.')' }}
                    @endif
                </td>
                <td class="text-center">{{ $user->student->p1_mobile }}</td>
                @permission('editing_teacher')
                <td class="text-center">
                    @if(\App\Models\Attendance::isAttended($class, $centre, $date) > 0 && ($date < date('d-m-Y')))
                    {!! (\App\Models\Attendance::isPresent($user->id, $class, $centre, $date) == 1) ? '<span class="label label-sm label-success">Present</span>' : '<span class="label label-sm label-danger">Absent</span>' !!} 
                    @else
                    <input type="checkbox" name="attend" value="{{ $user->id }}" class="attend" {{ (\App\Models\Attendance::isPresent($user->id, $class, $centre, $date) == 1) ? 'checked' : '' }} />
                    @endif
                </td>
                @endpermission
            </tr>
            @php $c++; @endphp
            @empty
            <tr>
                <th  class="text-center" scope="row" colspan="5">No Students</th>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@section('scripts')
@endsection