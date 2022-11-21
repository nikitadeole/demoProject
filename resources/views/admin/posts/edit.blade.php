<x-admin-master>

    @section('content')
        <h1>Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="exampleInputEmail">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value='{{ $post->title }}'>
            </div>
            
            <div class="form-group">
                <div><img height='50px' src="{{ $post->post_image }}" alt=""></div>
                <label for="file"></label>
                <input type="file" name="post_image" class="form-control" id="post_image">
            </div>

            <div class="form-group">
                <textarea name="body" class="form-control-file" id="body" cols="10" rows="5">value="{{ $post->body }}"</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @endsection
</x-admin-master>