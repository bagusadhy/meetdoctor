@extends('layouts.app')

@section('title', 'Specialist')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <a href="{{ route('specialist.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Specialist</h3>
                </a>
                <p>Manage data for specialist</p>
            </header>

            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('specialist.update', $specialist->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update Specialist Data</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Specialist Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $specialist->name }}">
                    </div>
                    <div class="mb-5">
                        <label for="price" class="form-label">Specialist Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $specialist->price }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
            
        </section>
    </main>
@endsection

