@extends('base')

@section('content')
    
    <h1>Se connecter</h1>

    <div class="card mt-3">
        <div class="card-body">

            <form action="{{ route('auth.login') }}" method="POST" class="vstack gap-3">

                @csrf
            
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="password" class="form-label">Mot de Passe</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary mt-3">Se connecter</button>
            

            </form>

        </div>
    </div>

@endsection