@extends('admin.master')

@section('content')
<section class="content-header">
  <h1>
    <a href="{{ route('user.index') }}">User</a>
  </h1>
  <ol  class="breadcrumb" style="top: 8px">
    <li><a href="{{ route('user.create') }}" class="btn btn-primary">New User</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="box box-header">
		@if(session()->has('message-type'))
			<div class="alert alert-{{session('message-type')}}" style="z-index: 1; position: absolute; width: 98%;">
				{{session('message-content')}}
			</div>
		@endif
		@include('layouts.index-menu')
	</div>
  	<div class="box box-body">
		<table class="dataTable table table-bordered table-striped">
			<thead>
				<th>
					<span class="order" field="name" sort="{{$type}}">User Name</span> 
					@if($field == 'name' && $type == 'desc')
						<i class="fa fa-sort-asc"></i>
					@elseif($field == 'name' && $type == 'asc')
						<i class="fa fa-sort-desc"></i>
					@endif
				</th>
				<th>
					<span class="order" field="email" sort="{{$type}}">Email</span> 
					@if($field == 'email' && $type == 'desc')
						<i class="fa fa-sort-asc"></i>
					@elseif($field == 'email' && $type == 'asc')
						<i class="fa fa-sort-desc"></i>
					@endif
				</th>
				<th>
					<span class="order" field="role" sort="{{$type}}">Role</span> 
					@if($field == 'role' && $type == 'desc')
						<i class="fa fa-sort-asc"></i>
					@elseif($field == 'role' && $type == 'asc')
						<i class="fa fa-sort-desc"></i>
					@endif</th>
				<th>
					<span class="order" field="valid" sort="{{$type}}">Valid</span> 
					@if($field == 'valid' && $type == 'desc')
						<i class="fa fa-sort-asc"></i>
					@elseif($field == 'valid' && $type == 'asc')
						<i class="fa fa-sort-desc"></i>
					@endif</th>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->role}}</td>
					@if($user->valid == 1)
					<td>Active</td>
					@else
					<td>Deactive</td>
					@endif
					<td>
						<a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary" style="float: left"><i class="fa fa-edit"></i></a>
						<form id="delete-form-{{$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="post">
							@method('DELETE')
							@csrf
							<button type="button" class="btn btn-danger submitConfirm" data-toggle="modal" data-target="#modalDelete"><i class="fa fa-close"></i></button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<center>
			{{ $users->appends(request()->input())->links() }}
		</center>
	</div>
</section>
@include('layouts.confirm')
@endsection

@section('script')
	<script src="{{ asset('js/user.js') }}"></script>
@endsection