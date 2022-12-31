@extends('layouts.app')

@section('title', 'Role')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <a href="{{ route('role.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Role</h3>
                </a>
                <p>Manage data for Role</p>
            </header>

            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update Role Data</h4>
                    <div class="mb-3">
                        <label for="title" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $role->title }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
            
        </section>
    </main>
@endsection

