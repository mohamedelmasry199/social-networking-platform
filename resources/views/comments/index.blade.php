<link href="{{asset('styles/comments.css')}}" rel="stylesheet">

<div class="container mt-5">

    <div class="row  d-flex justify-content-center">

        <div class="col-md-8">

            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h5>post comments({{ $commentsNumber }})</h5>

                <div class="buttons">


                </div>

            </div>

            @foreach ($comments as $comment)
                <div class="card p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="user d-flex flex-row align-items-center">

                            <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" width="30"
                                class="user-img rounded-circle mr-2">
                            <span><small class="font-weight-bold text-primary">{{ $comment->user->name }}</small> <small
                                    class="font-weight-bold">{{ $comment->content }}</small></span>
                        </div>


                        <small>{{ $comment->created_at }}</small>

                    </div>


                    <div class="action d-flex justify-content-between mt-2 align-items-center">

                        <div class="reply px-4">
                            <small>Remove</small>
                            <span class="dots"></span>
                            <small>Reply</small>
                            <span class="dots"></span>
                            <small>Translate</small>

                        </div>

                        <div class="icons align-items-center">

                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-check-circle-o check-icon"></i>

                        </div>

                    </div>



                </div>
            @endforeach
