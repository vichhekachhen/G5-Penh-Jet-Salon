<x-guest-layout>
    <div class="font-sans min-h-screen antialiased bg-gray-900 pt-6 pb-5">
        <div class="flex flex-col justify-center max-w-4xl sm:m-auto mx-5 mb-5 space-y-5">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="flex flex-col justify-center font-[sans-serif] p-4 ">
                <div class="max-w-md w-full mx-auto shadow-[0_2px_10px_-2px_rgba(195,169,50,0.5)] p-8 relative mt-12">
                    <div class="bg-white w-24 h-24 border-[10px] p-1.5 absolute left-0 right-0 mx-auto -top-12 rounded-full overflow-hidden">
                        <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui-short.svg" alt="logo" class='w-full inline-block' />
                        </a>
                    </div>

                    <form class="mt-12 bg-white p-8" method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-xl font-bold text-orange-500 mb-8 text-center">Create free account</h3>
                        <div class="space-y-3">
                            <input name="name" id="name" type="text" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Username" />
                            <input name="email" type="text" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter email" />
                            <input name="password" type="password" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter password" />
                            <input name="password_confirmation" id="password_confirmation" type="password" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <label for="" class="text-gray-500 text-sm">Birhtday</label>
                            <input name="birth" type="date" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <input name="shop_name" id="shop_name" type="text" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Shop Name" />
                            <label for="shop_profile" class="text-gray-500 text-sm">Upload Profile Shop:</label>
                            <input name="shop_profile" type="file" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <select id="province_id" name="province_id" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all">
                                <option selected disabled>Select Province</option>
                                @foreach($provinces as $key => $province)
                                <option value="{{$province->id}}">{{$province->province_name}}</option>
                                @endforeach
                            </select>
                            <input name="city" id="city" type="text" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Location Of Shop" />
                            <label for="qr_code" class="text-gray-500 text-sm">Upload QR Code:</label>
                            <input name="qr_code" type="file" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <div class="flex items-center">
                                <input name="gender" type="radio" value="male" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Male<a href="javascript:void(0);" class="text-orange-500 font-semibold hover:underline ml-1"></a>
                                </label>
                                <input name="gender" value="female" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Female<a href="javascript:void(0);" class="text-orange-500 font-semibold hover:underline ml-1"></a>
                                </label>
                                <input name="gender" type="radio" value="other" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Other<a href="javascript:void(0);" class="text-orange-500 font-semibold hover:underline ml-1"></a>
                                </label>
                            </div>
                        </div>



                        <div class="mt-8">
                            <button type="submit" class="w-full py-4 px-8 text-sm tracking-wide font-semibold text-white bg-blue-500 hover:bg-orange-600 focus:outline-none">
                                Create an account
                            </button>
                        </div>
                        <p class="text-sm mt-8 text-center text-gray-800">Already have an account? <a href="javascript:void(0);" class="text-orange-500 font-semibold hover:underline ml-1">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>


</x-guest-layout>