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

            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('config-payment.update', $configPayment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update Config Payment Data</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Fee</label>
                        <input type="number" class="form-control" id="fee" name="fee" value="{{ $configPayment->fee }}">
                    </div>
                    <div class="mb-5">
                        <label for="price" class="form-label">Vat</label>
                        <input type="number" class="form-control" id="vat" name="vat" value="{{ $configPayment->vat }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
            
        </section>
    </main>
@endsection

