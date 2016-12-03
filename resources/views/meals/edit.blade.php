@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Meal for {{ $user->name }}</div>
                <div class="panel-body">
                    {{ Form::model($meal, [ 'route' => [ 'users.meals.update', $user, $meal ], 'method' => 'put', 'class' => 'form-horizontal' ]) }}

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            {{ Form::label('date', 'Date', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="input-group col-md-6">
                                {{ Form::text('date', null, [ 'class' => 'form-control date-time-picker', 'required' => true ]) }}

                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <date-time-picker></date-time-picker>

                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            {{ Form::label('comments', 'Comments', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::textarea('comments', null, [ 'class' => 'form-control' ]) }}

                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('calories') ? ' has-error' : '' }}">
                            {{ Form::label('calories', 'Calories', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::number('calories', null, [ 'class' => 'form-control', 'required' => true ]) }}

                                @if ($errors->has('calories'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('calories') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Update', [ 'class'=>'btn btn-primary' ]) }}
                            </div>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
