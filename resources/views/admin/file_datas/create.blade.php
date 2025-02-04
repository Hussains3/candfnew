<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Receive File</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        <style>
            .ui-autocomplete {
                background-color: #fff;
                border: 1px solid #ccc;
                max-height: 200px;
                overflow-y: auto;
                z-index: 1000;
            }

            .ui-menu-item {
                padding: 5px 10px;
                cursor: pointer;
            }
        </style>
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">

        {{-- Form --}}
        <div class="card flex-grow max-w-2xl mx-auto">
            <div class="p-6">

                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl">Receive New File</h2>
                    <div class="">
                        <a href="{{route('dashboard')}}">
                            <button class="font-mont px-2 py-2 bg-green-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110" id="">Dashboard</button>
                        </a>

                        <a href="{{route('ie_datas.index')}}">
                            <button class="font-mont px-2 py-2 bg-indigo-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110" id="">+ New Imp/Exp</button>
                        </a>
                    </div>
                </div>

                <form class="" id="agentCreateForm" enctype="multipart/form-data" action="{{route('file_datas.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="">

                        {{-- Section One --}}
                        <div class="grid grid-cols-4 gap-4 mb-4 bg-center bg-no-repeat bg-contain bg-opacity-10 backdrop-blur-2xl" style="background-image: url('{{asset('bcnft.png')}}');">

                            <div>
                                <label for="lodgement_no" class="block mb-2">Lodgement No</label>
                                <div class="flex items-center justify-between">
                                    <span style="padding-top: 5px;padding-right: 10px">{{date('Y').'-'}}</span>
                                    <input type="text" class="form-input" id="lodgement_no" name="lodgement_no"  value="{{$next_lodgement_no}}" @role('extra') required @endrole>
                                </div>
                            </div> <!-- end -->

                            <div class="">
                            </div><!-- end -->

                            <div class="">
                                <label for="lodgement_date" class="block mb-2">Lodgement Date</label>
                                <input type="date" class="form-input skipme" id="lodgement_date" name="lodgement_date" placeholder="Lodgement Date" required value="{{ date('Y-m-d') }}">
                            </div> <!-- end -->

                            <div class="col-span-2">
                                <label for="agentain" class="block mb-2">Agent AIN</label>
                                <input type="text" class="form-input" id="agentain" name="agentain" required @role('extra') autofocus @endrole value="{{$lastagent ?? ''}}">
                            </div> <!-- end -->

                            <div class="">
                                <label for="manifest_no" class="block mb-2">Manifest No</label>
                                <input type="text" class="form-input" id="manifest_no" name="manifest_no" placeholder="Manifest No" required>

                            </div> <!-- end -->

                            <div class="">
                                <label for="manifest_date" class="block mb-2">Manifest Date</label>
                                <input type="date" class="form-input skipme" id="manifest_date" name="manifest_date" placeholder="Manifest Date" required value="{{ date('Y-m-d') }}">

                            </div> <!-- end -->

                            <div class="col-span-2">
                                <label for="impexp" class="block mb-2">Importer/Exporter</label>
                                <input type="text" class="form-input" id="impexp" name="impexp" placeholder="Importer/Exporter" @role('operator') autofocus @endrole>

                            </div> <!-- end -->


                            <div class="">
                                <label for="be_number" class="block mb-2">B/E Number</label>
                                <input type="text" class="form-input" id="be_number" name="be_number" placeholder="B/E Number" >
                            </div> <!-- end -->

                            <div class="">
                                <label for="be_date" class="block mb-2">B/E Date</label>
                                <input type="date" class="form-input skipme" id="be_date" name="be_date" placeholder="B/E Date" value="{{ date('Y-m-d') }}" @role('extra') required @endrole>
                            </div> <!-- end -->


                            <div class=" @role('extra') hidden @endrole">
                                <label for="page" class="block mb-2">Item</label>
                                <input type="number" class="form-input w-20" id="page" name="page" placeholder="Page" max="999" value="00">
                            </div> <!-- end -->
                            <div class=""></div>



                            <div class="self-end">
                                <button type="submit" class="font-mont px-10 py-4 bg-cyan-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300 hover:scale-110"
                                    id="baccountSaveBtn">Submit</button>
                            </div><!-- end -->

                            <div class="self-end">
                                <button class="font-mont px-10 py-4 bg-red-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300 hover:scale-110"
                                    id="baccountSaveBtn">Print</button>
                            </div><!-- end -->
                        </div>



                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot name="script">
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {

                // Autocomplete for Agent
                $('#agentain').autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            url: '/ainautocomplete',
                            data: { query: request.term },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 2, // Start searching after 2 characters
                    autoFocus: true, // Highlight the first suggestion
                });

                // Autocomplete for Importer/Exporter
                $('#impexp').autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            url: '/ieautocomplete',
                            data: { query: request.term },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 2, // Start searching after 2 characters
                    autoFocus: true, // Highlight the first suggestion
                });



                // Attach a keydown event listener to all input fields
                $('input').on('keydown', function(e) {
                    // Check if the Tab key is pressed (keyCode 9)
                    if (e.keyCode === 9) {
                    // Prevent the default tab behavior
                    e.preventDefault();

                    // Get all input fields in the form
                    let inputs = $('form').find('input');
                    let currentIndex = inputs.index(this); // Get the index of the current input
                    let nextIndex = currentIndex + 1;

                    // Loop through the remaining fields to find the next non-date input
                    while (nextIndex < inputs.length) {
                        let nextInput = inputs[nextIndex];
                        if (nextInput.type !== 'date') {
                        nextInput.focus(); // Focus on the next non-date input
                        break;
                        }
                        nextIndex++;
                    }
                    }
                });

                // Focus and select the input field
                $('#agentain').focus().select();
            });



        </script>
    </x-slot>

</x-app-layout>
