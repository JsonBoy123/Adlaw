<div class="col-md-2">
	<select class="form-control required" name="qual_catg_code" id="qual_catg">
		<option value="">Select Qualification</option>
		@foreach($data['qual_catgs'] as $qual_catg)
			<option value="{{$qual_catg->qual_catg_code}}">{{$qual_catg->qual_catg_desc}}</option>
		@endforeach
	</select>
	@error('qual_catg_code')
		<span class="invalid-feedback text-danger" role="alert">
		<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>
<div class="col-md-2">
	<select class="form-control required" name="qual_code" id="qual_course">

	</select>
	@error('qual_code')
		<span class="invalid-feedback text-danger" role="alert">
		<strong>{{ $message }}</strong>
		</span>
	@enderror

</div>				
<div class="col-md-2">
	<select class="form-control" name="batch">
		<option value="">Select Batch</option>
		@foreach($data['batches'] as $batch)
			<option value="{{$batch->id}}">{{$batch->name}}</option>
		@endforeach 
	</select>
	@error('batch')
		<span class="invalid-feedback text-danger" role="alert">
		<strong>{{ $message }}</strong>
		</span>
	@enderror

</div>
<div class="col-md-2">
	<select class="form-control" name="year"> 
		<option value="">Select Admission Year</option>
		<option value="1">1 year</option>
		<option value="2">2 year</option>
		<option value="3">3 year</option>
		<option value="4">4 year</option>
		<option value="5">5 year</option>
	</select>
	@error('year')
		<span class="invalid-feedback text-danger" role="alert">
		<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>
<div class="col-md-2">
	<select class="form-control" name="semester"> 
		<option value="">Select Semester</option>
		<option value="1">1st</option>
		<option value="2">2nd</option>
		<option value="3">3rd</option>
		<option value="4">4th</option>
		<option value="5">5th</option>
		<option value="6">6th</option>
		<option value="7">7th</option>
		<option value="8">8th</option>
		<option value="9">9th</option>
		<option value="10">10th</option>
	</select>
	@error('semester')
		<span class="invalid-feedback text-danger" role="alert">
		<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>
<script>
	$(document).ready(function(){
		$('#qual_catg').on('change',function(e){
			e.preventDefault();
			var qual_catg_code = $(this).val();
			qual_course(qual_catg_code);
			qual_docs(qual_catg_code);
		});
	})
</script>