<x-admin-master>
    @section('content')
    <div class="row">
        @if(session()->has('permission-updated'))
        <div class="alert alert-danger">
            {{ Session('permission-updated') }}
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-6">
         <h1>Edit permission: {{ $permission->name }}</h1>
         <div class="row">
             @if(session()->has('role-updated'))
             <div class="alert alert-success">
                 {{ Session('role-updated') }}
             </div>
             @endif
         </div>
         <form action="{{ route('permission.update', $permission->id) }}" method="post">
             @csrf
             @method('PUT')
             <div class="form-group">
                 <label for="name">Name</label>
                 <input type="text" name="name" id="name" class="form-control @error('name')
                     is-invalid                                 
                 @enderror" value="{{ $permission->name }}">
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
    @endsection
</x-admin-master>