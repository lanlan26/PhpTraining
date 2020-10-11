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
    {{ $success = Session::get('success') }}
    @if($success)
        <div class="alert-box success">
        </div>
    @endif

    {{ $error = Session::get('error') }}
    @if($error)
        <div class="alert-box error">
        </div>
    @endif
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">New Post Create</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="submit-form" role="form" action="{{ route('post.update', $post->id) }}" method="post">
      @method('PATCH')
      @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="inputPost">Title</label>
          <input type="text" name="title" class="form-control" id="inputPost" required autofocus value="{{ $post->title }}">
          @if($errors->has('title'))
          <label style="color: red">{{$errors->first('title')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputPostSlug">Slug</label>
          <input type="text" name="slug" class="form-control" id="inputPostSlug" required autofocus value="{{ $post->slug }}">
          @if($errors->has('slug'))
          <label style="color: red">{{$errors->first('slug')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputSeo">Seo Title</label>
          <input type="text" name="seo_title" class="form-control" id="inputSeo" required autofocus value="{{ $post->seo_title }}">
          @if($errors->has('seo_title'))
          <label style="color: red">{{$errors->first('seo_title')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputExcerpt">Excerpt</label>
          <input type="text" name="excerpt" class="form-control" id="inputExcerpt" required autofocus value="{{ $post->excerpt }}">
          @if($errors->has('excerpt'))
          <label style="color: red">{{$errors->first('excerpt')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputBody">Body</label>
          <input type="text" name="body" class="form-control" id="inputBody" required autofocus value="{{ $post->body }}">
          @if($errors->has('body'))
          <label style="color: red">{{$errors->first('body')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputPostMeta">Meta Description</label>
          <input type="text" name="meta_description" class="form-control" id="inputPostMeta" required autofocus value="{{ $post->meta_description }}">
          @if($errors->has('meta_description'))
          <label style="color: red">{{$errors->first('meta_description')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="inputKeywords">Keywords</label>
          <input type="text" name="keywords" class="form-control" id="inputKeywords" required autofocus value="{{ $post->keywords }}">
          @if($errors->has('keywords'))
          <label style="color: red">{{$errors->first('keywords')}}</label>
          @endif
        </div>
        <div class="form-group">
          <label for="active">Active</label>
          <input type="text" name="active" class="form-control" id="inputKeywords" required autofocus value="{{ $post->active }}">
          @if($errors->has('active'))
          <label style="color: red">{{$errors->first('active')}}</label>
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
