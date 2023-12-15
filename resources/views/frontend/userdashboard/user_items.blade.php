@extends('dashboard') 
@section('user')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="page-wrapper">
  <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href=" {{route('dashboard')}} " rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
<div class="row">

<!-- // Start Col md 3 menu -->

 @include('frontend.body.dashboard_sidebar_menu')
<!-- // End Col md 3 menu -->




<div class="col-md-9">
<div class="tab-content account dashboard-content pl-50">
<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Item list</h3>
        </div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th>S.no.</th>
							<th>Item Name</th>
							<th>company name</th>
							<th>parent category</th>
							<th>other specialty</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($items as $key => $item)    
                            <tr>
                                <td id="dproduct_id">{{ $item->id }}</td>
                                <td id="item_name_{{ $item->id }}">{{ $item->item_name }}</td>
                                <td id="company_name_{{ $item->id }}">{{ $item->company_name }}</td>
                                <td>{{ $item->parent_category }}</td>
                                <td id="other_specialty_{{ $item->id }}">{{ $item->other_specialty }}</td>
                                <td>
                                <a href="{{ route('shop.page') }}" class="btn btn-info">Lets shop</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

					<tfoot>
						<tr>
							<th>S.no.</th>
							<th>Item Name</th>
							<th>company name</th>
							<th>parent category</th>
							<th>other specialty</th>
							<th>Actions</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
    </div>
</div>  

  </div>
   </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>


@endsection