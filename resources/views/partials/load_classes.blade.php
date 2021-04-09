<select id="filter_by_class" class="form-control input-sm term" name="classes" style="margin-top: 6px;" required="">
	<option value="">Select Class</option>
	@foreach($classes as $class)
    <option value="{{ $class->id }}">{{ $class->name }}</option>
	@endforeach
</select>