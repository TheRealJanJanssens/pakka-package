@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	{!! Form::model($item, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\FormController@update', $item['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.forms.form')
		
	{!! Form::close() !!}
	
@stop
