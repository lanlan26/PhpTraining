@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add Work</div>
                <div class="panel-body">
                    <form role="form" action="{{ route('work.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="active" class="col-md-4 control-label">
                                Active
                            </label>
                            <div class="col-md-7">
                                <select name="active" class="form-control">
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                                @if ($errors->has('active'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('active')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">
                                body
                            </label>
                            <div class="col-md-7">
                                <input type="text" name="body" class="form-control" id="body"
                                placeholder="body" required autofocus value="{{ old('body')}}">
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">
                                title
                            </label>
                            <div class="col-md-7">
                                <input type="text" name="title" class="form-control" id="title"
                                placeholder="title" required autofocus value="{{ old('title')}}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-md-4 control-label">
                                slug
                            </label>
                            <div class="col-md-7">
                                <input type="text" name="slug" class="form-control" id="slug"
                                placeholder="slug" required autofocus value="{{ old('slug')}}">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="skill" class="col-md-4 control-label">
                                skill
                            </label>
                            <div class="col-md-7">
                                <input type="text" name="skill" class="form-control" id="skill"
                                placeholder="skill" required autofocus value="{{ old('skill')}}">
                                @if ($errors->has('skill'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skill') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="excerpt" class="col-md-4 control-label">
                                excerpt
                            </label>
                            <div class="col-md-7">
                                <input type="text" name="excerpt" class="form-control" id="excerpt"
                                placeholder="excerpt" required autofocus value="{{ old('excerpt')}}">
                                @if ($errors->has('excerpt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('excerpt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="Image/*" key="1" required="true">
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()
