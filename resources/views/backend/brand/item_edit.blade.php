@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit Items </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Items </li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
				 
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							 
<div class="col-lg-10">
	<div class="card">
		<div class="card-body">

		<form id="myForm" method="post" action="{{ route('update.item') }}" enctype="multipart/form-data" >
			@csrf
		 
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Item Name</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="item_name" class="form-control"  value="{{ $items->item_name}}" />
				</div>
			</div>

            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Company Name</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="company_name" class="form-control"  value="{{ $items->company_name}}" />
				</div>
			</div>

            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Parent Category</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="parent_category" class="form-control" value="{{ $items->parent_category}}"  />
				</div>
			</div>

            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">other speciality</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="other_speciality" class="form-control"  value="{{ $items->other_speciality}}" />
				</div>
			</div>
			  

			

	
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
				</div>
			</div>
		</div>

		</form>



	</div>
	 



                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                item_name: {
                    required : true,
                }, 
                company_name: {
                    required :true,
                },
            },
            messages :{
                item_name: {
                    required : 'Please Enter item Name',
                },
                company_name: {
                    required : 'Please Enter company Name',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>




<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});


</script>
@endsection