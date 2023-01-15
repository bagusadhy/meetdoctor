@extends('layouts.app')

@section('title', 'User')

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
                <h3>User</h3>
                <p>Manage data for User</p>
            </header>

            @can('user_create')
                <div class="accordion mb-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Add User
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body col-8 mx-auto">
                                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="name" class="col-sm-2 col-form-label">Name <code style="color: red">*</code></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" value="" required>
                                            @if($errors->has('name'))
                                                <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="email" class="col-sm-2 col-form-label">Email <code style="color: red">*</code></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" value="" required>
                                            @if($errors->has('email'))
                                                <p style="font-style: bold; color: red;">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-2 ">Role <code style="color:red;">*</code></label>
                                        <div class="col-sm-10">
                                            <label for="role">
                                                <span class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                <span class="btn btn-warning btn-sm deselect-all">{{ 'Delete all' }}</span>
                                            </label><br>

                                            <select name="role[]"
                                                    id="role"
                                                    class="form-control select2"
                                                    multiple="multiple" 
                                                    style="width: 200px"
                                                    required>
                                                @foreach($roles as $id => $roles)
                                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($role) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('role'))
                                                <p style="font-style: bold; color: red;">{{ $errors->first('role') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('type_user_id') ? 'has-error' : '' }}">
                                        <label class="col-sm-2 ">Type User <code style="color:red;">*</code></label>
                                        <div class="col-sm-10">
                                            <select name="type_user_id"
                                                    id="type_user_id"
                                                    class="form-control select2" 
                                                    required
                                                    style="width: 200px"
                                                    >
                                                        <option value="{{ '' }}" disabled selected>Choose</option>
                                                        @foreach($type_user as $key => $type_user_item)
                                                            <option value="{{ $type_user_item->id }}">{{ $type_user_item->name }}</option>
                                                        @endforeach
                                            </select>

                                            @if($errors->has('type_user_id'))
                                                <p style="font-style: bold; color: red;">{{ $errors->first('type_user_id') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-sm btn-primary" value="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            
            @can('user_table')            
                <div class="table-responsive shadow p-3 mb-5 bg-body  rounded">
                    <table class="table" id="user-table">
                        <thead>
                            <tr class="">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $user_item)
                                <tr data-entry-id="{{ $user_item->id }}">
                                    <td>{{ $user_item->name }}</td>
                                    <td>{{ $user_item->email }}</td>
                                    <td>
                                        @foreach ($user_item->role as $key => $item )
                                            <span class="badge bg-yellow text-dark mr-1 mb-1">{{ $item->title }}</span>
                                        @endforeach
                                    </td>
                                    <td style="width:200px;">
                                        <span class="badge bg-success mr-1 mb-1">{{ $user_item->detail_user->type_user->name ?? '' }}</span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                    {{-- show --}}

                                                    {{-- no idea, about show page --}}
                                                    {{-- <li>
                                                        @can('role_show')
                                                            <a href="{{ route('user.show', $user_item->id) }}"
                                                                data-remote=""
                                                                id="user-show"
                                                                class="dropdown-item">
                                                                Detail
                                                            </a>
                                                        @endcan
                                                        <li><hr class="dropdown-divider"></li>
                                                    </li> --}}

                                                    {{-- edit --}}
                                                    <li>
                                                        @can('role_edit')
                                                        <a href="{{ route('user.edit', $user_item->id) }}" class="dropdown-item">Edit</a>
                                                        @endcan
                                                    </li>

                                                    {{-- delete --}}
                                                    <li>
                                                        @if ($user_item->id != 1)
                                                            <li><hr class="dropdown-divider"></li>
                                                            @can('role_delete')
                                                                <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('user.destroy', $user_item->id) }}'); document.getElementById('form-delete').submit()" class="dropdown-item">Delete
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
                            @endforeach 
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
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
            
            $('.select2').select2();
            var table = $('#user-table').DataTable();

            // datatable
            // Setup - add a text input to each footer cell
            $('#user-table tfoot th').each( function (i) {
                var title = $('#user-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder="Search '+ title +'" data-index="'+i+'" style="width:100%;"/>' );
            } );


            // Filter event handler
            $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
                table
                    .column( $(this).data('index') )
                    .search( this.value )
                    .draw();
            } );


            // select2
            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change');
            });

            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change');
            });

        });
    </script>
@endpush

