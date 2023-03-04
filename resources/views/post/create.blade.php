@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('post.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    value="{{old('title')}}"
                    type="text" name="title" class="form-control" id="title" placeholder="Title">
                @error('title')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" id="content">{{old('content')}}</textarea>
                @error('content')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input
                    value="{{old('img')}}"
                    type="text" name="img" class="form-control" id="title" placeholder="Image">
                @error('img')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <label for="category" class="form-label">Category</label>
            <select class="form-select mb-3" id="category" aria-label="Default select example" name="category_id">
                @foreach($categories as $category)
                    <option
                        {{old('category_id') == $category->id ? ' selected' : ''}}
                        value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            <label for="tags" class="form-label">Tags</label>
            <select class="form-select mb-3" multiple id="tags" name="tags[]">
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

