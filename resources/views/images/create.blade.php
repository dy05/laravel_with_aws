@extends('layouts.app')

@section('content')
    <h1>Upload d'image</h1>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Ajouter l'image</label>
            <input type="file" name="file" id="file" />
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-send"></i>
            Envoyer image
        </button>
    </form>
@endsection
