<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 py-8 lg:py-12">
        <div class="container mx-auto px-6 lg:px-12">
            <a href="#" class="relative flex flex-col lg:flex-row items-center bg-white border border-gray-200 rounded-2xl shadow-2xl hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 transition-all w-full lg:max-w-6xl mx-auto">
                <img id="service-image" class="object-cover w-full lg:w-1/2 h-64 lg:h-auto rounded-t-2xl lg:rounded-t-none lg:rounded-l-2xl" src="{{$service->image}}" alt="Service Image">
                <div id="service-details" class="flex flex-col flex-grow p-6 lg:p-8">
                    <h5 id="service-name" class="mb-4 text-2xl lg:text-3xl font-bold ">Service Name: <b class="text-blue-400">{{$service->service_name}}</b></h5>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Price:</b> ${{$service->price}}</p>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Duration:</b> {{$service->duration}} h</p>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Discount:</b> ${{$service->discount}}</p>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Description:</b> {{$service->description}}</p>
                </div>
            </a>
        </div>
        <div class="container mx-auto px-6 lg:px-12 mt-6">
            <h1>card comment</h1>
            <div class="">
                @foreach ($comments as $comment)
                <div class="w-full max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 pl-3 pr-3"
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{$comment->user->profile}}" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{$comment->user->name}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{$comment->text}}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        <a href="">reply</a>
                                    </div>
                                </div>
                        </ul>
                    </div>
                </div>

                @endforeach
            </div>

        </div>
    </main>
</x-app-layout>