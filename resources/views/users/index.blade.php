@extends('layouts.app')

@section('content')
<section>

    <div class="col-lg-8 col-md-6 col-sm-6">
        <a href="{{ route('users.create') }}" type="button" class="btn btn-success pull-right">Add User</a>

        <header>
            <h2>Users</h2>
        </header>

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
                        <a href="{{ route('users.edit', [ 'user' => $user->id ]) }}" type="button" class="btn btn-primary">Edit</a>
                        @if (Auth::user()->id !== $user->id)
                            {{ Form::model($user, [ 'route' => [ 'users.update', $user->id ], 'method' => 'delete' ]) }}
                                {{ Form::submit('Delete', [ 'class'=>'btn btn-danger' ]) }}
                            {{ Form::close() }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</section>
@endsection
