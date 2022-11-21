<x-admin-master>

    @section('content')
        <h2>User Profile for: {{ $user->name }}</h2>
        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('user.profile.update', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img height='40px' src="{{ $user->avatar }}" alt="">
                    </div>
                    <div class="form-group">
                        <input type="file" name='avatar'>
                    </div>
                    <div class="form-group">
                        <label for="user">UserName</label>
                        <input type="text" name="username" class="form-control" id="username"
                            value={{ $user->username }}>
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value={{ $user->name }}>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id='email' value={{ $user->email }}>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id='password'>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">cofirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id='password'>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class='btn btn-primary'>Submit</button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Options</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Options</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td><input type="checkbox"
                                        @foreach ($user->roles as $user_role)
                                        @if ($user_role->slug == $role->slug)
                                            checked               
                                        @endif @endforeach>
                                </td>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>
                                    <form action="{{ route('user.role.attach', $user) }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="role" value={{ $role->id }}>
                                        <button class="btn btn-primary" @if ($user->roles->contains($role)) disabled @endif>

                                            Attach
                                        </button>
                                    </form>
                                </td>


                                <td>
                                    <form action="{{ route('user.role.detach', $user) }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="role" value={{ $role->id }}>
                                        <button class="btn btn-danger" @if (!$user->roles->contains($role)) disabled @endif>
                                            Detach
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endsection
</x-admin-master>
