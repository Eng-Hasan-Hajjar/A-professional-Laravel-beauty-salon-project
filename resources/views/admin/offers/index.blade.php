@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">العروض</h2>

                    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))


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
                                @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))

                <th class="text-right">الإجراءات</th>
                @endif
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

                                    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))

                    <td class="text-right">
                        <a href="{{ route('offers.edit', $offer) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('offers.destroy', $offer) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>

                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection