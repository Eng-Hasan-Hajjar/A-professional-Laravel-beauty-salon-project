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
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $inventory->id }}">عرض التفاصيل</button>
                        <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for inventory details -->
                <div class="modal fade" id="detailsModal{{ $inventory->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $inventory->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $inventory->id }}">تفاصيل العنصر: {{ $inventory->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    @if ($inventory->image && File::exists(public_path($inventory->image)))
                                        <img src="{{ asset($inventory->image) }}" alt="{{ $inventory->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                                    @else
                                        <p><strong>الصورة:</strong> -</p>
                                    @endif
                                    <p><strong>اسم العنصر:</strong> {{ $inventory->name }}</p>
                                    <p><strong>الوصف:</strong> {{ $inventory->description ?? '-' }}</p>
                                    <p><strong>الكمية:</strong> {{ $inventory->quantity }}</p>
                                    <p><strong>سعر الوحدة:</strong> {{ number_format($inventory->unit_price, 2) }}</p>
                                    <p><strong>الحد الأدنى للمخزون:</strong> {{ $inventory->minimum_stock }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
<style>
    .table img, .modal-body img {
        border-radius: 5px;
        object-fit: cover;
    }
</style>
@endsection