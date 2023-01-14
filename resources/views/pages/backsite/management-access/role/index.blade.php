@extends('layouts.app')

@section('title', 'Role')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">

            {{-- errors --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <ul>
                        @foreach ($errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <header>
                <h3>Role</h3>
                <p>Manage data for Role</p>
            </header>

            @can('role_create')
                <div class="">
                    <button onclick="event.preventDefault(); $('#form-role').attr('action', '{{ route('role.store') }}');
                    $('#modal-role').modal('show');" class="btn btn-primary mb-4">Add New Role</button>
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
                                            @can('role_show')
                                                <a href="{{ route('role.show', $r->id) }}"
                                                    data-remote=""
                                                    id="role-show"
                                                    class="btn btn-sm btn-success">
                                                    Detail
                                                </a>
                                            @endcan

                                            @can('role_edit')
                                                <a href="{{ route('role.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @endcan

                                            @if ($r->id > 2)
                                                @can('role_delete')
                                                    <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('role.destroy', $r->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
                                                        <form action="" id="form-delete" method="post" style="display: none">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </button>
                                                @endcan
                                            @endif
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
            </form>
        </div>
    </div>

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

