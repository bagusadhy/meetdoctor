@extends('layouts.default')

@section('title', 'Appointment')

@section('content')
    <main class="min-h-screen">
        <!-- Best Doctors -->
            <section class="mt-4 lg:mt-16">
                <div class="mx-auto max-w-7xl px-4 lg:px-14 py-14">
                    <div class="flex justify-center">
                        <div class="text-center">
                            <h3 class="text-[#1E2B4F] text-2xl font-semibold">MeetDoctors</h3>
                            <p class="text-[#A7B0B5] mt-2">Help your life much better</p>
                        </div>
                    </div>

                   <form method="POST" action="{{ route('login') }}" class="mt-16">
                            @csrf()

                            <div class="flex justify-center">
                                <input
                                    type="text" id="search" name="search"
                                    class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                                    placeholder="Search Doctor" style="width: 50rem;"
                                    autofocus
                                />
                            </div>
                    </form>

                    <!-- Card -->
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12 lg:gap-10 mt-16 doctor">
                        @forelse ($list as $key => $doctor)
                            <a href="{{ route('appointment.doctor', $doctor->id) }}" class="group">
                                <div class="relative z-10 w-full h-[350px] rounded-2xl overflow-hidden">
                                    <img src="{{ url('storage/'.$doctor->photo) }}" class="w-full h-full bg-center bg-no-repeat object-cover object-center" alt="Doctor 1">
                                    <div class="opacity-0 group-hover:opacity-100 transition-all ease-in absolute inset-0 bg-[#0D63F3] bg-opacity-70 flex justify-center items-center">
                                        <span class="text-[#0D63F3] font-medium bg-white rounded-full px-8 py-3">Book Now</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-5">
                                    <div>
                                        <div class="text-[#1E2B4F] text-lg font-semibold">{{ $doctor->name }}</div>
                                        <div class="text-[#AFAEC3] mt-1">{{ $doctor->specialist->name }}</div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ asset('assets/frontsite/images/star.svg') }}" alt="Star">
                                        <span class="block text-[#1E2B4F] font-medium">4.5</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            {{--  --}}
                        @endforelse
                    </div>
                    <!-- End Card -->

                    <div class="not-found">

                    </div>

                </div>
            </section>
        <!-- End Best Doctors -->
      
    </main>
@endsection

@push('after-script')

    <script src='{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js') }}' integrity='sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==' crossorigin='anonymous'></script>

    <script>
        $(document).ready(function() {


            function fetch_list_doctor(query = '')
            {
                $.ajax({
                    url     : "{{ route('appointment.search.doctor') }}",
                    method  : 'GET',
                    data    : {query : query},
                    dataType: 'json',
                    success : function(data){

                        if(data.total_row > 0){
                            $('.not-found').html("")
                            $('.doctor').html(data.doctor)
                        }else{
                            $('.doctor').html("")
                            $('.not-found').html(data.doctor)
                        }
                    }
                })
            }

            $('#search').on('keyup', function(){
                var query = $(this).val();
                fetch_list_doctor(query);
            })


        });
    </script>

@endpush