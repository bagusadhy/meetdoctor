@extends('layouts.app')

@section('title', 'Doctor')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">

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
                <a href="{{ route('doctor.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> User</h3>
                </a>
                <p>Manage data for Doctor</p>
            </header>

            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update Doctor Data</h4>
                    <hr>
                    <div class="col-8 mx-auto">

                        <div class="form-group row mb-3">
                            <label class="col-sm-2 label-control" for="name">Name <code style="color:red;">*</code></label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control" placeholder="example John Doe or Jane" value="{{ old('name', isset($doctor) ? $doctor->name : '') }}" autocomplete="off" required>
    
                                @if($errors->has('name'))
                                    <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
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
                                        <option value="{{ $specialist_item->id }}" {{ $specialist_item->id == $doctor->specialist->id ? 'selected' : '' }}>{{ $specialist_item->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('specialist'))
                                    <p style="font-style: bold; color: red;">{{ $errors->first('specialist') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 form-group row">
                            <label for="name" class="form-label col-sm-2">Fee <code style="color:red;">*</code></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('fee', isset($specialist) ? $doctor->fee : '') }}" id="fee" name="fee" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'Rp. ', 'placeholder': '0'" required>
                                @if($errors->has('fee'))
                                <p style="font-style: bold; color: red;">{{ $errors->first('fee') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="file" accept="image/png, image/svg, image/jpeg" class="" id="photo" name="photo">
                            <p class=""><small class="" style="color: red;">Hanya dapat mengunggah 1 file</small><small> dan yang dapat digunakan JPEG, SVG, PNG & Maksimal ukuran file hanya 10 MegaBytes</small></p>
                            @if($errors->has('photo'))
                                <p style="font-style: bold; color: red;">{{ $errors->first('photo') }}</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            
        </section>
    </main>
@endsection

@push('after-script')

     {{-- inputmask --}}
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/bindings/inputmask.binding.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $(":input").inputmask();

        });
    </script>
@endpush

