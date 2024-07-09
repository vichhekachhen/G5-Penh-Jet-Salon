<x-guest-layout>
    <div class="font-sans min-h-screen antialiased bg-gray-900 pt-6 pb-5">
        <div class="flex flex-col justify-center max-w-6xl sm:m-auto mx-5 mb-5 space-y-5">
            <h1 class="font-bold text-center text-4xl text-yellow-500">Penh Jet<span class="text-blue-500"> Salon</span></h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="grid grid-cols-6 gap-6 bg-white p-6">
                    <div class="col-span-6 sm:col-span-3">
                        <input type="text" name="service_name" id="service_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Enter Service Name" required="">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <input type="email" name="email" id="email" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Email" :value="old('email')" required autofocus />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <input type="password" name="password" id="password" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Password" required autocomplete="current-password" />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <input type="password" name="password" id="password" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Comfirm Password" required autocomplete="current-password" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <input type="text" name="discount" id="discount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Shop Name" required="">
                    </div>
                    <!-- <div class="col-span-6 sm:col-span-3">
                        <input type="number" name="duration" id="duration" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="$2300" required="">
                    </div> -->
                    <div class="col-span-6 sm:col-span-3">
                        <input type="file" name="image" id="image" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="$2300" required="">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <input type="file" name="image" id="image" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="$2300" required="">
                    </div>
                </div>
                <!-- <div class="flex flex-col bg-white p-10 rounded-lg shadow space-y-6">
              <h1 class="font-bold text-xl text-center">Sign in to your account</h1>

              <div class="flex flex-col space-y-1">
                <input type="email" name="email" id="email" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Email" :value="old('email')" required autofocus />
              </div>

              <div class="flex flex-col">
                <input type="password" name="password" id="password" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Password" required autocomplete="current-password"/>
              </div>
              <div class="flex flex-col-reverse sm:flex-row sm:justify-between items-center">
                <button type="submit" class=" w-full bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-700 transition-colors m-auto">Log In</button>
              </div>
              <div class="flex flex-col-reverse sm:flex-row sm:justify-between items-center mt-10">
                <span>Already registered? <a href="/" class="text-blue-600">Sign In</a></span>
              </div>
            </div> -->
            </form>
            <div class="flex justify-center text-gray-500 text-sm">
                <p>Copyright by Penh Jet Salon <script>
                        document.write(new Date().getFullYear());
                    </script>
                </p>
            </div>
        </div>
    </div>

</x-guest-layout>