<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

                <div class="flex flex-col md:flex-row items-center md:space-x-6">

                    <div class="bg-white shadow-md rounded my-6 p-5 flex-1 w-full md:w-2/3">
                        <!-- Profile Image Card -->
                        <div x-data="imageData()" class="w-full text-center relative">
                            <div x-show="previewUrl !== '' || imgurl !== ''"
                                class="relative w-36 h-36 mx-auto mt-4 group">
                                <img src="{{ auth()->user()->profile }}" alt=""
                                    class="shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover">
                                <label for="thumbnailprev"
                                    class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full cursor-pointer">
                                    <i class="bi bi-camera-fill text-white text-3xl mb-2"></i>
                                    <span class="text-white mb-1 text-lg">Update Profile</span>
                                </label>
                                <input type="file" id="thumbnailprev" name="profile" @change="updatePreview"
                                    style="display: none;">
                            </div>
                        </div>

                        <!-- Information Form Card -->
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="flex flex-col space-y-2">
                                <label for="name" class="text-gray-700 select-none font-medium">User Name</label>
                                <input id="name" type="text" name="name"
                                    value="{{ old('name', $user->name) }}" placeholder="Enter name"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                                <input id="email" type="text" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="Enter email"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>


                            <div class="flex flex-col space-y-2">
                                <label for="phone" class="text-gray-700 select-none font-medium">Phone Number</label>
                                <input id="phone" type="number" name="phone"
                                    value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>


                            <!-- Hidden field to send image data -->
                            <input type="hidden" name="profile_image" :value="previewUrl" />

                            <div class="text-center mt-16 mb-16">
                                <button type="submit"
                                    class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    previewUrl: "",
                    imgurl: "/images/{{ $user->profile }}", // Ensure this is correctly set
                };
            },
            methods: {
                updatePreview(event) {
                    const file = event.target.files[0];
                    const reader = new FileReader();
                    reader.onload = () => {
                        this.previewUrl = reader.result;
                    };
                    if (file) {
                        reader.readAsDataURL(file);
                    }
                },
                clearPreview() {
                    document.getElementById("thumbnailprev").value = null;
                    this.previewUrl = "";
                    this.imgurl = "/images/{{ $user->profile }}"; // Reset to default image
                }
            }
        });
        app.mount('#app');
    </script>

</x-app-layout>
