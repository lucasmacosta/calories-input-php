@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">

                    @can('create', App\User::class)
                        <a href="{{ route('users.create') }}" type="button" class="btn btn-success pull-right">Add User</a>
                    @endcan

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roleName() }}</td>
                                <td>
                                    @can('create', [ App\Meal::class, $user ])
                                        <a href="{{ route('users.meals.index', [ 'user' => $user->id ]) }}" type="button" class="btn btn-success">Meals</a>
                                    @endcan
                                    @can('update', $user)
                                        <a href="{{ route('users.edit', [ 'user' => $user->id ]) }}" type="button" class="btn btn-primary">Edit</a>
                                    @endcan
                                    @if (Auth::user()->id !== $user->id && Auth::user()->can('delete', $user))
                                        {{ Form::model($user, [ 'route' => [ 'users.destroy', $user->id ], 'method' => 'delete', 'class' => 'form-inline user-delete' ]) }}
                                            {{ Form::submit('Delete', [ 'class'=>'btn btn-danger' ]) }}
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
