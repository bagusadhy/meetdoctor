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

             {{-- error --}}
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

             @can('role_create')
                <div class="accordion mb-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Add Role
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body col-8 mx-auto">
                                <form action="{{ route('role.store') }}" id="form-role" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Role Title<code style="color: red">*</code></label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                        @if($errors->has('title'))
                                            <p style="font-style: bold; color: red;">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary btn-sm" style="width: 100px" value="add"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


            @can('role_table')
                <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <table class="table" id="role-table">
                        <thead>
                            <tr class="">
                                <th>Date</th>
                                <th>Tittle</th>
                                <th>Permission</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($role as $r )
                                <tr>
                                    <td>{{ $r->created_at }}</td>
                                    <td>{{ $r->title }}</td>
                                    <td>{{ count($r->permission) }} Permission</td>
                                    <td>
                                        <div class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                  
                                                    {{-- show --}}
                                                    <li>
                                                        @can('role_show')
                                                        <a href="{{ route('role.show', $r->id) }}" class="dropdown-item">Detail</a>
                                                        @endcan
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    {{-- edit --}}
                                                    <li>
                                                        @can('role_edit')
                                                        <a href="{{ route('role.edit', $r->id) }}" class="dropdown-item">Edit</a>
                                                        @endcan
                                                    </li>

                                                    {{-- delete --}}
                                                    <li>
                                                        @if ($r->id > 2)
                                                        <li><hr class="dropdown-divider"></li>
                                                        @can('role_delete')
                                                            <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('role.destroy', $r->id) }}'); document.getElementById('form-delete').submit()" class="dropdown-item">Delete
                                                                <form action="" id="form-delete" method="post" style="display: none">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </button>
                                                        @endcan
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>No Data</p>
                            @endforelse ()
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tfoot>
                    </table>
                </div>
            @endcan
        </section>
    </main>


@endsection

@push('after-script')
    <script>
        $(document).ready(function () {
            
            // Setup - add a text input to each footer cell
            $('#role-table tfoot th').each( function (i) {
                var title = $('#role-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder="Search '+ title +'" data-index="'+i+'" style="width:100%;"/>' );
            } );

            var table = $('#role-table').DataTable( {
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

