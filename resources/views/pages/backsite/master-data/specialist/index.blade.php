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

            @can('specialist_create')
                <div class="">
                    <button onclick="event.preventDefault(); $('#form-specialist').attr('action', '{{ route('specialist.store') }}');
                    $('#modal-specialist').modal('show');" class="btn btn-primary mb-4">Add New Specialist</button>
                </div>
            @endcan

            @can('specialist_table')
                <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <table class="table" id="specialist-table">
                        <thead>
                            <tr class="bg-">
                                <th>Name</th>
                                <th>Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($specialist as $s)
                                <tr>
                                    <td>{{ $s->name }}</td>
                                    <td>Rp.{{ number_format($s['price']) }}</td>
                                    <td>
                                        <div class="text-center">

                                            @can('specialist_show')
                                                <a href="{{ route('specialist.show', $s->id) }}" class="btn btn-sm btn-success">Detail</a>
                                            @endcan

                                            @can('specialist_edit')
                                                <a href="{{ route('specialist.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @endcan

                                            @can('specialist_delete')
                                                <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('specialist.destroy', $s->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
                                                    <form action="" id="form-delete" method="post" style="display: none">
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
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcan
           
           
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
                            @if($errors->has('name'))
                                <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Specialist Price</label>
                            <input type="text" class="form-control" id="price" name="price" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'Rp.   ', 'placeholder': '0'">
                             @if($errors->has('price'))
                                <p style="font-style: bold; color: red;">{{ $errors->first('price') }}</p>
                             @endif
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
    {{-- inputmask --}}
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/bindings/inputmask.binding.js') }}"></script>

    <script>
         $(document).ready(function () {
            
            $('.select2').select2();
            var table = $('#specialist-table').DataTable();
            $(":input").inputmask();

            // datatable
            // Setup - add a text input to each footer cell
            $('#specialist-table tfoot th').each( function (i) {
                var title = $('#specialist-table thead th').eq( $(this).index() ).text();
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

