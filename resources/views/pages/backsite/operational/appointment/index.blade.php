@extends('layouts.app')

@section('title', 'Appointment')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Appointment</h3>
                <p>Manage data for appointment</p>
            </header>
        </section>

        <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="">
                            <th>Doctor</th>
                            <th>Pasien</th>
                            <th>Consultation</th>
                            <th>Level</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointment as $a)
                                <td>
                                    <div class="text-center">
                                        <a href="{{ route('role.show', $a->id) }}" class="btn btn-sm btn-success">Detail</a>
                                        <a href="{{ route('role.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('role.destroy', $a->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
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
@endsection

