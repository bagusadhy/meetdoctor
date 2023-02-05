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
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @can('specialist_create')
                <div class="accordion mb-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Add Specialist
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body col-8 mx-auto">
                                <form action="{{ route('specialist.store') }}" id="form-specialist" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Specialist Name<code style="color: red">*</code></label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        @if($errors->has('name'))
                                            <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Specialist Price<code style="color: red">*</code></label>
                                        <input type="text" class="form-control" id="price" name="price" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'Rp.   ', 'placeholder': '0'" required>
                                        @if($errors->has('price'))
                                            <p style="font-style: bold; color: red;">{{ $errors->first('price') }}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary btn-sm" value="add" style="width: 100px"></input>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                  
                                                    {{-- show --}}
                                                    <li>
                                                        @can('specialist_show')
                                                        <a href="{{ route('specialist.show', $s->id) }}" class="dropdown-item">Detail</a>
                                                        @endcan
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    {{-- edit --}}
                                                    <li>
                                                        @can('specialist_edit')
                                                        <a href="{{ route('specialist.edit', $s->id) }}" class="dropdown-item">Edit</a>
                                                        @endcan
                                                    </li>

                                                    {{-- delete --}}
                                                    <li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        @can('specialist_delete')
                                                            <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('specialist.destroy', $s->id) }}'); document.getElementById('form-delete').submit()" class="dropdown-item">Delete
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

