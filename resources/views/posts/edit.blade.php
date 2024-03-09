    <div class="container">
    <!-- edit form column -->
    <div class="col-lg-12 text-lg-center">
        <h2>Edit post</h2>
        <br>
        <br>
    </div>
    <div class="col-lg-8 push-lg-4 personal-info">
        <form role="form" method="POST" action="{{ route('post.update', ['id' => $post->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label">Title</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="title" value="{{ $post->title }}" />
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label">Content</label>
                <div class="col-lg-9">
                    <textarea class="form-control" name="content">{{ $post->content }}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="image" class="block font-medium text-gray-700 dark:text-gray-300">{{ __('image') }}</label>
                <div class="mt-2">
                    <a href="{{ asset('storage/'.$post->image)}}" target="_blank">
                        <img src="{{ asset('storage/'.$post->image) }}" alt="Current image" class="rounded cursor-pointer" style="width: 100px; height: 100px;">
                    </a>
                </div>
                <input id="image" name="image" type="file" class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                @if ($errors->has('image'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label"></label>
                <div class="col-lg-9">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
            </div>



        </form>
    </div>
</div>
