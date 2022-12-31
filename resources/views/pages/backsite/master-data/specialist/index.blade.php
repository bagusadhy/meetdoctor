@extends('layouts.app')

@section('title', 'Specialist')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Specialist</h3>
                <p>Manage data for specialist</p>
            </header>
            <div class="">
                <button onclick="event.preventDefault(); $('#form-specialist').attr('action', '{{ route('specialist.store') }}');
                $('#modal-specialist').modal('show');" class="btn btn-primary mb-4">Add New Specialist</button>
            </div>
            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="bg-">
                            <th>Name</th>
                            <th>Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($specialist as $s)
                            <tr>
                                <td>{{ $s->name }}</td>
                                <td>Rp.{{ number_format($s['price']) }}</td>
                                <td>
                                    <div class="text-center">
                                        <a href="{{ route('specialist.show', $s->id) }}" class="btn btn-sm btn-success">Detail</a>
                                        <a href="{{ route('specialist.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('specialist.destroy', $s->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
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

    <div class="modal" tabindex="-1" id="modal-specialist">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Specialist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form-specialist" method="POST">
                @csrf
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Specialist Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Specialist Price</label>
                            <input type="number" class="form-control" id="price" name="price">
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

