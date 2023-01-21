@extends('layouts.app')

@section('title', 'Doctor')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Doctor</h3>
                <p>Manage data for Doctor</p>
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


            @can('doctor_create')
                <div class="accordion mb-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Add Doctor
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body col-8 mx-auto">
                                <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
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

                                    <div class="mb-3 form-group row">
                                        <label class="col-sm-2">Specialist <code style="color:red;">*</code></label>
                                        <div class="col-sm-10">
                                            <select name="specialist_id"
                                                    id="specialist_id"
                                                    class="form-control select2" 
                                                    required
                                                    style="width: 200px"
                                                    >
                                                        <option value="{{ '' }}" disabled selected>Choose</option>
                                                        @foreach($specialist as $key => $specialist_item)
                                                            <option value="{{ $specialist_item->id }}">{{ $specialist_item->name }}</option>
                                                        @endforeach
                                            </select>
                                            @if($errors->has('specialist'))
                                                <p style="font-style: bold; color: red;">{{ $errors->first('specialist') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 form-group row">
                                        <label for="name" class="form-label col-sm-2">Fee</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fee" name="fee" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'Rp. ', 'placeholder': '0'" required>
                                            @if($errors->has('fee'))
                                                <p style="font-style: bold; color: red;">{{ $errors->first('fee') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <input type="file" accept="image/png, image/svg, image/jpeg" class="" id="photo" name="photo" required>
                                        <p class=""><small class="" style="color: red;">Hanya dapat mengunggah 1 file</small><small> dan yang dapat digunakan JPEG, SVG, PNG & Maksimal ukuran file hanya 10 MegaBytes</small></p>
                                        @if($errors->has('photo'))
                                            <p style="font-style: bold; color: red;">{{ $errors->first('photo') }}</p>
                                        @endif
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

            @can('doctor_table')
                <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <table class="table" id="doctor-table">
                        <thead>
                            <tr class="">
                                <th>Name</th>
                                <th>Specalist</th>
                                <th>Fee</th>
                                <th>Photo</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doctor as $key => $doctor_item)
                                <tr data-entry-id="{{ $doctor_item->id }}">
                                        <td>{{ $doctor_item->name }}</td>
                                        <td>{{ $doctor_item->specialist->name }}</td>
                                        <td>Rp.{{ number_format($doctor_item->fee) }}</td>
                                        <td><a data-fancybox="gallery" data-src="{{ request()->getSchemeAndHttpHost().'/storage'.'/'.$doctor_item->photo }}" class="">Show</a></td>

                                        <td>
                                        <div class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                    {{-- show --}}
                                                    {{-- no idea --}}
                                                    {{-- <li>
                                                        @can('doctor_show')
                                                            <a href="{{ route('doctor.show', $doctor_item->id) }}"
                                                                data-remote=""
                                                                id="doctor-show"
                                                                class="dropdown-item">
                                                                Detail
                                                            </a>
                                                        @endcan
                                                        <li><hr class="dropdown-divider"></li>
                                                    </li> --}}

                                                    {{-- edit --}}
                                                    <li>
                                                        @can('doctor_edit')
                                                            <a href="{{ route('doctor.edit', $doctor_item->id) }}" class="dropdown-item">Edit</a>
                                                        @endcan
                                                    </li>

                                                    {{-- delete --}}
                                                    <li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        @can('doctor_delete')
                                                                <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('doctor.destroy', $doctor_item->id) }}'); document.getElementById('form-delete').submit()" class="dropdown-item">Delete
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
                                {{-- <p>No Data</p> --}}
                            @endforelse
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

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">

    <style>
        .label {
            cursor: pointer;
        }
        .img-container img {
            max-width: 100%;
        }
    </style>
@endpush

@push('after-script')

    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript"></script>
    {{-- inputmask --}}
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/bindings/inputmask.binding.js') }}"></script>

    <script>
        $(document).ready(function(){
            var table = $('#doctor-table').DataTable();
            $(":input").inputmask();
            $('.select2').select2();

            // datatable
            // Setup - add a text input to each footer cell
            $('#doctor-table tfoot th').each( function (i) {
                var title = $('#doctor-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder="Search '+ title +'" data-index="'+i+'" style="width:100%;"/>' );
            } );


            // Filter event handler
            $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
                table
                    .column( $(this).data('index') )
                    .search( this.value )
                    .draw();
            } );

            // fancybox
            Fancybox.bind('[data-fancybox="gallery"]', {
                infinite: false
            });
        });
    </script>
@endpush

