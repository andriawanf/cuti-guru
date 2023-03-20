<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan Cuti</title>

    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/datepicker.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>

    <form method="POST" enctype="multipart/form-data" action="{{ route('cuti.add') }}">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="uil uil-exclamation-octagon me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Kategori Cuti </label>
            <div class="col-md-9">
                <select class="form-control" name="category" id="frm_duration">
                    <option value="0">Pilih kategori</option>
                    @foreach ($categories as $value)
                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="isi"></div>
        {{-- <div id="divFrm1" class="form-group form-duration-div" style="display:none">
            <div class="mb-3 row">
                <label class="form-label">Tanggal Cuti</label>

                <div date-rangepicker datepicker-autohide datepicker-format="yyyy/mm/dd" class="flex items-center">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input name="from" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Tanggal mulai">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input name="to" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Tanggal akhir">
                    </div>
                </div>

            </div>
            <div class="mb-3 row">
                <label class="form-label" id="durasi_cuti">Durasi Cuti</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="durasi_cuti" placeholder="Durasi Cuti"
                        id="durasi_cuti">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label" id="alasan">Alasan Cuti</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="alasan" placeholder="Alasan Cuti" id="alasan">
                </div>
            </div>
        </div>

        <div id="divFrm2" class="form-group form-duration-div" style="display:none">
            <div class="mb-3 row">
                <label id="subcategory" class="form-label">Kategori Cuti</label>
                <div class="col-md-12">
                    <select name="subcategory" id="subcategory" class="form-select">
                        <option value="0">Pilih Kategori</option>
                        @foreach ($subcategories as $val)
                            <option value="{{ $val->id }}">{{ $val->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div date-rangepicker datepicker-autohide datepicker-format="yyyy/mm/dd" class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="from" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tanggal mulai">
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="to" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tanggal akhir">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label" id="durasi_cuti">Durasi Cuti</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="durasi_cuti" placeholder="Durasi Cuti"
                        id="durasi_cuti">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label" id="alasan">Alasan Cuti</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="alasan" placeholder="Alasan Cuti"
                        id="alasan">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label" id="alasan">Surat Cuti</label>
                <div class="input-group">
                    <input class="form-control" type="file" name="file" placeholder="Alasan Cuti"
                        id="alasan">
                </div>
            </div>
        </div> --}}
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#frm_duration').on('change',function() {
                var cat_id = this.value;
                $.ajax({
                    url:"{{ route('category') }}",
                    type:"GET",
                    data: {
                        cat_id: cat_id
                    },
                    success:function (data) {
                        $('#isi').html(data);
                    }
                })
            });
        });
     </script>
</body>

</html>
