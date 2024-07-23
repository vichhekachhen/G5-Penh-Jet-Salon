<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <div class="text-right">
        @can('Service create')
        <a href="{{route('admin.services.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Add Service</a>
        @endcan
      </div>

      <div class="bg-white shadow-md rounded my-6">
        <table class="text-left w-full border-collapse">
          <thead>
            <tr class="bg-blue-800 text-white">
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-1/12">Image</th>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Name</th>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Price</th>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Discount</th>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Duration</th>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-3/12">Actions</th>
            </tr>
          </thead>
          <tbody>
            @can('Service access')
            @foreach($services as $key => $service)
            <tr class="hover:bg-grey-lighter">
              <td class="py-2 px-6 border-b border-grey-light">
                @if($service->image)
                <img src="{{ $service->image }}" alt="Province Image" style="width: 45px; height: auto;">
                @else
                No Image
                @endif
              </td>
              <td class="py-2 px-6 border-b border-grey-light">{{ $service->service_name }}</td>
              <td class="py-2 px-6 border-b border-grey-light">$ {{ $service->price }}</td>
              <td class="py-2 px-6 border-b border-grey-light">
                @if ($service->discount)
                $ {{ $service->discount }}
                @else
                $ 0.00
                @endif
              </td>
              <td class="py-2 px-6 border-b border-grey-light">{{ $service->duration }} mn</td>
              <td class="py-2 px-6 border-b border-grey-light">

                @can('Service show')
                <a href="{{route('admin.services.show',$service->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-green-400">Show</a>
                @endcan

                @can('Service edit')
                <a href="{{route('admin.services.edit',$service->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                @endcan

                @can('Service delete')
                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline">
                  @csrf
                  @method('delete')
                  <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                </form>
                @endcan
              </td>
            </tr>
            @endforeach
            @endcan
          </tbody>
        </table>

        @can('Service access')
        <div class="text-right p-4 py-10">
          {{ $services->links() }}
        </div>
        @endcan
      </div>

    </div>
  </main>
  </div>
</x-app-layout>