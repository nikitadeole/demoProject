<x-admin-master>
    @section('content')
 <h1>All posts</h1>
 @if (Session::has('message')) 
  
 <div class="alert alert-danger">{{ Session::get('message') }}</div>

 @elseif (Session::has('post-create-message'))
 <div class="alert alert-success">{{ Session::get('post-create-message') }}</div>

 @elseif (Session::has('post-update-message'))
 <div class="alert alert-success">{{ Session::get('post-update-message') }}</div>
   
 @endif
 <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>User Name</th>
          <th>Image</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>User Name</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Delete</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td>
              <a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a>
          </td>
          <td>{{ $post->user->name }}</td>
          <td>
              <img src="{{ asset($post->post_image) }}" alt="" height="40px" srcset="">
          </td>
          <td>{{ $post->created_at->diffForHumans() }}</td>
          <td>{{ $post->updated_at->diffForHumans() }}</td>
          <td>
            @can('view', $post)
              
            <form action="{{ route('posts.destroy', $post->id) }}" method="post" entype="multipart/form-data">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>              
            @endcan
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