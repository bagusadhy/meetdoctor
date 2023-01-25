@extends('layouts.auth')

@section('title', 'Sign-in')

@section('content')
    <div class="min-h-screen">
        <div class="grid lg:grid-cols-2">
            <!-- Form-->
            <div class="px-4 lg:px-[91px] pt-10">
                <!-- Logo Brand -->
                <a href="{{ route('index') }}" class="flex-shrink-0 inline-flex items-center">
                    <img class="h-12 lg:h-16" src="{{ asset('assets/frontsite/images/logo.png') }}" alt="Meet Doctor Logo"/>
                </a>

                <div class="flex flex-col justify-center py-14 h-screen lg:min-h-screen">
                    <h2 class="text-[#1E2B4F] text-4xl font-semibold leading-normal">
                    Improve Your <br />
                    Health With Expert
                    </h2>
                    <div class="mt-12">

                        @if (session('status'))
                            <div class="p-7 text-base" style="background-color: rgb(254, 226, 226); color:rgb(185, 28, 28)" role="alert">
                                <ul>
                                    <li style="color:rgb(185, 28, 28)">{{ session('status') }}</li>
                                </ul>
                            </div>
                        @endif

                        <!-- Form input -->
                        <form method="POST" action="{{ route('login') }}" class="grid gap-6 mt-6">
                            @csrf()
                            <label class="block">
                                <input
                                    type="email" id="email" name="email"
                                    class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                                    placeholder="Email Address" value="{{ old('email') }}" required autofocus
                                />
                                @if ($errors->has('email'))
                                    <p class="text-red mb-3 text-sm">{{ $errors->first('email') }}</p>
                                @endif
                            </label>

                            <label class="block">
                                <input
                                    type="password" id="password" name="password"
                                    class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                                    placeholder="Password" required
                                />
                                @if ($errors->has('password'))
                                    <p class="text-red mb-3 text-sm">{{ $errors->first('password') }}</p>
                                @endif
                            </label>
                            
                            <div class="mt-10 grid gap-6">
                                <button type="submit" class="text-center text-white text-lg font-medium bg-[#0D63F3] px-10 py-4 rounded-full">
                                Sign In</button>
                                <a href="{{ route('register') }}" class="text-center text-lg text-[#1E2B4F] font-medium bg-[#F2F6FE] px-10 py-4 rounded-full">
                                    New Account
                                </a>
                            </div>
                        </form>

                        
                        {{-- login google --}}
                        <div class="mt-8 grid gap-6">
                            <p class="text-center text-sm text-[#AFAEC3]">or</p>
                            <a href="{{ route('user.login.google') }}" class="flex gap-2 justify-center items-center text-center text-[#1E2B4F] text-lg font-medium bg-[#f8f8f8] px-10 py-4 rounded-full border border-[#141e38]">
                                <span><img
                                    src="{{ asset('assets/frontsite/images/icon-google.png') }}"
                                    class="h-[30px]"
                                    alt=""
                                /></span> 
                                Log In With Google
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Form -->

             <!-- Qoute -->
            <div class="hidden sm:block bg-[#F9FBFC]">
                <div class="flex flex-col justify-center h-full px-24 pt-10 pb-20">
                    <div class="relative">
                        <div class="relative top-0 -left-5 mb-7">
                            <img
                                src="{{ asset('assets/frontsite/images/blockqoutation.svg') }}"
                                class="h-[30px]"
                                alt=""
                            />
                        </div>
                        <p class="text-2xl leading-loose">
                            MeetDoctor telah membantu saya terhubung dengan dokter yang
                            professional dan memberikan dampak yang sangat besar kepada
                            kesehatan yang baik kepada saya
                        </p>
                        <div class="flex-shrink-0 group block mt-7">
                            <div class="flex items-center">
                                <div class="ring-1 ring-[#0D63F3] ring-offset-4 rounded-full">
                                    <img
                                        class="inline-block h-14 w-14 rounded-full"
                                        src="{{ asset('assets/frontsite/images/patient-testimonial.png') }}"
                                        alt=""
                                    />
                                </div>
                                <div div class="ml-5">
                                    <p class="font-medium text-[#1E2B4F]">Shayna</p>
                                    <p class="text-sm text-[#AFAEC3]">Product Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Qoute -->
        </div>
    </div>
@endsection