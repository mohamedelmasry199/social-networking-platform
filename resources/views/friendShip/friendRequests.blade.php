<x-app-layout>
    <link href="{{asset('styles/friendRequests.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container bootstrap snippets bootdey">
        <div class="header">
            <h3 class="text-muted prj-name">
                <span class="fa fa-users fa-2x principal-title"></span>
                Friend requests
            </h3>
        </div>
        @foreach ($friendRequests as $request)
        <li class="list-group-item text-left">
            <img class="img-thumbnail" src="{{ asset('storage/'.$request->user->profile_picture ) }}">
            <label class="name">
                {{ $request->user->name }}<br>
            </label>
            <div class="pull-right">
                <form action="{{ route('friend-requests.accept', ['friendshipId' => $request->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success btn-xs" title="Accept"><i class="fa fa-check"></i></button>
                </form>
                                <form action="{{ route('friend-requests.delete', ['friendshipId' => $request->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-xs" title="Reject"><i class="fa fa-trash"></i></button>
                </form>


                <a href="#" class="btn btn-info btn-xs" title="Message"><i class="fa fa-comment"></i></a>
            </div>
            <div class="clearfix"></div> <!-- Add clearfix to clear float -->
        </li>
        @endforeach
    </ul>
</div>
</div>
</x-app-layout>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script>
    $(document).ready(function () {
        // Accept friend request
        $('.accept-request').click(function (e) {
            e.preventDefault();
            var friendshipId = $(this).data('friendship-id');
            $.ajax({
                type: 'POST',
                url: '/accept-friend-request/' + friendshipId,
                data: {
                    _token: '{{ csrf_token() }}',
                    friendship_id: friendshipId
                },
                success: function (response) {
                    // Handle success response
                    alert(response.success);
                    // Reload the page
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });

        // Reject friend request
        $('.reject-request').click(function (e) {
            e.preventDefault();
            var friendshipId = $(this).data('friendship-id');
            $.ajax({
                type: 'POST',
                url: '/delete-friend-request/' + friendshipId,
                data: {
                    _token: '{{ csrf_token() }}',
                    friendship_id: friendshipId
                },
                success: function (response) {
                    // Handle success response
                    alert(response.success);
                    // Reload the page
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> --}}
