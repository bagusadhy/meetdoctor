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

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @can('consultation_create')
                <div class="">
                    <button onclick="event.preventDefault(); $('#form-consultation').attr('action', '{{ route('consultation.store') }}');
                    $('#modal-consultation').modal('show');" class="btn btn-primary mb-4">Add New Consultation</button>
                </div>
            @endcan

            @can('consultation_table')
                <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <table class="table" id="consultation-table">
                        <thead>
                            <tr class="bg-">
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($consultation as $key => $c )
                                <tr>
                                    <td>{{ $c->name }}</td>
                                    <td>
                                        <div class="text-center">

                                            @can('consultation_show')
                                                <a href="{{ route('consultation.show', $c->id) }}" class="btn btn-sm btn-success">Detail</a>
                                            @endcan

                                            @can('consultation_edit')
                                                <a href="{{ route('consultation.edit', $c->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @endcan

                                            @can('consultation_delete')
                                                <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('consultation.destroy', $c->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
                                                    <form action="" id="form-delete" method="POST" style="display: none">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>No Data</p>
                            @endforelse ($consultation as $c)
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcan
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

@push('after-script')
    <script>
        $(document).ready(function () {
            
            $('.select2').select2();
            var table = $('#consultation-table').DataTable();

            // datatable
            // Setup - add a text input to each footer cell
            $('#consultation-table tfoot th').each( function (i) {
                var title = $('#consultation-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder="Search '+ title +'" data-index="'+i+'" style="width:100%;"/>' );
            } );


            // Filter event handler
            $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
                table
                    .column( $(this).data('index') )
                    .search( this.value )
                    .draw();
            } );
        });
    </script>
@endpush

