@extends('admin.master')

@section('content')
<section class="content-header">
  <h1>
    <a href="{{ route('post.index') }}">Post</a>
    <small><a href="{{ route('post.create') }}"></a>Create</small>
  </h1>
  <ol  class="breadcrumb" style="top: 8px">
    <li><a href="{{ route('post.index') }}" class="btn btn-danger"><< Go Back</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">New Post Create</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="submit-form" role="form" action="{{ route('post.store') }}" method="post">
      @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="inputPost">Title</label>
          <input type="text" name="title" class="form-control" id="inputPost" autofocus value="{{ old('title') }}">
          @if($errors->has('title'))
          <label style="color: red">{{$errors->first('title')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputPostSlug">Slug</label>
          <input type="text" name="slug" class="form-control" id="inputPostSlug" autofocus value="{{ old('slug') }}">
          @if($errors->has('slug'))
          <label style="color: red">{{$errors->first('slug')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputSeo">Seo Title</label>
          <input type="text" name="seo_title" class="form-control" id="inputSeo" autofocus value="{{ old('seo_title') }}">
          @if($errors->has('seo_title'))
          <label style="color: red">{{$errors->first('seo_title')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputExcerpt">Excerpt</label>
          <input type="text" name="excerpt" class="form-control" id="inputExcerpt" autofocus value="{{ old('excerpt') }}">
          @if($errors->has('excerpt'))
          <label style="color: red">{{$errors->first('excerpt')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputBody">Body</label>
          <input type="text" name="body" class="form-control" id="inputBody" autofocus value="{{ old('body') }}">
          @if($errors->has('body'))
          <label style="color: red">{{$errors->first('body')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputPostMeta">Meta Description</label>
          <input type="text" name="meta_description" class="form-control" id="inputPostMeta" autofocus value="{{ old('meta_description') }}">
          @if($errors->has('meta_description'))
          <label style="color: red">{{$errors->first('meta_description')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputKeywords">Keywords</label>
          <input type="text" name="keywords" class="form-control" id="inputKeywords" autofocus value="{{ old('keywords') }}">
          @if($errors->has('keywords'))
          <label style="color: red">{{$errors->first('keywords')}}</label>
          @endif
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSubmit">Submit</button>
      </div>
    </form>
  </div>
</section>
@include('layouts.confirm')
@endsection
