@extends('layouts.app')

@section('title', 'Config Payment')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <a href="{{ route('config-payment.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Config Payment</h3>
                </a>
                <p>Manage data for Config Payment</p>
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

            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('config-payment.update', $configPayment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update Config Payment Data</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Fee</label>
                        <input type="text" class="form-control" id="fee" name="fee" value="{{ $configPayment->fee }}" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'Rp. ', 'placeholder': '0'" required>
                        @if($errors->has('fee'))
                            <p style="font-style: bold; color: red;">{{ $errors->first('fee') }}</p>
                        @endif
                    </div>
                    <div class="mb-5">
                        <label for="price" class="form-label">Vat</label>
                        <input type="text" class="form-control" id="vat" name="vat" value="{{ $configPayment->vat }}" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': '', 'placeholder': '0'" required>
                        @if($errors->has('vat'))
                            <p style="font-style: bold; color: red;">{{ $errors->first('vat') }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Update" class="btn btn-primary">
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
        $(document).ready(function () { 
            $(":input").inputmask();
        });
    </script>
    
@endpush