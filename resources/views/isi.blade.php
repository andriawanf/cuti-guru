<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

</head>

<body>
    @if ($id == 1)
        <div class="mb-3 row">
            <label class="form-label">Tanggal Cuti</label>


            <div date-rangepicker class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="start" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date start">
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
                    <input name="end" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date end">
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
    @elseif($id == 2)
        <div class="mb-3 row">
            <label id="subcategory" class="form-label">Kategori Cuti</label>
            <div class="col-md-12">
                <select name="subcategory" id="subcategory" class="form-select">
                    <option value="0">Pilih Kategori</option>
                    @foreach ($subcategory as $val)
                        <option value="{{ $val->id }}">{{ $val->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="form-label">Tanggal Cuti</label>
            <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-m-dd"
                data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                <input type="text" class="form-control" name="from" placeholder="Tanggal Mulai" />
                <input type="text" class="form-control" name="to" placeholder="Tanggal Akhir" />
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
        <div class="mb-3 row">
            <label class="form-label" id="alasan">Surat Cuti</label>
            <div class="input-group">
                <input class="form-control" type="file" name="file" placeholder="Alasan Cuti" id="alasan">
            </div>
        </div>
    @else
        <span>Silahkan Pilih Kategory</span>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</body>

</html>
