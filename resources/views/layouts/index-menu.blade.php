<form action="" method="get" id="searchForm" accept-charset="utf-8" class="form-horizontal">
	<div class="row form-group">
		<div class="col-xs-4">
			<label for="inputSearch" class="col-md-3 control-label">Search: </label>
			<div class="col-md-9">
				<input id="inputSearch" type="text" name="keyword" class="form-control" value="{{ $keyword}}">
			</div>
		</div>
		<div class="col-xs-2 col-xs-offset-6">
			<select id="pagesize" name="pagesize" class="form-control" onchange="this.form.submit()">
				<option @if($pagesize == 5) selected @endif value="5" >5</option>
				<option @if($pagesize == 10) selected @endif value="10">10</option>
				<option @if($pagesize == 20) selected @endif value="20">20</option>
				<option @if($pagesize == 50) selected @endif value="50">50</option>
			</select>
		</div>
		<input type="hidden" name="field" value="{{$field}}">
		<input type="hidden" name="type" value="{{$type}}">
	</div>
</form>
