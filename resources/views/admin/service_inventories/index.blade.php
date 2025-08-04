@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">ربط المخزون بالخدمات</h2>
    <a href="{{ route('service-inventories.create') }}" class="btn btn-primary float-right mb-3">إضافة ربط مخزون بخدمة</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الخدمة</th>
                <th class="text-right">عنصر المخزون</th>
                <th class="text-right">الكمية المستخدمة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serviceInventories as $serviceInventory)
                <tr>
                    <td class="text-right">{{ $serviceInventory->service->name ?? '-' }}</td>
                    <td class="text-right">{{ $serviceInventory->inventory->name ?? '-' }}</td>
                    <td class="text-right">{{ number_format($serviceInventory->quantity_used, 2) }}</td>
                    <td class="text-right">
                        <a href="{{ route('service-inventories.edit', $serviceInventory) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('service-inventories.destroy', $serviceInventory) }}" method="POST" class="d-inline">
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