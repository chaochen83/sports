@extends('layouts.default')
@section('content')

    <!-- {{{ Session::get('message') or 'Default message' }}}  </br>   -->

    User Register </br>

    {{ Form::open(array('action' => array('UsersController@register'))) }}


       <!--  {{Form::label('worker_id', '工号', array('class' => 'worker_id'))}}
        {{Form::text('worker_id')}} -->

        {{Form::submit('Click Me!')}}

    {{ Form::close() }}

@stop