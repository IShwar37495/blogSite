<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="{{ asset('css/addPost.css') }}">
</head>
<body>
    <form class="form-container" id="postForm">
        @csrf
        <h2 class="form-title">Add Post</h2>
        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="error">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea id="short_description" name="short_description" rows="3">{{ old('short_description') }}</textarea>
            @if ($errors->has('short_description'))
                <span class="error">{{ $errors->first('short_description') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="long_description">Long Description</label>
            <textarea id="long_description" name="long_description" rows="5">{{ old('long_description') }}</textarea>
            @if ($errors->has('long_description'))
                <span class="error">{{ $errors->first('long_description') }}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Add</button>
        </div>
    </form>

    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <p>Post created successfully!</p>
        <button id="closePopup">Close</button>
    </div>

    <script src="{{ asset('js/addPost.js') }}"></script>
</body>
</html>

