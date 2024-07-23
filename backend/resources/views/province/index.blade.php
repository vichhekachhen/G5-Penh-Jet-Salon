<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <div class="text-right">
        @can('Province create')
        <a href="{{route('admin.provinces.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Add Province</a>
        @endcan
      </div>

      <div class="bg-white shadow-md rounded my-6">
        <table class="text-left w-full border-collapse">
          <thead class="bg-blue-800 text-white">
            <tr>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">ID</th>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Image</th>
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-3/12">Province</th>
              @if (auth()->user()->roles[0]->name === 'admin')
              <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-4/12">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @can('Province access')
            @foreach($provinces as $key => $province)
            <tr class="hover:bg-grey-lighter">
              <td class="py-2 px-6 border-b border-grey-light">{{ $key + 1}}</td>
              <td class="py-2 px-6 border-b border-grey-light">
                @if($province->image)
                <img src="{{ $province->image }}" alt="Province Image" style="width: 45px; height: auto;">
                @else
                No Image
                @endif
              </td>
              <td class="py-2 px-6 border-b border-grey-light">{{ $province->province_name }}</td>
              @if (auth()->user()->roles[0]->name === 'admin')
              <td class="py-2 px-6 border-b border-grey-light text-right">
                @can('Province edit')
                <a href="{{route('admin.provinces.edit',$province->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                @endcan

                @can('Province delete')
                <form action="{{ route('admin.provinces.destroy', $province->id) }}" method="POST" class="inline">
                  @csrf
                  @method('delete')
                  <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                </form>
                @endcan
              </td>
              @endif
            </tr>
            @endforeach
            @endcan
          </tbody>
        </table>

        @can('Province access')
        <div class="text-right p-4 py-10">
          {{ $provinces->links() }}
        </div>
        @endcan
      </div>

    </div>
  </main>
  </div>
</x-app-layout>