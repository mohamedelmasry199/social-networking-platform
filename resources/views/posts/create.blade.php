<x-app-layout>
    {{-- <div class="container mt-4">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    Create a Post
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="content" class="sr-only">Post</label>
                        <textarea class="form-control" id="content" name="content" rows="3" placeholder="What are you thinking?"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Choose image</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="btn-toolbar justify-content-between">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Share</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .create-post {
            margin-top: 3%;
            padding: 3%;
            background-color: #f8f9fa;
        }

        .create-post-heading {
            text-align: center;
            margin-top: 8%;
            margin-bottom: 3%;
            color: #495057;
        }

        .create-post-form {
            padding: 2%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12 create-post">
            <h3 class="create-post-heading">Create Post</h3>
            <form class="create-post-form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="postTitle">Title</label>
                    <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title">
                </div>
                <div class="form-group">
                    <label for="postContent">Content</label>
                    <textarea class="form-control" id="postContent" name="content" rows="5" placeholder="Enter post content"></textarea>
                </div>
                <div class="form-group">
                    <label for="postImage">Image</label>
                    <input type="file" class="form-control-file" id="postImage" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

</x-app-layout>
