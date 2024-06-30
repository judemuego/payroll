<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Business Solutions</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="{{asset('/js/jquery.validate.min.js')}}" ></script>
    <script src="{{asset('/plugins/moment.js')}}" ></script>
    <link href="{{{ URL::asset('backend/css/modern.css') }}}" rel="stylesheet">
    <link href="{{asset('/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom_mobile.css')}}" rel="stylesheet">
    {{-- <script src="{{{ URL::asset('backend/js/settings.js') }}}"></script> --}}
    <script src="{{asset('/plugins/datatable/jquery.dataTables.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/dataTables.button.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/buttons.html5.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/pdfmake.min.js')}}" ></script>
    <script src="{{asset('/plugins/datatable/vfs_fonts.js')}}" ></script>
    @yield('scripts')
    @yield('styles')
    @yield('styles-2')
    <style>
    .alert {
        padding: 10px;
    }
    .centralized>button {
        padding: 5px 10px;
        border: 0px;
        font-size: 20px;
        color: #153d77;
        background: #fff;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 5px;
    }
    .alert {
        margin: 10px;
        width: auto !important;
    }
    .alert p {
        margin: 0px;
    }
    label.error {
        width: 100%;
        padding: 5px 10px;
        background: #ff9f9f;
        color: #fff;
    }
    /* Ensure text wrap and tooltip styling for DataTable cells */
    table.dataTable td {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    table.dataTable td span {
        display: block;
    }

    table.dataTable td span[title]:hover::after {
        content: attr(title); /* Tooltip content from the title attribute */
        position: absolute;
        transform: translateY(-50%);
        left: 100%; /* Position the tooltip */
        top: 50%;
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 3px;
        white-space: nowrap;
        z-index: 1;
        margin-left: 10px; /* Space between the cell and the tooltip */
        pointer-events: none;
        opacity: 0.75;
    }

    table.dataTable td span.expandable.expanded {
        white-space: normal; /* Allows full content display */
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        padding: 5px;
        z-index: 10;
    }
    </style>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>

    <script>

        // Pusher.logToConsole = true;

        var pusher = new Pusher('4fa242eb99abc2b85cce', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
            channel.bind('form-submitted', function(data) {
            alert(JSON.stringify(data));
        });

        $(document).on('click', 'span.expandable', function() {
            $(this).toggleClass('expanded');
            if ($(this).hasClass('expanded')) {
                $(this).removeAttr('title'); 
            } else {
                $(this).attr('title', $(this).text()); 
            }
        });
        

    </script>
    
</head>
<body>
    <div class="wrapper">
        @include('backend.partial.sidebar')
        <div class="main">
            @include('backend.partial.header')
            <div class="custom-modal">
                <div class="custom-modal-container">
                    <div class="custom-modal-header">
                        <h3 class="custom-modal-title">MODAL TITLE</h3>
                        <span class="custom-modal-close" onclick="scion.create.modal().hide('all')"><i class="fas fa-times"></i></span>
                    </div>
                    <div class="custom-modal-body"></div>
                </div>
            </div>
            <div class="sc-modal">
                @yield('sc-modal')
            </div>
            <div class="row" style="height:calc(100% - 180px);padding: 0 18px;">
                @if(isset($type))
                    @if($type === "full-view")
                    <div class="col-xl-12" style="height:100%; overflow-y: auto;">
                        @yield('content')
                    </div>
                    @else
                    <div class="col-xl-3" style="height:100%; overflow-y: auto;">
                        @yield('left-content')
                    </div>
                    <div class="col-xl-9" style="height:100%; overflow-y: auto;">
                        @yield('content')
                    </div>
                    @endif
                @else
                    <div class="col-xl-2 left-content" style="height:100%;">
                        <div class="container-fluid" style="height:100%; overflow-y: auto; overflow-x: hidden;">
                            @yield('left-content')
                        </div>
                    </div>
                    <main class="col-xl-8 content" style="height:100%;">
                        <div class="container-fluid" style="height:100%; overflow-y: auto; overflow-x: hidden;">
                            @yield('content')
                        </div>
                    </main>
                    <div class="col-xl-2 right-content" style="height:100%; overflow-x: hidden;">
                        <div class="container-fluid" style="height:100%">
                            @yield('right-content')
                        </div>
                    </div>
                @endif
            </div>
            @include('backend.partial.footer')
        </div>
        
    </div>

    
    <div class="modal fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="delete_func.yes()">Yes</button>
            </div>
        </div>
        </div>
    </div>

    
	<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Change Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body m-3">
					<form method="POST" action="{{ route('change.password') }}" class="not">
						@csrf

						@foreach ($errors->all() as $error)
							<p class="text-danger">{{ $error }}</p>
						@endforeach

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

							<div class="col-md-6">
								<input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

							<div class="col-md-6">
								<input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary not">
									Update Password
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="changePhotoModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Change Profile Picture</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body m-3">
					<form method="POST" action="{{ route('change.picture') }}" enctype="multipart/form-data" class="not">
						@csrf
						<div class="form-group row">
							<input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}"/>
							<label class="col-form-label col-sm-3 text-sm-right">Profile Picture</label>
							<div class="col-sm-9">
								<input type="file" name="picture" class="form-control">
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary ">
									Upload
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

    <script src="{{ URL::asset('backend/js/app.js') }}"></script>

    <script src="{{asset('/plugins/cropimg/cropzee.js')}}" ></script>
    <script src="{{asset('/plugins/toastr/toastr.min.js')}}" ></script>
    <script src="{{asset('/js/global.js')}}" ></script>
    <script>
		$(function() {
			// Datatables basic
			$('#datatables-basic').DataTable({
				responsive: true
			});
            
			// Datatables with Buttons
			var datatablesButtons = $('#datatables-buttons').DataTable({
				lengthChange: !1,
				buttons: ["copy", "print"],
				responsive: true
			});

			datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
            
		});
	</script>
    
    @yield('chart-js')
</body>
</html>