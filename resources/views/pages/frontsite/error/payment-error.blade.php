@extends('layouts.default')

@section('title', 'Payment Error')

@section('content')

    <!-- Content -->
    <div class="min-h-screen flex justify-center items-center pt-20 py-28">
        <div class="mx-auto text-center">
            <img
                src="{{ asset('assets/frontsite/images/error-ilustration.svg') }}"
                class="inline-block"
                alt="Error Ilustration"
            />
            <div class="mt-12">
                <h2 class="text-[#1E2B4F] text-2xl font-semibold">Terjadi Kesalahan</h2>
                <p class="text-[#AFAEC3] mt-4">
                    Silahkan cek kembali pembayaran anda
                </p>
                <a href="{{ route('index') }}" class="inline-block mt-10 bg-[#0D63F3] text-white rounded-full px-14 py-3">
                    Home
                </a>
            </div>
        </div>
    </div>
    <!-- End Content -->

@endsection