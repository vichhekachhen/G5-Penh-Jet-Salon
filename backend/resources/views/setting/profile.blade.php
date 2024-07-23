<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>
                <div class="flex flex-col md:flex-row items-center md:space-x-6">
                    <div class="bg-white shadow-md rounded my-6 p-5 flex-1 w-full md:w-2/3">
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="flex text-gray-500 mt-5 justify-center">
                                <div class="bg-white rounded-lg">
                                    <div class="" x-data="imageData()">

                                        <div x-data="imageData()" class="w-full text-center relative">
                                            <div x-show="previewUrl !== '' || imgurl !== ''"
                                                class="relative w-36 h-36 mx-auto mt-4 group">
                                                <img :src="previewUrl !== '' ? previewUrl : imgurl"
                                                    alt="Profile Image"
                                                    class="shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover">

                                                <label for="thumbnailprev"
                                                    class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full cursor-pointer">
                                                    <i class="bi bi-camera-fill text-white text-3xl mb-1"></i>
                                                    <span class="text-white mb-1 text-lg">Update Profile</span>
                                                </label>

                                                <input type="file" id="thumbnailprev" name="profile"
                                                    @change="updatePreview" class="hidden">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="name" class="text-gray-700 select-none font-medium">User Name</label>
                                <input id="name" type="text" name="name"
                                    value="{{ old('name', $user->name) }}" placeholder="Enter name"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>

                            <div class="flex flex-col space-y-2 mt-3">
                                <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                                <input id="email" type="text" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="Enter email"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>

                            <div class="flex flex-col space-y-2 mt-3">
                                <label for="phone" class="text-gray-700 select-none font-medium">Phone Number</label>
                                <input id="phone" type="number" name="phone"
                                    value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>

                            <div class="flex flex-col space-y-2 mt-3">
                                <label for="birth" class="text-gray-700 select-none font-medium">Birthday</label>
                                <input id="birth" type="date" name="birth"
                                       value="{{ old('birth', $user->birth ? \Carbon\Carbon::parse($user->birth)->format('Y-m-d') : '') }}"
                                       placeholder="Enter birthday"
                                       class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>
                            
                            


                            <div class="text-center mt-16 mb-16">
                                <button type="submit"
                                    class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
        </main>
    </div>
    </div>

    <script>
        function imageData() {
            var files = document.getElementById("thumbnailprev").files;
            if (files.length == 0) {
                var url = {!! json_encode($user->profile) !!};
            } else {
                url = '';
            }
            return {
                previewUrl: "",
                imgurl: url,
                updatePreview() {
                    var reader, files = document.getElementById("thumbnailprev").files;
                    reader = new FileReader();
                    reader.onload = e => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                clearPreview() {
                    document.getElementById("thumbnailprev").value = null;
                    this.previewUrl = "";
                    this.imgurl = "";
                }
            };
        }
    </script>
</x-app-layout>

