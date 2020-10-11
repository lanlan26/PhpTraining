@extends('admin.master')

@section('content')
<section class="content-header">
  <h1>
    <a href="{{ route('category.index') }}">Category</a>
    <small><a href="{{ route('category.create') }}"></a>Create</small>
  </h1>
  <ol  class="breadcrumb" style="top: 8px">
    <li><a href="{{ route('category.index') }}" class="btn btn-danger"><< Go Back</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">New Category Create</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="submit-form" role="form" action="{{ route('category.update',$category) }}" method="post">
      @method('PUT')
      @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="inputCategory">Title</label>
          <input type="text" name="title" class="form-control" id="inputCategory" required autofocus value="{{ $category->title }}">
          @if($errors->has('title'))
          <label style="color: red">{{$errors->first('title')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputCategorySlug">Slug</label>
          <input type="text" name="slug" class="form-control" id="inputCategorySlug" required autofocus value="{{ $category->slug }}">
          @if($errors->has('slug'))
          <label style="color: red">{{$errors->first('slug')}}</label>
          @endif
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="button" class="btn btn-primary" style="float: left" data-toggle="modal" data-target="#modalSubmit">Submit</button>
    </form>
    <form action="{{ route('category.destroy',$category) }}" method="post">
      @method('DELETE')
      @csrf
      <button type="submit" class="btn btn-danger" style="float: right">Delete</button>
    </form>
    </div>
  </div>
</section>
@include('layouts.confirm')
@endsection
