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
                            :routes='[["title" => "Book", "active" => true]]'></x-breadcrumb>
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
                        {{ $method == 'PATCH' ? "Book id $book->id" : "Create book" }}
                    @endslot

                    @slot('card_sub_header')
                        This table is for admins only
                    @endslot

                    @slot('card_body')
                        <form action="{{ $action }}" method="POST">
                        @csrf
                        @method($method)
                        <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">Thumbnails</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                   aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                </div>
                            </div>
                            <hr class="my-4"/>

                            <h6 class="heading-small text-muted mb-4">Basic information</h6>
                            <div class="pl-lg-4">
                                {{--  Add images upload here  --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-title">Title</label>
                                            <input class="form-control"
                                                   id="input-title"
                                                   placeholder="Title"
                                                   type="text"
                                                   value="{{ $book->title ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-author">Author</label>
                                            <input id="input-author"
                                                   type="text"
                                                   class="form-control"
                                                   placeholder="Author"
                                                   value="{{ $book->author ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-publisher">Publisher</label>
                                            <input id="input-publisher"
                                                   type="text"
                                                   class="form-control"
                                                   placeholder="Publisher"
                                                   value="{{ $book->publisher ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">
                                                Category
                                            </label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-pages">
                                                Pages
                                            </label>
                                            <input type="number" id="input-pages" class="form-control"
                                                   placeholder="Pages counts"
                                                   value="{{ $book->pages ?? 0 }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-year-of-publishing">
                                                Year of publishing
                                            </label>
                                            <input type="number" id="input-year-of-publishing" class="form-control"
                                                   placeholder="Year Of Publishing"
                                                   value="{{ $book->year_of_publishing ?? 1 }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">
                                                Price
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" id="input-last-name" class="form-control"
                                                       placeholder="Year Of Publishing"
                                                       value="{{ $book->price }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">
                                                Stock counts
                                            </label>
                                            <input type="number" id="input-last-name" class="form-control"
                                                   placeholder="Year Of Publishing"
                                                   value="{{ $book->in_stock }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">Description</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea rows="4" class="form-control"
                                              placeholder="A few words about the book ...">{{ $book->description ?? '' }}</textarea>
                                </div>

                                <div class="text-left">
                                    <button type="submit"
                                            class="btn btn-primary mt-4"
                                    >
                                        {{ $method == 'PATCH' ? 'Save changes' : 'Create' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endslot
                </x-card>
            </div>
        </div>
    </div>

@endsection
