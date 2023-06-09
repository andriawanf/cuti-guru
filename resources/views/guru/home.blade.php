<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | Pengajuan Cuti</title>

    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles

</head>

<body>

    <livewire:layout.navbar />

    <livewire:layout.sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="font-roboto grid grid-cols-3 gap-4 mb-4">
                <div
                    class="flex flex-col space-y-2 items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <h1 class="font-medium text-2xl">Jabatan</h1>
                    <p class="text-2xl font-medium text-black">{{ Auth::user()->jabatan }}</p>
                </div>
                <div
                    class="flex flex-col space-y-2 items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <h1 class="font-medium text-2xl">Saldo Cuti</h1>
                    <span class="text-2xl font-medium text-black counter" data-val="{{ Auth::user()->saldo_cuti }}">
                        00</span>
                </div>
                <div
                    class="flex flex-col space-y-2 items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <h1 class="font-medium text-2xl">Riwayat Pengajuan</h1>
                    @if (Auth::user()->cuti->count() == 0)
                        <span class="text-2xl font-medium text-black">0</span>
                    @else
                        <p class="text-2xl font-medium text-black counter" data-val="{{ Auth::user()->cuti->count() }}">
                            0</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-center h-56 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
        </div>
    </div>

    <script>
        let valueDisplays = document.querySelectorAll(".counter");
        let interval = 1000;
        valueDisplays.forEach((valueDisplay) => {
            let startValue = 0;
            let endValue = parseInt(valueDisplay.getAttribute("data-val"));
            let duration = Math.floor(interval / endValue);
            let counter = setInterval(function() {
                startValue += 1;
                valueDisplay.textContent = startValue;
                if (startValue == endValue) {
                    clearInterval(counter);
                }
            }, duration);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    @livewireScripts
</body>

</html>
