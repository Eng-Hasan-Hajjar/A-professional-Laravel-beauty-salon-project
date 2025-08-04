@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">فئات الخدمات</h2>
    <a href="{{ route('service-categories.create') }}" class="btn btn-primary float-right mb-3">إضافة فئة خدمة جديدة</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">اسم الفئة</th>
                <th class="text-right">الوصف</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serviceCategories as $serviceCategory)
                <tr>
                    <td class="text-right">{{ $serviceCategory->name }}</td>
                    <td class="text-right">{{ $serviceCategory->description ?? '-' }}</td>
                    <td class="text-right">
                        <a href="{{ route('service-categories.edit', $serviceCategory) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('service-categories.destroy', $serviceCategory) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection