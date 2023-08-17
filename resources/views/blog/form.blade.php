<form action="" class="vstack gap-2" method="POST">

    @csrf

    <div class="form-group">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" class="form-control" id="content">{{ old('content', $post->content) }}</textarea>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <select name="category" class="form-control" id="category">
            <option value="">Sélectionner une catégorie</option>
            @foreach ($categories as $category)
                <option @selected(old('category', $post->category_id) == $category->id ) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <select name="tag[]" class="form-control" id="tag" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        @error('tag')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    
    
    <div class="form-group mt-2">
        @if($post->id)
            <button class="btn btn-primary">Modifier</button>
        @else
            <button class="btn btn-primary">Enregistrer</button>
        @endif
    </div>
</form>