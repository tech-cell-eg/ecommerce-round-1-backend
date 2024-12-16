@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-700">Manage Users</h1>
            @can('create-user')
                <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="bi bi-plus-circle"></i> Add New User
                </a>
            @endcan
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">S#</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Roles</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs">{{ $role }}</span>
                                @empty
                                    <span class="text-gray-400">No roles assigned</span>
                                @endforelse
                            </td>
                            <td class="py-3 px-6 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="text-yellow-500 hover:text-yellow-600">
                                        <i class="bi bi-eye text-lg"></i>
                                    </a>
                                    @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []) && Auth::user()->hasRole('Super Admin') || !in_array('Super Admin', $user->getRoleNames()->toArray() ?? []))
                                        @can('edit-user')
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-600">
                                                <i class="bi bi-pencil-square text-lg"></i>
                                            </a>
                                        @endcan
                                        @can('delete-user')
                                            @if (Auth::user()->id != $user->id)
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" onsubmit="return confirm('Do you want to delete this user?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-600">
                                                        <i class="bi bi-trash text-lg"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-red-500 font-bold">No User Found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection
