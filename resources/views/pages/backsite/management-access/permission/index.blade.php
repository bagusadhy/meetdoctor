@extends('layouts.app')

@section('title', 'Permission')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Permission</h3>
                <p>Manage data for Permission</p>
            </header>

            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table" id="permission-table">
                    <thead>
                        <tr class="">
                            <th>Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permission as $key => $permission_item)
                            <tr data-entry-id="{{ $permission_item->id }}">
                                <td>{{ $permission_item->title }}</td>
                            </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <th >permission</th>
                    </tfoot>
                </table>
            </div>
        </section>
    </main>

@endsection

@push('after-script')
    <script>
        $(document).ready(function () {
            
            // Setup - add a text input to each footer cell
            $('#permission-table tfoot th').each( function (i) {
                var title = $('#permission-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder="Search '+ title +'" data-index="'+i+'" style="width:100%;"/>' );
            } );

            var table = $('#permission-table').DataTable( {
                pagi
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

