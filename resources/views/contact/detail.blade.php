@extends('admin.master')

@section('content')
<section class="content-header">
  <h1>
    <a href="{{ route('contact.index') }}">Contact Detail</a>
  </h1>
  <ol  class="breadcrumb" style="top: 8px">
    <li><a href="{{ route('contact.index') }}" class="btn btn-danger"><< Go Back</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
  <div class="box box-primary">
    <table class="dataTable table table-bordered table-striped">
      <tbody>
        <tr>
        <td>User Name</td>
        <td>{{$contact->name}}</td>
      </tr>
      <tr>
        <td>Email</td>
        <td>{{$contact->email}}</td>
      </tr>
      <tr>
        <td>Message</td>
        <td>{{$contact->message}}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div>
    <form id="delete-form-{{$contact->id}}" action="{{ route('contact.destroy', $contact->id) }}" method="post">
            @method('DELETE')
            @csrf
            <button type="button" class="btn btn-danger submitConfirm" data-toggle="modal" data-target="#modalDelete">Delete</button>
          </form> 
  </div>
</section>
@include('layouts.confirm')
@endsection

@section('script')
  <script src="{{ asset('js/user.js') }}"></script>
@endsection