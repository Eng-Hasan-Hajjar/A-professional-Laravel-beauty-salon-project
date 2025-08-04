@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">الخدمات</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary float-right mb-3">إضافة خدمة جديدة</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الصورة</th>
                <th class="text-right">اسم الخدمة</th>
                <th class="text-right">الفئة</th>
                <th class="text-right">السعر</th>
                <th class="text-right">المدة (بالدقائق)</th>
                <th class="text-right">التوفر</th>
                <th class="text-right">الجمهور المستهدف</th>
                <th class="text-right">المتطلبات</th>
                <th class="text-right">مميزة</th>
                <th class="text-right">الحالة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td class="text-right">
                        @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" style="width: 50px; height: auto;">
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td class="text-right">{{ $service->name }}</td>
                    <td class="text-right">{{ $service->category->name ?? '-' }}</td>
                    <td class="text-right">{{ number_format($service->price, 2) }}</td>
                    <td class="text-right">{{ $service->duration }}</td>
                    <td class="text-right">
                        {{ $service->availability == 'always' ? 'متوفر دائمًا' : ($service->availability == 'seasonal' ? 'موسمي' : 'حسب الطلب') }}
                    </td>
                    <td class="text-right">{{ $service->target_audience ?? '-' }}</td>
                    <td class="text-right">{{ $service->requirements ?? '-' }}</td>
                    <td class="text-right">{{ $service->featured ? 'نعم' : 'لا' }}</td>
                    <td class="text-right">{{ $service->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
                    <td class="text-right">
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
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
<style>
    .table img {
        border-radius: 5px;
        object-fit: cover;
    }
</style>
@endsection