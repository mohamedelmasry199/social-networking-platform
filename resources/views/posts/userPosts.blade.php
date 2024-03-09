<x-app-layout>
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
                    <div class="card-body">
                        <div class="h5">{{ auth()->user()->email }}</div>
                        <div class="h7 text-muted">{{ auth()->user()->name }}</div>
                        <div class="h7">{{ auth()->user()->bio }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6 gedf-main">

                <!-- Post /////-->
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
                                            <button type="submit" class="dropdown-item">Delete</button>
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

                </div>
            @endforeach
        </x-app-layout>
