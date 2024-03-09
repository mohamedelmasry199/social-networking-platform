<link href="{{asset('styles/posts.css')}}" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

<nav class="navbar navbar-light bg-white">
        <a href="#" class="navbar-brand">my website</a>
        <form action="{{ route('users.search') }}" method="GET" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" id="searchInput" name="query">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>


    </nav>


    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body" >

                        <a href="{{ route('profile.show', ['id' => auth()->user()->id]) }}">{{ auth()->user()->email }}</a>
                        <div class="h7 text-muted">
                            <a href="{{ route('profile.show', ['id' => auth()->user()->id]) }}">{{ auth()->user()->name }}</a>
                        </div>
                        <div class="h7">{{ auth()->user()->bio }}
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('friends.display',['userId'=>auth()->user()->id]) }}">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Friends</div>
                            <div class="h5">{{ $friendsNumber }}</div>
                        </li>
                        <a href="{{ route('friend_requests.index') }}">
                            <li class="list-group-item">
                                <div class="h6 text-muted">requests</div>
                                <div class="h5">{{ $requestsNumber }}</div>
                            </li>
                        </a>

                    </ul>
                    <a href="{{ route('post.create') }}">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Create Post</div>
                        </li>
                    </a>

                </div>
            </div>
            <div class="col-md-6 gedf-main">

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                @foreach ($posts as $post)
                <div class="card gedf-card">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- User information -->
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- User profile picture -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">
                                        <img class="rounded-circle" width="45" src="{{ asset('storage/'.$post->user->profile_picture) }}" alt="Profile Picture">
                                    </a>
                                </div>
                                <!-- User name and email -->
                                <div class="ml-2">
                                    <div class="h5 m-0">
                                        <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">{{ $post->user->email }}</a>
                                    </div>
                                    <div class="h7 text-muted">
                                        <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Dropdown menu -->
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        @if (auth()->user()->id == $post->user_id)
                                            <a class="dropdown-item" href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                                        @endif
                                        @if (auth()->user()->id == $post->user_id)
                                        <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger">Delete</button>
                                        </form>
                                    @endif

                                        <a class="dropdown-item" href="#">Hide</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Post image -->
                        @if ($post->image!='null')
    <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" style="width: 650px; height: 650px;" alt="Post Image">
@endif


                        <!-- Post information -->
                        <div class="text-muted h7 mb-2">
                            <i class="fa fa-clock-o"></i> {{ $post->created_at }}
                        </div>
                        <a class="card-link" href="#">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </a>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer">
                        <div class="card-footer">
                            <a href="#" class="card-link likeButton" data-post-id="{{ $post->id }}"><i class="fa fa-gittip"></i> Like</a>
                        </div>
                        <a href="{{ route('post.likes', $post) }}" class="btn btn-link card-link" id="toggleComments"><i class="fa fa-comment"></i> Likes</a>
                             <a href="{{ route('comments.index', $post) }}" class="btn btn-link card-link" id="toggleComments"><i class="fa fa-comment"></i> Comments</a>
                        <form action="{{ route('comments.store', $post) }}" method="post" class="comment-form row">
                            @csrf
                            <div class="form-group col">
                                <textarea name="content" class="form-control" rows="3" placeholder="Write your comment here"></textarea>
                            </div>
                            <div class="form-group col-auto mt-2"> <!-- Adjust the top margin here -->
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </div>
                        </form>
                    </div>


                </div>


                @endforeach

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function(){
                        $('[data-post-id]').each(function(){
                            var post_id = $(this).data("post-id");
                            var liked = localStorage.getItem('liked_' + post_id);
                            if(liked){
                                $(this).addClass('liked').css("color", "red").text("Liked by you");
                            } else {
                                $(this).css("color", "blue").text("Like");
                            }
                        });

                        $(".likeButton").click(function(e){
                            e.preventDefault();
                            var post_id = $(this).data("post-id");
                            var url = "{{ route('like.store') }}";
                            var button = $(this);

                            var isLiked = button.hasClass('liked');

                            $.ajax({
                                type: "POST",
                                url: url,
                                data: { post_id: post_id, _token: '{{ csrf_token() }}' },
                                success: function(response){
                                    console.log(response);
                                    if (isLiked) {
                                        button.removeClass('liked').css("color", "blue").text("Like");
                                        localStorage.removeItem('liked_' + post_id);
                                    } else {
                                        button.addClass('liked').css("color", "red").text("Liked by you");
                                        localStorage.setItem('liked_' + post_id, true);
                                    }
                                }
                            });
                        });
                    });
                </script>
