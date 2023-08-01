<div style="border: 3px solid black; background: white ">
    <h2 style="display:flex;justify-content:center; ">All posts</h2>
    @foreach($posts as $post)
        <div style="background:   #5A5A5A; padding: 10px; margin: 10px;">
            <h3 style="text-align: center;">{{ $post['title'] }}</h3>
            {{ $post['body'] }}
            <p>Category: {{ $post->category->name }}</p>
            <p>
                Tags:
                @foreach($post->tags as $tag)
                    {{ $tag->name }}
                @endforeach
            </p>
            <button style="margin-bottom: 5px;"><a href="/edit-post/{{ $post->id }}" style="text-decoration: none; color: black;">Edit</a></button>
            <br>
            
            <form action="/delete-post/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
    @endforeach
</div>
