@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">ربط الخدمات بالمواعيد</h2>
    <a href="{{ route('appointment-services.create') }}" class="btn btn-primary float-right mb-3">إضافة ربط خدمة بموعد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الموعد (العميل)</th>
                <th class="text-right">الخدمة</th>
                <th class="text-right">السعر</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointmentServices as $appointmentService)
                <tr>
                    <td class="text-right">{{ $appointmentService->appointment->client->name ?? '-' }} ({{ \Carbon\Carbon::parse($appointmentService->appointment->start_time)->format('Y-m-d H:i') }})</td>
                    <td class="text-right">{{ $appointmentService->service->name ?? '-' }}</td>
                    <td class="text-right">{{ number_format($appointmentService->price, 2) }}</td>
                    <td class="text-right">
                        <a href="{{ route('appointment-services.edit', $appointmentService) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('appointment-services.destroy', $appointmentService) }}" method="POST" class="d-inline">
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