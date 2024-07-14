<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        @can ('Booking show')
        <div class="container mx-auto px-6 py-2">
            <!-- /// -->
            <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"></h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"></p>
                </div>
            </a>
        </div>
        <p class="text-blue-500">service name ei jhg</p>
        @foreach ($services as $service)
        <p><span class="text-pink-400"> This is service </span> {{$service}}</p>
        @endforeach

        <h1 class="text-red-500">here user info</h1>

        {{$userBooking}}
        @endcan
    </main>
    </div>
</x-app-layout>