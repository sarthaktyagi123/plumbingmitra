@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
	<!--breadcrumb-->
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		<div class="breadcrumb-title pe-3">Tables</div>
		<div class="ps-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0 p-0">
					<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Item Table</li>
				</ol>
			</nav>
		</div>
		<div class="ms-auto">
			<div class="btn-group">
				<a href="{{ route('item.add') }}" class="btn btn-primary"> Add Items</a>
			</div>
		</div>
	</div>
	<!--end breadcrumb-->
	<h6 class="mb-0 text-uppercase">DataTable Example</h6>
	<hr/>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:70%">
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
							<td>{{ $key+1 }}</td>
							<td>{{ $item->item_name }} </td>
							<td>{{ $item->company_name}}</td>
							<td>{{ $item->parent_category }}</td>
							<td>{{ $item->other_specialty }} </td>
							<td>
							@if(Auth::user()->can('brand.edit'))
							<a href="{{ route('item.edit',$item->id) }}" class="btn btn-info">Edit</a>
							@endif
							@if(Auth::user()->can('brand.delete'))
							<a href="{{ route('item.delete',$item->id) }}" class="btn btn-danger" id="delete" >Delete</a>
						    @endif
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

@endsection