<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History | Pengajuan Cuti</title>

    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    @livewireStyles
</head>

<body>

    <livewire:layout.navbar />

    <livewire:layout.sidebar />

    <div class="p-6 sm:ml-64 mt-14">
        <div class="flex items-center justify-between pb-4">
            <div>
                <a class="px-6 py-2.5 rounded-lg text-white bg-blue-700" href="{{ route('guru.history.pdf') }}">Export to PDF</a>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption
                    class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Riwayat Pengajuan Cuti
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Riwayat pengajuan cuti kamu
                        selama ini.</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Subcategory
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alasan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Durasi Cuti
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Mulai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal akhir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cuti as $i => $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->category->title }}
                            </th>
                            <td class="px-6 py-4">
                                @if ($item->subcategory == null)
                                    {{ 'Tidak ada subcategory' }}
                                @else
                                    {{ $item->subcategory->title }}
                                @endif
                            </td>
                            <td class="px-6 py-4 truncate">
                                {{ $item->alasan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->durasi_cuti }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->from }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->to }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->status == 'pending')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-sm dark:bg-yellow-700 dark:text-yellow-100">
                                        Pending
                                    </span>
                                @elseif($item->status == 'approved')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm dark:bg-green-700 dark:text-green-100">
                                        Approved
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm dark:bg-red-700 dark:text-red-100">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->status == 'pending')
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                @else
                                    <form action="{{route('download-pdf', ['id' => $item->id])}}" method="get">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download</button>
                                    </form>
                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7">
                                <center>Tidak Ada Data</center>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    @livewireScripts
</body>

</html>
