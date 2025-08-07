@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">المخزون</h2>
    <a href="{{ route('inventories.create') }}" class="btn btn-primary float-right mb-3">إضافة عنصر مخزون جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الصورة</th>
                <th class="text-right">اسم العنصر</th>
                <th class="text-right">الوصف</th>
                <th class="text-right">الكمية</th>
                <th class="text-right">سعر الوحدة</th>
                <th class="text-right">الحد الأدنى للمخزون</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inventory)
                <tr>
                    <td class="text-right">
                        @if ($inventory->image && File::exists(public_path($inventory->image)))
                            <img src="{{ asset($inventory->image) }}" alt="{{ $inventory->name }}" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="placeholder-image" style="width: 100px; height: 100px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #adb5bd;">
                                <i class="fas fa-box fa-2x"></i>
                            </div>
                        @endif
                    </td>
                    <td class="text-right">{{ $inventory->name }}</td>
                    <td class="text-right">{{ $inventory->description ?? '-' }}</td>
                    <td class="text-right">{{ $inventory->quantity }}</td>
                    <td class="text-right">{{ number_format($inventory->unit_price, 2) }}</td>
                    <td class="text-right">{{ $inventory->minimum_stock }}</td>
                    <td class="text-right">
                        <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" class="d-inline">
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