<x-admin-master>
    @section('content')
    <div class="row">
       <div class="col-sm-6">
        <h1>Edit Role: {{ $role->name }}</h1>
        <div class="row">
            @if(session()->has('role-updated'))
            <div class="alert alert-success">
                {{ Session('role-updated') }}
            </div>
            @endif
        </div>
        <form action="{{ route('roles.update', $role->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name')
                    is-invalid                                 
                @enderror" value="{{ $role->name }}">
                <div>
                    @error('name')
                        <span><strong>{{ $message }}</strong></span>                                    
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
       </div>
    </div><br>
    <div class="row">
        <div class="col-lg-12">
            @if (!$permissions->isEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Options</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Dettach</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Dettach</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td><input type="checkbox"  
                                        @foreach ($role->permissions as $role_permission )
                                            @if ($role_permission->slug == $permission->slug)
                                                checked
                                            @endif
                                            
                                        @endforeach    
                                    ></td>
                                    <td>{{ $permission->id }}</td>
                                    <td><a href="{{ route('roles.edit', $permission->id) }}">{{ $permission->name }}</a></td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>
                                        <form action="{{ route('role.permission.attach', $role) }}" method="post" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="permission" value={{ $permission->id }}>
                                            <button 
                                                class="btn btn-primary"
                                                @if($role->permissions->contains($permission))
                                                    disabled
                                                @endif>
                                                
                                                Attach
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('role.permission.detach', $role) }}" method="post" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="permission" value={{ $permission->id }}>
                                            <button 
                                                class="btn btn-danger"
                                                @if (!$role->permissions->contains($permission))
                                                    disabled
                                                @endif
                                                >
                                                Detach
                                            </button>
                                        </form>    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
            @endif
        </div>
    </div>
    @endsection
</x-admin-master>
   

   