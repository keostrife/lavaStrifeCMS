@extends('admin.layout.main')

@section('content')
	@include('admin.include.nav')
	<div class="wrapper">
		<div class="btn-group pull-right" role="group" aria-label="languages">
			@foreach ($langs as $lang)
				<a href="?lang={{$lang->code}}" type="button" class="btn btn-default @if(App::getLocale() == $lang->code) active @endif">{{$lang->name}}</a>
			@endforeach
		</div>
		<div role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				@foreach ($pages as $index => $page)
					<li role="presentation" class="@if($index==0) active @endif"><a href="#{{$page}}" aria-controls="{{$page}}" role="tab" data-toggle="tab">{{$page}}</a></li>
				@endforeach
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				@foreach ($pages as $page)
					<div role="tabpanel" class="tab-pane @if($index==0) active @endif" id="{{$page}}">
						@foreach ($contents as $content)
							@if ($content["page"] == $page)
								<div class="field-group">
									<h5>{{$content["uid"]}} <button class="btn btn-danger delete"><span class="glyphicon glyphicon-remove"></span></button></h5>

									<textarea class="form-control field" data-uid="{{$content["uid"]}}" data-page="{{$content["page"]}}">{{$content["content"]}}</textarea>
								</div>
							@endif
						@endforeach
						<button class="save btn btn-primary" data-page="{{$content["page"]}}">Update</button>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@stop