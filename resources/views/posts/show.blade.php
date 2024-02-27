<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <img src="{{ asset('storage/posts/'.$post->image) }}" class="w-100 rounded">
                    <hr>
                    <h4>{{ $post->title }}</h4>
                    <p class="tmt-3">
                        {!! $post->description !!}
                    </p>
                    <hr>
                    <h5>Comments</h5>
                    @foreach($post->comments as $comment)
                        <div class="card mb-2">
                            <div class="card-body">
                                <p>{{ $comment->content }}</p>
                                <small>Posted by: {{ $comment->user->name }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Tambahkan form untuk input nama pengguna -->
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            
            <div class="form-group">
                <label for="username">Your Name:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="content">Add Comment:</label>
                <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    
    </div>
</div>
