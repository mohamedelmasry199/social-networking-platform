<x-app-layout>
    <link href="{{asset('styles/friendRequests.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container bootstrap snippets bootdey">
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
        <div class="header">
            <h3 class="text-muted prj-name">
                <span class="fa fa-users fa-2x principal-title"></span>
                users
            </h3>
        </div>
        @foreach ($users as $request)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('profile.show', ['id' =>$request->id]) }}">
                    <img class="img-thumbnail" src="{{ asset('storage/'.$request->profile_picture ) }}">
                </a>
                <label class="name">
                    <a href="{{ route('profile.show', ['id' =>$request->id]) }}">{{ $request->name }}</a>
                </label>
            </div>
            @if($request->id !== auth()->user()->id)
            <form method="POST" action="{{ route('sendFriendRequest') }}">
                @csrf
                <input type="hidden" name="friend_id" value="{{ $request->id }}">
                <button type="submit" class="btn btn-sm btn-dark">
                    <span class="fa fa-plus-circle"></span> Add Friend
                </button>
            </form>
            @endif
        </li>
    @endforeach


    </ul>
</div>
</div>
</x-app-layout>
