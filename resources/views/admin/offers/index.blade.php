@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">العروض</h2>
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
        <a href="{{ route('offers.create') }}" class="btn btn-primary float-right mb-3">إضافة عرض جديد</a>
    @endif
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الاسم</th>
                <th class="text-right">الوصف</th>
                <th class="text-right">نسبة الخصم</th>
                <th class="text-right">تاريخ البدء</th>
                <th class="text-right">تاريخ الانتهاء</th>
                <th class="text-right">الخدمات</th>
                <th class="text-right">الحالة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
                <tr>
                    <td class="text-right">{{ $offer->name }}</td>
                    <td class="text-right">{{ $offer->description ?? '-' }}</td>
                    <td class="text-right">{{ number_format($offer->discount_percentage, 2) }}%</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($offer->start_date)->format('Y-m-d') }}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($offer->end_date)->format('Y-m-d') }}</td>
                    <td class="text-right">{{ $offer->services->pluck('name')->implode(', ') }}</td>
                    <td class="text-right">{{ $offer->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
                    <td class="text-right">
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $offer->id }}">عرض التفاصيل</button>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                            <a href="{{ route('offers.edit', $offer) }}" class="btn btn-warning ml-2">تعديل</a>
                            <form action="{{ route('offers.destroy', $offer) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        @endif
                    </td>
                </tr>

                <!-- Modal for offer details -->
                <div class="modal fade" id="detailsModal{{ $offer->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $offer->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $offer->id }}">تفاصيل العرض: {{ $offer->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    <p><strong>الاسم:</strong> {{ $offer->name }}</p>
                                    <p><strong>الوصف:</strong> {{ $offer->description ?? '-' }}</p>
                                    <p><strong>نسبة الخصم:</strong> {{ number_format($offer->discount_percentage, 2) }}%</p>
                                    <p><strong>تاريخ البدء:</strong> {{ \Carbon\Carbon::parse($offer->start_date)->format('Y-m-d') }}</p>
                                    <p><strong>تاريخ الانتهاء:</strong> {{ \Carbon\Carbon::parse($offer->end_date)->format('Y-m-d') }}</p>
                                    <p><strong>الخدمات:</strong> {{ $offer->services->pluck('name')->implode(', ') }}</p>
                                    <p><strong>الحالة:</strong> {{ $offer->status == 'active' ? 'نشط' : 'غير نشط' }}</p>
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