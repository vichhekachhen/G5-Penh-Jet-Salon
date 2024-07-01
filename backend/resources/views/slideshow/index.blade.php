<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <div class="text-right">
        @can('Slideshow create')
        <a href="{{route('admin.slideshows.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Add Slideshow</a>
        @endcan
      </div>

      <div class="bg-white shadow-md rounded my-6">
        <table class="text-left w-full border-collapse">
          <thead>
            <tr>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Image</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-3/12">Title</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-4/12">Actions</th>
            </tr>
          </thead>
          <tbody>
            @can('Slideshow access')
            @foreach($slideshows as $key => $slideshow)
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">
                @if($slideshow->image)
                <img src="{{ $slideshow->image }}" alt="Province Image" style="width: 45px; height: auto;">
                @else
                No Image
                @endif
              </td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $slideshow->title }}</td>
              <td class="py-4 px-6 border-b border-grey-light text-right">

                @can('Slideshow edit')
                <a href="{{route('admin.slideshows.edit',$slideshow->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                @endcan

                @can('Slideshow delete')
                <form action="{{ route('admin.slideshows.destroy', $slideshow->id) }}" method="POST" class="inline">
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

        @can('Slideshow access')
        <div class="text-right p-4 py-10">
          {{ $slideshows->links() }}
        </div>
        @endcan
      </div>

    </div>
  </main>
  </div>
</x-app-layout>