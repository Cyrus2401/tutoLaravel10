<form action="" class="vstack gap-2" method="POST">

    @csrf

    <div class="form-group">
        <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </p>

    <div class="form-group">
        <textarea name="content" class="form-control" id="content">{{ old('content', $post->content) }}</textarea>
        @error('content')
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