@extends('admin.master')

@section('content')
<section class="content-header">
  <h1>
    <a href="{{ route('user.index') }}">User</a>
    <small><a href="{{ route('user.create') }}"></a>Edit</small>
  </h1>
  <ol  class="breadcrumb" style="top: 8px">
    <li><a href="{{ route('user.index') }}" class="btn btn-danger"><< Go Back</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit User</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('user.update',$user->id) }}" method="post">
      @method('PUT')
      @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="inputCategory">User name</label>
          <input type="text" name="name" class="form-control" id="inputName" required autofocus value="{{ old('name', isset($user) ? $user['name'] : null) }}">
          @if($errors->has('name'))
          <label style="color: red">{{$errors->first('name')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="text" name="email" class="form-control" id="inputEMail" required autofocus value="{{ old('email', isset($user) ? $user['email'] : null) }}">
          @if($errors->has('email'))
          <label style="color: red">{{$errors->first('email')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input type="password" name="password" class="form-control" id="inputPassword">
          @if($errors->has('password'))
          <label style="color: red">{{$errors->first('password')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputPassword2">Password Confirm</label>
          <input type="password" name="password_confirmation" class="form-control" id="inputPassword2">
          @if($errors->has('password_confirmation'))
          <label style="color: red">{{$errors->first('password_confirmation')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select name="role" class="form-control">
            <option value="user">User</option>
            @if($user->role == "admin")
            <option value="admin" selected="selected">Admin</option>
            @else
            <option value="admin">Admin</option>
            @endif
          </select>
          @if($errors->has('role'))
          <label style="color: red">{{$errors->first('role')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="valid">Valid</label>
          <select name="valid" class="form-control">
            <option value="1">Active</option>
            @if($user->valid == 0)
            <option value="0" selected="selected">Deactive</option>
            @else
            <option value="0">Deactive</option>
            @endif
          </select>
          @if($errors->has('valid'))
          <label style="color: red">{{$errors->first('valid')}}</label>
          @endif
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary" style="float: left">Submit</button>
    </form>
  </div>
</section>
@endsection