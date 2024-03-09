<x-app-layout>
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card gedf-card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="form-group">
                            <label for="content" class="sr-only">Post</label>
                            <textarea class="form-control" id="content" name="content" rows="3" placeholder="What are you thinking?"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Upload image</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-toolbar justify-content-between">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Share</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
