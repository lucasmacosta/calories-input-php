@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Meals for {{ $user->name }}</div>
                <div class="panel-body">

                    <a href="{{ route('users.meals.create', $user) }}" type="button" class="btn btn-success pull-right">Add Meal</a>

                    {{ Form::open([ 'route' => [ 'users.meals.index', $user ], 'class' => 'form-horizontal', 'method' => 'get' ]) }}

                        <div class="row">
                            <div class="col-md-4">

                                <div class="input-group">
                                    {{ Form::text('date_from', $query_params['date_from'], [ 'class' => 'form-control date-picker', 'placeholder' => 'Date From' ]) }}

                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>

                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="input-group">
                                    {{ Form::text('date_to', $query_params['date_to'], [ 'class' => 'form-control date-picker', 'placeholder' => 'Date To' ]) }}

                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">

                                <div class="input-group">
                                    {{ Form::text('time_from', $query_params['time_from'], [ 'class' => 'form-control time-picker', 'placeholder' => 'Time From' ]) }}

                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>

                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="input-group">
                                    {{ Form::text('time_to', $query_params['time_to'], [ 'class' => 'form-control time-picker', 'placeholder' => 'Time To' ]) }}

                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>

                                </div>
                            </div>
                        </div>

                        {{ Form::submit('Search', [ 'class' => 'btn btn-primary' ]) }}

                        <date-time-picker></date-time-picker>

                    {{ Form::close() }}

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Comments</th>
                                <th>Calories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($meals_groups as $date => $meals_group)
                            <tr>
                                <td colspan="4" class="{{ $meals_group['total_calories'] <= $user->settings->calories_per_day ? 'success' : 'danger' }}">
                                    <strong>{{ $date }} - Total Calories: {{ $meals_group['total_calories'] }}</strong>
                                </td>
                            </tr>
                            @foreach ($meals_group['meals'] as $meal)
                                <tr>
                                    <td>{{ $meal->date }}</td>
                                    <td>{{ $meal->comments }}</td>
                                    <td>{{ $meal->calories }}</td>
                                    <td>
                                        <a href="{{ route('users.meals.edit', [ 'user' => $user, 'meal' => $meal ]) }}" type="button" class="btn btn-primary">Edit</a>
                                        {{ Form::model($meal, [ 'route' => [ 'users.meals.destroy', $user, $meal ], 'method' => 'delete', 'class' => 'form-inline meal-delete' ]) }}
                                            {{ Form::submit('Delete', [ 'class'=>'btn btn-danger' ]) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
