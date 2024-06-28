@if($message = Session::get('success'))
<!-- <div class="alert alert-success col-md-12 col-lg-12">
	<p>{{ $message }}</p>
</div> -->
<script>
	$(function(){
		toastr.success('{{ $message }}','Success');
	});
</script>
@endif

@if(count($errors) > 0 )
<!-- <div class="alert alert-danger col-md-12 col-lg-12">
	<ul>
		@foreach($errors->all() as $error)
			<li> {{ $error }} </li>
		@endforeach
	</ul>
</div> -->
	@foreach ($errors->all() as $error)
		<script>
			$(function(){
				toastr.error('{{ $error }}','Failed');
			});
		</script>
	@endforeach
@endif