@extends('layouts.admin')

@section('header')
    @include('components.confirm-modal')
@endsection

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    @if($method == 'PATCH')
                        <x-breadcrumb
                            :routes='[["title" => "Book", "active" => false, "url" => "/books?page=1"], ["title" => "$book->id", "active" => false]]'></x-breadcrumb>
                    @else
                        <x-breadcrumb
                            :routes='[["title" => "Book", "active" => false, "url" => "/books?page=1"], ["title" => "Create", "active" => true]]'></x-breadcrumb>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <x-card>
                    @slot('card_header')
                        {{ $method == 'PATCH' ? "Book details" : "Create book" }}
                    @endslot

                    @slot('card_sub_header')
                        {{ $book->title }}
                    @endslot

                    @slot('card_body')
                        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($method)

                            @if(session('warning'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @error('title')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('author')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('publisher')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('year_of_publishing')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            <h6 class="heading-small text-muted mb-4">Basic information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="inputGroupFileAddon01">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input accept="image/*"
                                                               aria-describedby="inputGroupFileAddon01"
                                                               class="custom-file-input"
                                                               id="input-asset"
                                                               name="asset"
                                                               type="file">
                                                        <label class="custom-file-label" for="input-asset">
                                                            Choose file
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-title">Title</label>
                                                    <input class="form-control @error('title') is-invalid @enderror"
                                                           id="input-title"
                                                           name="title"
                                                           placeholder="Title"
                                                           type="text"
                                                           value="{{ $book->title ?? '' }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-author">Author</label>
                                                    <input id="input-author"
                                                           type="text"
                                                           name="author"
                                                           class="form-control @error('author') is-invalid @enderror"
                                                           placeholder="Author"
                                                           value="{{ $book->author ?? '' }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                           for="input-publisher">Publisher</label>
                                                    <input id="input-publisher"
                                                           type="text"
                                                           name="publisher"
                                                           class="form-control @error('publisher') is-invalid @enderror"
                                                           placeholder="Publisher"
                                                           value="{{ $book->publisher ?? '' }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-category-id">
                                                        Category
                                                    </label>
                                                    <select class="form-control"
                                                            id="input-category-id"
                                                            name="category_id"
                                                        {{ count(\App\Models\Category::all()) == 0 ? 'disabled' : '' }}
                                                    >
                                                        @foreach(\App\Models\Category::all() as $category)
                                                            <option
                                                                value="{{ $category->id }}"
                                                                {{ $category->id == $book->category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 text-center align-items-center">
                                        <img alt=""
                                             id="thumbnail-output"
                                             class="img-thumbnail rounded mx-auto img-fluid" style="max-height: 400px"
                                             src="{{ asset(is_null($book->image) ? 'img/no-img.jpg' : "storage/books/$book->image") }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-pages">
                                                Pages
                                            </label>
                                            <input type="number"
                                                   id="input-pages"
                                                   name="pages"
                                                   min="0"
                                                   required
                                                   class="form-control @error('pages') is-invalid @enderror"
                                                   placeholder="Pages counts"
                                                   value="{{ $book->pages ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-year-of-publishing">
                                                Year of publishing
                                            </label>
                                            <input type="number"
                                                   id="input-year-of-publishing"
                                                   name="year_of_publishing"
                                                   class="form-control @error('year_of_publishing') is-invalid @enderror"
                                                   min="0"
                                                   required
                                                   max="{{ date('Y') }}"
                                                   placeholder="Year Of Publishing"
                                                   value="{{ $book->year_of_publishing ?? date('Y') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-price">
                                                Price
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number"
                                                       id="input-price"
                                                       name="price"
                                                       required
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       placeholder="Price"
                                                       min="0"
                                                       value="{{ $book->price ?? 0 }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-stock">
                                                Stock counts
                                            </label>
                                            <input type="number"
                                                   id="input-stock"
                                                   name="in_stock"
                                                   required
                                                   min="0"
                                                   class="form-control @error('in_stock') is-invalid @enderror"
                                                   placeholder="Stock Counts"
                                                   value="{{ $book->in_stock ?? 0 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">Description</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label for="input-description" class="form-control-label">Description</label>
                                    <textarea id="input-description"
                                              rows="4"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                              placeholder="A few words about the book ..."
                                    >{{ $book->description ?? '' }}</textarea>
                                </div>

                                <div class="text-left">
                                    <button type="submit"
                                            class="btn btn-primary mt-4"
                                    >
                                        {{ $method == 'PATCH' ? 'Save changes' : 'Create' }}
                                    </button>

                                    @if($method == 'PATCH')
                                        <a href="/books/{{ $book->id }}" class="btn btn-outline-secondary mt-4">
                                            Reset default
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    @endslot
                </x-card>
            </div>
        </div>
    </div>

    <script>
        const numInputs = document.querySelectorAll('input[type=number]')

        numInputs.forEach(function (input) {
            input.addEventListener('change', function (e) {
                if (e.target.value === '') e.target.value = 0
            })
        })

        document.getElementById('input-asset').addEventListener('change', function (event) {
            const selectedFile = event.target.files[0];
            const reader = new FileReader();

            const thumbnailOutput = document.getElementById("thumbnail-output");
            thumbnailOutput.title = selectedFile.name;

            reader.onload = function (event) {
                thumbnailOutput.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);
        })

    </script>

@endsection
