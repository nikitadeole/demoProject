<x-admin-master>
    @section('content')
        <x-admin-master>
            @section('content')
         <h1>All Users</h1>
         @if (Session::has('user-deleted')) 
          
         <div class="alert alert-danger">{{ Session::get('user-deleted') }}</div>
           
         @endif
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Avatar</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Registered Date</th>
                  <th>Updated Date</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                    <th>Updated Date</th>
                    <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('user.profile.show', $user->id) }}">{{ $user->username }}</a></td>
                    <td> 
                        
                        <img src="{{ $user->avatar }}" alt="" height="40px">
                    </td>
                    <td> {{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                    <td>
                      <form action="{{ route('users.destroy', $user->id) }}" method="post" entype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>              
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        </div>
            @endsection
        
            @section('scripts')
             <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        
            <!-- Page level custom scripts -->
            <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
            @endsection
        </x-admin-master>

    @endsection
</x-admin-master>