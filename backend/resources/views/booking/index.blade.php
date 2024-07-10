<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <!-- <div class="text-right">
        @can('Province create')
        <a href="{{route('admin.bookings.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Add Province</a>
        @endcan
      </div> -->

      <div class="bg-white shadow-md rounded my-6">
        <table class="text-left w-full border-collapse">
          <thead>
            <tr>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">ID</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Name</th>
            </tr>
          </thead>
          <tbody>
            @can('Booking access')
            @foreach($bookings as $key => $booking)
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">{{ $key + 1}}</td>
              <td class="py-4 px-6 border-b border-grey-light">example</td>
            </tr>
            @endforeach
            @endcan
          </tbody>
        </table>

        @can('Category access')
        <div class="text-right p-4 py-10">
          {{ $bookings->links() }}
        </div>
        @endcan
      </div>

    </div>
  </main>
  </div>
</x-app-layout>