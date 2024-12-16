@extends('layouts.app')
@section('title', 'إضافة دور جديد')

@section('content')
    <div class="container-fluid px-4 py-6 bg-gray-50 min-h-screen">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">إضافة دور جديد</h1>
            <p class="text-gray-600">قم بإضافة دور جديد مع تحديد الصلاحيات الخاصة به</p>
        </div>

        <div class="bg-white shadow-lg rounded-2xl p-6">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-600">الاسم</label>
                    <input type="text" id="name" name="name" class="mt-2 block w-full p-2 rounded-md border border-gray-300" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-semibold text-gray-600">الوصف</label>
                    <textarea id="description" name="description" rows="4" class="mt-2 block w-full p-2 rounded-md border border-gray-300"></textarea>
                </div>

                <div class="mb-4">
                    <label for="permissions" class="block text-sm font-semibold text-gray-600">الصلاحيات</label>
                    <select id="permissions" name="permissions[]" multiple class="mt-2 block w-full p-2 rounded-md border border-gray-300">
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
