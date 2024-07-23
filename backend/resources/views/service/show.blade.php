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
    <h1>Card Comments</h1>
    <div>
        @foreach ($comments as $comment)
        <div class="w-full max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 pl-3 pr-3 mt-1">
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <!-- Comment content -->
                            <div class="flex-shrink-0">
                                <img class="w-10 h-10 rounded-full" src="{{$comment->user->profile}}" alt="{{$comment->user->name}} image">
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
                                <!-- Link to show reply form -->
                                <a href="#" class="reply-link">Reply</a>
                            </div>
                        </div>
                        <div class="reply-form hidden mt-2">
                            <!-- Reply form content -->
                            <form method="POST" action="{{ route('admin.comments.store') }}">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                <input type="hidden" name="service_id" value="{{$service->id}}">
                                <textarea name="text" id="text" class="w-full h-15 border rounded-md p-2" placeholder="Enter your reply"></textarea>
                                <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Submit
                                </button>
                            </form>
                        </div>
                        <div class="replies mt-4">
                            <!-- Display all replies for this comment -->
                            @foreach ($comment->replies as $reply)
                            <div class="bg-gray-100 border border-gray-300 rounded-md p-2 mt-2 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-10 h-10 rounded-full" src="{{$reply->owner->profile}}" alt="avt">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">{{$reply->owner->name}}</p>
                                        <p class="text-sm font-medium">{{$reply->text}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
    </main>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const replyLinks = document.querySelectorAll('.reply-link');

        replyLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parentComment = link.closest('.py-3'); // Find the closest parent comment container
                const replyForm = parentComment.querySelector('.reply-form');

                if (replyForm) {
                    const openReplyForms = document.querySelectorAll('.reply-form:not(.hidden)');
                    openReplyForms.forEach(form => {
                        if (form !== replyForm) {
                            form.classList.add('hidden');
                        }
                    });

                    replyForm.classList.toggle('hidden');
                } else {
                    console.error('Reply form not found.');
                }
            });
        });
    });
</script>