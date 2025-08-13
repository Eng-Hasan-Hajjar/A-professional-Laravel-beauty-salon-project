@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">ربط المخزون بالخدمات</h2>
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
        <a href="{{ route('service-inventories.create') }}" class="btn btn-primary float-right mb-3">إضافة ربط مخزون بخدمة</a>
    @endif
    
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
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $serviceInventory->id }}">عرض التفاصيل</button>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                            <a href="{{ route('service-inventories.edit', $serviceInventory) }}" class="btn btn-warning ml-2">تعديل</a>
                            <form action="{{ route('service-inventories.destroy', $serviceInventory) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        @endif
                    </td>
                </tr>

                <!-- Modal for service inventory details -->
                <div class="modal fade" id="detailsModal{{ $serviceInventory->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $serviceInventory->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $serviceInventory->id }}">تفاصيل ربط المخزون: {{ $serviceInventory->service->name ?? '-' }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    <p><strong>الخدمة:</strong> {{ $serviceInventory->service->name ?? '-' }}</p>
                                    <p><strong>عنصر المخزون:</strong> {{ $serviceInventory->inventory->name ?? '-' }}</p>
                                    <p><strong>الكمية المستخدمة:</strong> {{ number_format($serviceInventory->quantity_used, 2) }}</p>
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
@endsection