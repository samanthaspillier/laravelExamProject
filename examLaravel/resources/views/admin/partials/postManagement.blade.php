<section id="post-management" class="mb-5">
    <h3>Post Management</h3>
    <div class="card">
     
        <div class="card-body">
            <!-- Dropdown to select a post to edit -->
            <div class="mb-3">
                <select id="postDrowdown" class="form-select" onchange="window.location.href=this.value;">
                    <option value="">Select a post to edit...</option>
                    @foreach($allPosts as $post)
                        <option value="{{ route('editPost', $post->id) }}">{{ $post->title }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Table for listing latest posts -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Published</th>
                 
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->published_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('editPost', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Button to add new post -->
            <a href="{{ route('createPost') }}" class="btn btn-primary btn-sm">Add New Post</a>
        </div>
    </div>
</section>
