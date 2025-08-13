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
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $appointmentService->id }}">عرض التفاصيل</button>
                        <a href="{{ route('appointment-services.edit', $appointmentService) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('appointment-services.destroy', $appointmentService) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for appointment service details -->
                <div class="modal fade" id="detailsModal{{ $appointmentService->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $appointmentService->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $appointmentService->id }}">تفاصيل ربط الخدمة بالموعد</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    <p><strong>الموعد (العميل):</strong> {{ $appointmentService->appointment->client->name ?? '-' }} ({{ \Carbon\Carbon::parse($appointmentService->appointment->start_time)->format('Y-m-d H:i') }})</p>
                                    <p><strong>الخدمة:</strong> {{ $appointmentService->service->name ?? '-' }}</p>
                                    <p><strong>السعر:</strong> {{ number_format($appointmentService->price, 2) }}</p>
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