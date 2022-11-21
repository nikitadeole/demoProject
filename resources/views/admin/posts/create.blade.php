<x-admin-master>

    @section('content')
        <h1>Create Post</h1>
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            
            <div class="form-group">
                <label for="file"></label>
                <input type="file" name="post_image" class="form-control" id="post_image">
            </div>

            <div class="form-group">
                <textarea name="body" class="form-control-file" id="body" cols="10" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @endsection
</x-admin-master>