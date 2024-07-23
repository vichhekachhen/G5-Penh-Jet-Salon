<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <!-- <div class="text-right">
                    @can('User create')
                    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">New User</a>
                    @endcan
                </div> -->

                <div class="bg-white shadow-md rounded my-6">
                    <div class="flex items-center justify-between px-6 py-4">
                        <label for="role-filter" class="text-sm font-bold text-gray-600">Filter by Role:</label>
                        <select id="role-filter" class="border border-gray-300 rounded px-9 py-1">
                            <option value="">All</option>
                            <option value="admin">Admin</option>
                            <option value="owner">Owner</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <table class="text-left w-full border-collapse">
                        <thead class="bg-blue-800 text-white">
                            <tr>
                                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">User Name</th>
                                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Role</th>
                                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-1/4">Debate</th>
                                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('User access')
                            @foreach($users as $user)
                            @if(empty($selectedRole) || $user->roles->contains('id', $selectedRole))
                            <tr class="user-row @foreach($user->roles as $role) role-{{ $role->name }} @endforeach">
                                <td class="py-2 px-6 border-b border-grey-light">{{ $user->name }}</td>
                                <td class="py-2 px-6 border-b border-grey-light">
                                    @foreach($user->roles as $role)
                                    @php
                                    $colorClass = '';
                                    switch($role->name) {
                                    case 'admin':
                                    $colorClass = 'bg-blue-500';
                                    break;
                                    case 'owner':
                                    $colorClass = 'bg-pink-500';
                                    break;
                                    case 'user':
                                    $colorClass = 'bg-green-500';
                                    break;
                                    }
                                    @endphp
                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white rounded-full {{ $colorClass }}">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="py-2 px-6 border-b border-grey-light @if($user->to_admin == 0) text-green-400 @else text-red-400 @endif">$ {{ $user->to_admin }}</td>
                                <td class="py-2 px-6 border-b border-grey-light text-right">
                                    @can('User edit')
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                    @endcan

                                    @can('User delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endcan
                        </tbody>
                    </table>
                    @can('User access')
                    <div class="text-right p-4 py-10">
                        {{ $users->links() }}
                    </div>
                    @endcan
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('role-filter').addEventListener('change', function() {
            var selectedRole = this.value;
            var userRows = document.getElementsByClassName('user-row');

            for (var i = 0; i < userRows.length; i++) {
                var userRow = userRows[i];
                var roleClasses = userRow.classList;

                if (selectedRole === '' || roleClasses.contains('role-' + selectedRole)) {
                    userRow.style.display = 'table-row';
                } else {
                    userRow.style.display = 'none';
                }
            }
        });
    </script>
</x-app-layout>