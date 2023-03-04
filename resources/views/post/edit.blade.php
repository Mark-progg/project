@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('post.update', $post->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{$post->title}}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" id="content">{{$post->content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="text" name="img" class="form-control" id="title" value="{{$post->img}}" placeholder="Image">
            </div>
            <label for="category" class="form-label">Category</label>
            <select class="form-select mb-3" id="category" aria-label="Default select example" name="category_id">
                @foreach($categories as $category)
                    <option
                        @if($category->id === $post->category->id) selected @endif
                        value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            <label for="tags" class="form-label">Tags</label>
            <select class="form-select mb-3" multiple id="tags" name="tags[]">
                @foreach($tags as $tag)
                    <option
                        @foreach($post->tags as $postTag)
                            @if($tag->id === $postTag->id) selected @endif
                        @endforeach
                        value="{{$tag->id}}">{{$tag->title}}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

