<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <div class="bg-white shadow-md rounded my-6">
        <table class="text-left w-full border-collapse">
          <thead>
            <tr>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">ID</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">User Name</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Total Price</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Date</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Action</th>
            </tr>
          </thead>
          <tbody>
            @can('Booking access')
            @foreach($bookings as $key => $booking)
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">{{ $key + 1 }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $booking->user->name }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $booking->total_price }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $booking->date }}</td>
              <td class="py-4 px-6 border-b border-grey-light">
                @can('Booking show')
                      <a href="{{route('admin.bookings.show',$booking->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-green-400">Show</a>
                @endcan
              </td>
            </tr>
            @endforeach
            @endcan
          </tbody>
        </table>

        @can('Booking access')
        <div class="text-right p-4 py-10">
          {{ $bookings->links() }}
        </div>
        @endcan
      </div>
    </div>
  </main>
</x-app-layout>
