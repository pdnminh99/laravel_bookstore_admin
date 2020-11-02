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
                            :routes='[["title" => "Categories", "active" => false, "url" => "/categories?page=1"], ["title" => "$category->id", "active" => false]]'></x-breadcrumb>
                    @else
                        <x-breadcrumb
                            :routes='[["title" => "Categories", "active" => false, "url" => "/categories?page=1"], ["title" => "Create", "active" => true]]'></x-breadcrumb>
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
                        {{ $method == 'PATCH' ? "Category id $category->id" : "Create category" }}
                    @endslot

                    @slot('card_sub_header')
                        This table is for admins only
                    @endslot

                    @if($method == 'PATCH')
                        <x-table :records="$books"></x-table>

                        @if($pages > 1)
                            @slot('card_footer')
                                <x-paginator :current="$page_number" :count="$pages" route="/categories"></x-paginator>
                            @endslot
                        @endif
                    @endif

                    @slot('card_body')
                        <form action="{{ $action }}" method="POST">
                            @csrf
                            @method($method)

                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @error('name')
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
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                           id="input-title"
                                           name="name"
                                           placeholder="Name"
                                           type="text"
                                           value="{{ $category->name ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="input-description" class="form-control-label">Description</label>
                                    <textarea id="input-description"
                                              rows="4"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                              placeholder="A few words about the category ..."
                                    >{{ $category->description ?? '' }}</textarea>
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

    <script>
        const numInputs = document.querySelectorAll('input[type=number]')

        numInputs.forEach(function (input) {
            input.addEventListener('change', function (e) {
                if (e.target.value === '') e.target.value = 0
            })
        })
    </script>

@endsection
