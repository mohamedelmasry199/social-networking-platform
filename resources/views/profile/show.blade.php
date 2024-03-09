<x-app-layout>
    <link href="{{ asset('styles/profileShow.css') }}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
                <div class="well profile">
                    <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-8">
                            <h2>{{ $user->name }}</h2>
                            <p><strong>About: </strong> {{ $user->bio }} </p>
                        </div>
                        <div class="col-xs-12 col-sm-4 text-center">
                            <figure>
                                <a href="{{ asset('storage/'.$user->profile_picture) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="" class="img-circle img-responsive">
                                </a>
                            </figure>
                        </div>

                    </div>
                    <div class="col-xs-12 divider text-center">
                        @if($user->id !== auth()->user()->id)
                            <div class="col-xs-12 col-sm-4 emphasis">
                                <h2><strong>{{ $friendsNumber }}</strong></h2>
                                <p><small>Friends</small></p>
                                <form method="POST" action="{{ route('sendFriendRequest') }}">
                                    @csrf
                                    <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Add Friend</button>
                                </form>
                            </div>

                        @else
                        <h2><strong>Your Profile</strong></h2>

                            <div class="col-xs-12 col-sm-4 emphasis">
                                <h2><strong>you</strong></h2>
                                <p><small>welcome</small></p>
                                <a href="{{ route('profile.edit', ['id' => auth()->user()->id]) }}" class="btn btn-info btn-block"><span class="fa fa-user"></span> Edit Profile</a>
                            </div>
                        @endif
                        <div class="col-xs-12 col-sm-4 emphasis">
                            <h2><strong>245</strong></h2>
                            <p><small>Following</small></p>
                            <button class="btn btn-info btn-block"><span class="fa fa-user"></span></button>
                        </div>
                        <div class="col-xs-12 col-sm-4 emphasis">
                            <h2><strong>43</strong></h2>
                            <p><small>Snippets</small></p>
                            <div class="btn-group dropup btn-block">
                                <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu text-left" role="menu">
                                    <li><a href="#"><span class="fa fa-envelope pull-right"></span> Send an email </a></li>
                                    <li><a href="#"><span class="fa fa-list pull-right"></span> Add or remove from a list  </a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><span class="fa fa-warning pull-right"></span>Report this user for spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" class="btn disabled" role="button"> Unfollow </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
