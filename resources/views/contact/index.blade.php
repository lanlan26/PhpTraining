@extends('admin.master')

@section('content')
<section class="content-header">
  <h1>
    <a href="{{ route('contact.index') }}">Contact</a>
  </h1>
  <!-- <ol  class="breadcrumb" style="top: 8px">
    <li><a href="{{ route('user.create') }}" class="btn btn-primary">New User</a></li>
  </ol> -->
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
					<span class="order" field="message" sort="{{$type}}">Message</span> 
					@if($field == 'message' && $type == 'desc')
						<i class="fa fa-sort-asc"></i>
					@elseif($field == 'message' && $type == 'asc')
						<i class="fa fa-sort-desc"></i>
					@endif
				</th>
			</thead>
			<tbody>
				@foreach($contacts as $contact)
				<tr>
					<td >{{$contact->name}}</td>
					<td>{{$contact->email}}</td>
					<td class="table-truncate">
						<div class="table-truncate__body">
							{{$contact->message}}
						</div>
					</td>
					<td>
						<a href="{{ route('contact.show', $contact->id) }}" class="btn btn-primary" style="float: left">Detail</a>
						<form id="delete-form-{{$contact->id}}" action="{{ route('contact.destroy', $contact->id) }}" method="post">
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
			{{ $contacts->appends(request()->input())->links() }}
		</center>
	</div>
</section>
@include('layouts.confirm')
@endsection

@section('script')
	<script src="{{ asset('js/user.js') }}"></script>
@endsection