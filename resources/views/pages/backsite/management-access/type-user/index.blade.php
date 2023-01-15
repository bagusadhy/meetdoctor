@extends('layouts.app')

@section('title', 'Type User')

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
                <h3>Type User</h3>
                <p>Manage data for Type User</p>
            </header>


            @can('type_user_table')
                <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <table class="table" id="role-table">
                        <thead>
                            <tr class="">
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user_type as $key => $value)
                                <tr data-entry-id="{{ $value->id }}">
                                    <td>{{ $value->name }}</td>
                                </tr>
                            @empty
                                <p>No Data</p>
                            @endforelse ()
                        </tbody>
                        <tfoot>
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

