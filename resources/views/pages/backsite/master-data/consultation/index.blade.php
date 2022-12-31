@extends('layouts.app')

@section('title', 'Consultation')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Consultation</h3>
                <p>Manage data for Consultation</p>
            </header>

             <div class="">
                <button onclick="event.preventDefault(); $('#form-consultation').attr('action', '{{ route('consultation.store') }}');
                $('#modal-consultation').modal('show');" class="btn btn-primary mb-4">Add New Consultation</button>
            </div>
            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="bg-">
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultation as $c)
                            <tr>
                                <td>{{ $c->name }}</td>
                                <td>
                                    <div class="text-center">
                                        <a href="{{ route('consultation.show', $c->id) }}" class="btn btn-sm btn-success">Detail</a>
                                        <a href="{{ route('consultation.edit', $c->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('consultation.destroy', $c->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
                                            <form action="" id="form-delete" method="POST" style="display: none">
                                                @csrf
                                                @method('delete')
                                                {{-- <input type="text" name="_method" value="DELETE"> --}}
                                            </form>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- {{ die; }} --}}
                    </tbody>
                </table>
            </div>
        </section>
    </main>


     <div class="modal" tabindex="-1" id="modal-consultation">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form-consultation" method="POST">
                @csrf
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Consultation Name</label>
                            <input type="text" class="form-control" id="name" name="name">
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

