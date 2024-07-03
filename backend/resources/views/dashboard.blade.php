<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <!-- <div class="container mx-auto px-6 py-8">


                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

                <p>Role : <b>
                        @foreach(auth()->user()->roles as $role)
                        {{ $role->name }}
                        @endforeach
                    </b> </p>

            </div> -->
            {{-- In your Blade view --}}


        </main>
        <div class="m-1 grid grid-cols-1 gap-4 container-fluid pt-4 px-4 md:grid-cols-2 lg:grid-cols-4">
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-blue-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg class="w-12 h-12 text-blue-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                    <path d="M480-370q51.4 0 92.7-24 41.3-24 66.3-64-34-26-74.22-39-40.21-13-85-13Q435-510 395-497t-74 39q25 40 66.3 64t92.7 24Zm.09-200q28.91 0 49.41-20.59 20.5-20.59 20.5-49.5t-20.59-49.41q-20.59-20.5-49.5-20.5t-49.41 20.59q-20.5 20.59-20.5 49.5t20.59 49.41q20.59 20.5 49.5 20.5ZM480-159q133-121 196.5-219.5T740-552q0-117.79-75.29-192.9Q589.42-820 480-820t-184.71 75.1Q220-669.79 220-552q0 75 65 173.5T480-159Zm0 79Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Owner</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{$countOwner}}</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-purple-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg class="w-12 h-12 text-purple-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                    <path d="M480-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM160-160v-94q0-38 19-65t49-41q67-30 128.5-45T480-420q62 0 123 15.5t127.92 44.69q31.3 14.13 50.19 40.97Q800-292 800-254v94H160Zm60-60h520v-34q0-16-9.5-30.5T707-306q-64-31-117-42.5T480-360q-57 0-111 11.5T252-306q-14 7-23 21.5t-9 30.5v34Zm260-321q39 0 64.5-25.5T570-631q0-39-25.5-64.5T480-721q-39 0-64.5 25.5T390-631q0 39 25.5 64.5T480-541Zm0-90Zm0 411Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Customer</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{$countCustomer}}</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-green-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg class="w-12 h-12 text-green-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                    <path d="M440-120v-60h340v-304q0-123.69-87.32-209.84Q605.36-780 480-780q-125.36 0-212.68 86.16Q180-607.69 180-484v244h-20q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v69q0 24.75-17.62 42.37Q804.75-120 780-120H440Zm-80.18-290q-12.82 0-21.32-8.68-8.5-8.67-8.5-21.5 0-12.82 8.68-21.32 8.67-8.5 21.5-8.5 12.82 0 21.32 8.68 8.5 8.67 8.5 21.5 0 12.82-8.68 21.32-8.67 8.5-21.5 8.5Zm240 0q-12.82 0-21.32-8.68-8.5-8.67-8.5-21.5 0-12.82 8.68-21.32 8.67-8.5 21.5-8.5 12.82 0 21.32 8.68 8.5 8.67 8.5 21.5 0 12.82-8.68 21.32-8.67 8.5-21.5 8.5ZM241-462q-7-106 64-182t177-76q87 0 151 57.5T711-519q-89-1-162.5-50T434.72-698Q419-618 367.5-555.5T241-462Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Service</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{$countService}}</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-pink-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg class="w-12 h-12 text-pink-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                    <path d="M725-305q-56-58-87.5-126.5T606-591q0-91 31.5-159.5T725-877l50 50q-48 51-73.5 104.5T676-591q0 78 25.5 131.5T775-355l-50 50Zm139-142q-26-28-42-65.5T806-591q0-41 16-78.5t42-65.5l50 50q-18 20-28 42.5T876-591q0 29 10 51.5t28 42.5l-50 50Zm-504 6q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM40-120v-94q0-38 19-64.5t49-41.5q51-26 120.5-43T360-380q62 0 131 17t120 43q30 15 49.5 41.5T680-214v94H40Zm60-60h520v-34q0-16-8.5-29.5T587-266q-48-27-109-40.5T360-320q-57 0-118.5 14.5T132-266q-14 7-23 21.5t-9 30.5v34Zm260-321q39 0 64.5-25.5T450-591q0-39-25.5-64.5T360-681q-39 0-64.5 25.5T270-591q0 39 25.5 64.5T360-501Zm0-90Zm0 411Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Require</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">100</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>