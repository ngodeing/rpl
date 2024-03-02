<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <img src="{{ asset('/storage/posts/'.$post->image) }}"class="w-100 rounded">
                    <hr>
                    <h4>{{ $post->title }}</h4>
                    <p class="mt-3">{!! $post->description !!}</p>
                    <hr>
                    <h5>Comments</h5>
                    @foreach($post->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>{{ $comment->content }}</p>
                            <small>Posted by: {{ $comment->user->name }}</small>
                            <small class="text-muted"><br> Dibuat: {{ $comment->created_at->format('Y-m-d H:i:s') }}</small>
                            @if($comment->created_at != $comment->updated_at)
                                <small class="text-muted"><br> Diperbarui: {{ $comment->updated_at->format('Y-m-d H:i:s') }}</small>
                            @endif
                            <div class="mt-2">
                                <!-- Edit Comment Form -->
                                <button type="button" class="btn btn-sm btn-primary" onclick="toggleUpdateForm({{ $comment->id }})">Update</button>

                                <form id="updateForm-{{ $comment->id }}" action="{{ route('comments.update', $comment->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <textarea class="form-control" name="content" rows="2" required>{{ $comment->content }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                    <button type="button" class="btn btn-sm btn-secondary ml-2" onclick="toggleUpdateForm({{ $comment->id }})">Cancel</button>
                                </form>
                                
                                <!-- Delete Comment Form -->
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Comment Form -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h5 class="mb-3">Add a Comment</h5>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        
                        <div class="form-group">
                            <label for="username">Your Name:</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
            
                        <div class="form-group">
                            <label for="content">Comment:</label>
                            <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    function toggleUpdateForm(commentId) {
        var updateForm = document.getElementById('updateForm-' + commentId);
        updateForm.classList.toggle('d-none'); // Toggle visibility of the update form
    }
</script>
</body>
</html>
