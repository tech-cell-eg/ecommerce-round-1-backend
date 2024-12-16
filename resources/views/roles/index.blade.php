@extends('layouts.app')
@section('title', 'إدارة الصلاحيات')
@push('styles')
    <style>
        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }
    </style>
@endpush
@section('content')

    <div class="container-fluid px-4 py-6 bg-gray-50 min-h-screen">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">إدارة الصلاحيات</h1>
            <p class="text-gray-600">إدارة وتخصيص الصلاحيات المختلفة للمستخدمين</p>
        </div>

        <!-- جداول الأدوار -->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            @can('view-all-roles')
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-semibold text-xl text-gray-800">جميع الأدوار</h4>
                        @can('create-role')
                            <a href="{{ route('admin.roles.create') }}" class="text-blue-600 hover:text-blue-800 transition">إضافة دور جديد</a>
                        @endcan
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-gray-600">الاسم</th>
                                <th class="px-4 py-3 text-gray-600">الوصف</th>
                                <th class="px-4 py-3 text-gray-600">الصلاحيات</th>
                                <th class="px-4 py-3 text-gray-600">التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($roles as $role)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">{{ $role->name }}</td>
                                    <td class="px-4 py-3">{{ $role->description }}</td>
                                    <td class="px-4 py-3">
                                        @foreach($role->permissions as $permission)
                                            <span class="px-2 py-1 rounded-full text-xs text-white bg-green-500">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-blue-600 hover:text-blue-800 transition">تعديل</a>
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500">لا توجد أدوار حالياً</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan
        </div>

@endsection


