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
                <div class="accordion mb-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Add Consultation
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body col-8 mx-auto">
                                <form action="{{ route('consultation.store') }}" id="form-consultation" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Consultation Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                        @if($errors->has('name'))
                                            <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary" style="width: 100px" value="add"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                  
                                                    {{-- show --}}
                                                    <li>
                                                        @can('consultation_show')
                                                        <a href="{{ route('consultation.show', $c->id) }}" class="dropdown-item">Detail</a>
                                                        @endcan
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    {{-- edit --}}
                                                    <li>
                                                        @can('consultation_edit')
                                                        <a href="{{ route('consultation.edit', $c->id) }}" class="dropdown-item">Edit</a>
                                                        @endcan
                                                    </li>

                                                    {{-- delete --}}
                                                    <li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        @can('role_delete')
                                                            <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('consultation.destroy', $c->id) }}'); document.getElementById('form-delete').submit()" class="dropdown-item">Delete
                                                                <form action="" id="form-delete" method="post" style="display: none">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </button>
                                                        @endcan
                                                    </li>
                                                </ul>
                                            </div>
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

