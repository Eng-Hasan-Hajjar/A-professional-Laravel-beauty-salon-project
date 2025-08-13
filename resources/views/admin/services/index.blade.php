@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">الخدمات</h2>

    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
        <a href="{{ route('services.create') }}" class="btn btn-primary float-right mb-3">إضافة خدمة جديدة</a>
    @endif
    
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
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $service->id }}">عرض التفاصيل</button>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning ml-2">تعديل</a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        @endif
                    </td>
                </tr>

                <!-- Modal for service details -->
                <div class="modal fade" id="detailsModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $service->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $service->id }}">تفاصيل الخدمة: {{ $service->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    @if($service->image)
                                        <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" style="width: 100px; height: auto; border-radius: 5px; margin-bottom: 10px;">
                                    @else
                                        <p>الصورة: -</p>
                                    @endif
                                    <p><strong>اسم الخدمة:</strong> {{ $service->name }}</p>
                                    <p><strong>الفئة:</strong> {{ $service->category->name ?? '-' }}</p>
                                    <p><strong>السعر:</strong> {{ number_format($service->price, 2) }}</p>
                                    <p><strong>المدة (بالدقائق):</strong> {{ $service->duration }}</p>
                                    <p><strong>التوفر:</strong> {{ $service->availability == 'always' ? 'متوفر دائمًا' : ($service->availability == 'seasonal' ? 'موسمي' : 'حسب الطلب') }}</p>
                                    <p><strong>الجمهور المستهدف:</strong> {{ $service->target_audience ?? '-' }}</p>
                                    <p><strong>المتطلبات:</strong> {{ $service->requirements ?? '-' }}</p>
                                    <p><strong>مميزة:</strong> {{ $service->featured ? 'نعم' : 'لا' }}</p>
                                    <p><strong>الحالة:</strong> {{ $service->status == 'active' ? 'نشط' : 'غير نشط' }}</p>
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
    .table img {
        border-radius: 5px;
        object-fit: cover;
    }
</style>
@endsection