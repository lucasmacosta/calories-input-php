@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>
                <div class="panel-body">
                    {{ Form::model($user, [ 'route' => [ 'users.update', $user->id ], 'method' => 'put', 'class' => 'form-horizontal' ]) }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', 'Name', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::text('name', null, [ 'class' => 'form-control', 'required' => true, 'autofocus' => true ]) }}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'E-Mail Address', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::email('email', null, [ 'class' => 'form-control', 'required' => true ]) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            {{ Form::label('role', 'Role', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::select('role', \App\User::getRolesList(), null, [ 'class' => 'form-control', 'required' => true ]) }}

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('calories_per_day') ? ' has-error' : '' }}">
                            {{ Form::label('settings[calories_per_day]', 'Calories Per Day', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::number('settings[calories_per_day]', null, [ 'class' => 'form-control', 'required' => true ]) }}

                                @if ($errors->has('calories_per_day'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('calories_per_day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'Password', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::password('password', [ 'class' => 'form-control' ]) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('password_confirmation', 'Confirm Password', [ 'class' => 'col-md-4 control-label' ]) }}

                            <div class="col-md-6">
                                {{ Form::password('password_confirmation', [ 'class' => 'form-control' ]) }}
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
