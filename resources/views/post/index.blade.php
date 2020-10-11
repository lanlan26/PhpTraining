@extends('admin.master')

@section('content')
<section class="content-header">
  <h1>
    <a href="{{ route('post.index') }}">Post</a>
  </h1>
  <ol  class="breadcrumb" style="top: 8px">
    <li><a href="{{ route('post.create') }}" class="btn btn-primary">New Post</a></li>
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
          <span class="order" field="title" sort="{{$type}}">Title</span>
          @if($field == 'title' && $type == 'desc')
            <i class="fa fa-sort-asc"></i>
          @elseif($field == 'title' && $type == 'asc')
            <i class="fa fa-sort-desc"></i>
          @endif
        </th>
        <th>
          <span class="order" field="slug" sort="{{$type}}">Slug</span>
          @if($field == 'slug' && $type == 'desc')
            <i class="fa fa-sort-asc"></i>
          @elseif($field == 'slug' && $type == 'asc')
            <i class="fa fa-sort-desc"></i>
          @endif
        </th>
        <th>Edit</th>
      </thead>
      <tbody>
        @foreach($posts as $post)
        <tr>
          <td>{{$post->title}}</td>
          <td>{{$post->slug}}</td>
          <td>
            <a href="{{ route('post.edit', $post) }}" class="btn btn-primary" style="float: left"><i class="fa fa-edit"></i></a>
            <form id="delete-form-{{$post->id}}" action="{{ route('post.destroy',$post) }}" method="post">
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
      {{ $posts->appends(request()->input())->links() }}
    </center>
  </div>
</section>

@include('layouts.confirm')
@endsection

@section('script')
  <script src="{{ asset('js/post.js') }}"></script>
@endsection
