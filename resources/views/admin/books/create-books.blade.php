@extends('layout.master')
@section('content')
    <div class="col-md-12 p-3 bg-white card">
        <h3>Buat Buku Baru</h3>
        <form action="{{ route('store-books') }}" method="post" enctype="multipart/form-data" class="row mt-3">
            @csrf
                <div class="col-md-6">
                    <label for="title" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Masukan judul" name="title" value="{{ old('title') }}">
                </div>
                <div class="col-md-6">
                    <label for="genre" class="form-label">Genre Buku</label>
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" placeholder="Masukan judul" name="genre" value="{{ old('genre') }}">
                </div>
                <div class="col-md-6">
                    <label for="description" class="form-label">Deskripsi Buku</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="coverFile" class="form-label">Foto Cover</label>
                    <input class="form-control @error('cover') is-invalid @enderror" type="file" name="cover" id="coverFile">
                    <div id="coverPreview"  class="col-md-12 mb-3 p-3">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="formFile" class="form-label">Foto Buku</label>
                    <input class="form-control @error('image_book') is-invalid @enderror" type="file" multiple name="image_book[]" id="formFile">
                </div>
            <div id="previewImage" class="col-md-12 mb-3 justify-content-between d-flex d-none p-3">
                <p class="form-label">Preview Gambar :</p>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Buat</button>
        </form>
    </div>
    <script src="{{ asset('jquery3.4.6.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#coverFile').on('change', function(){
                var files = $(this)[0].files;

                if(files.length > 0) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#coverPreview').html('<p class="form-label">Preview Cover :</p> </br> <img src="' +e.target.result+'" alt="Preview" style="width: 100%">');
                    };

                    reader.readAsDataURL(files[0]);
                } else {
                    $('#coverPreview').html('');
                }
            });
        });
    </script>
    <script>
        const formFile = document.getElementById('formFile');
        const previewImage = document.getElementById('previewImage');
        let selectedImage = [];

        formFile.addEventListener('change', function(event){
            previewImage.classList.remove('d-none');
            selectedImage = Array.from(event.target.files);

            selectedImage.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const image = document.createElement('img');
                    image.src = e.target.result;
                    image.classList.add('col-md-2');
                    previewImage.appendChild(image);
                }
                reader.readAsDataURL(file);
            });
        });
        
        formFile.addEventListener('click', function(){
            formFile.files = selectedImage;
        });
    </script>
@endsection