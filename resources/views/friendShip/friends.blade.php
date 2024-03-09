<x-app-layout>
    <link href="{{asset('styles/friendRequests.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container bootstrap snippets bootdey">
        <div class="header">
            <h3 class="text-muted prj-name">
                <span class="fa fa-users fa-2x principal-title"></span>
                Friends
            </h3>
        </div>
        @foreach ($friends as $request)
        <li class="list-group-item text-left">
            <a href="{{ route('profile.show', ['id' => $request->user->id]) }}">

            <img class="img-thumbnail" src="{{ asset('storage/'.$request->user->profile_picture ) }}"> </a>
            <label class="name">
                <a href="{{ route('profile.show', ['id' => $request->user->id]) }}"> {{ $request->user->name }}</a>
               <br>
            </label>

        </li>
        @endforeach
    </ul>
</div>
</div>
</x-app-layout>
{{-- done --}}
