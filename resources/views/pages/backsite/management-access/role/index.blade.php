@extends('layouts.app')

@section('title', 'Role')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Role</h3>
                <p>Manage data for Role</p>
            </header>

            <div class="">
                <button onclick="event.preventDefault(); $('#form-role').attr('action', '{{ route('role.store') }}');
                $('#modal-role').modal('show');" class="btn btn-primary mb-4">Add New Role</button>
            </div>

            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="">
                            <th>Tittle</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role as $r)
                                <td>{{ $r->title }}</td>
                                <td>
                                    <div class="text-center">
                                        <a href="{{ route('role.show', $r->id) }}" class="btn btn-sm btn-success">Detail</a>
                                        <a href="{{ route('role.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('role.destroy', $r->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
                                            <form action="" id="form-delete" method="post" style="display: none">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <div class="modal" tabindex="-1" id="modal-role">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form-role" method="POST">
                @csrf
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Tittle</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                        <input type="submit" class="btn btn-primary" value="add"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

