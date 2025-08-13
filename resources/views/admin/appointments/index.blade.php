@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">المواعيد</h2>
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
        <a href="{{ route('appointments.create') }}" class="btn btn-primary float-right mb-3">إضافة موعد جديد</a>
    @endif
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">العميل</th>
                <th class="text-right">الموظف</th>
                <th class="text-right">وقت البدء</th>
                <th class="text-right">وقت الانتهاء</th>
                <th class="text-right">الخدمات</th>
                <th class="text-right">الحالة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td class="text-right">{{ $appointment->client->name ?? '-' }}</td>
                    <td class="text-right">{{ $appointment->employee->user->name ?? '-' }}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d H:i') }}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($appointment->end_time)->format('Y-m-d H:i') }}</td>
                    <td class="text-right">{{ $appointment->services->pluck('name')->implode(', ') }}</td>
                    <td class="text-right">
                        @php
                            $statusTranslations = [
                                'pending' => 'معلق',
                                'confirmed' => 'مؤكد',
                                'completed' => 'مكتمل',
                                'cancelled' => 'ملغى',
                            ];
                        @endphp
                        {{ $statusTranslations[$appointment->status] ?? 'معلق' }}
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $appointment->id }}">عرض التفاصيل</button>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning ml-2">تعديل</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        @endif
                    </td>
                </tr>

                <!-- Modal for appointment details -->
                <div class="modal fade" id="detailsModal{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $appointment->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $appointment->id }}">تفاصيل الموعد</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    <p><strong>العميل:</strong> {{ $appointment->client->name ?? '-' }}</p>
                                    <p><strong>الموظف:</strong> {{ $appointment->employee->user->name ?? '-' }}</p>
                                    <p><strong>وقت البدء:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d H:i') }}</p>
                                    <p><strong>وقت الانتهاء:</strong> {{ \Carbon\Carbon::parse($appointment->end_time)->format('Y-m-d H:i') }}</p>
                                    <p><strong>الخدمات:</strong> {{ $appointment->services->pluck('name')->implode(', ') }}</p>
                                    <p><strong>الحالة:</strong> {{ $statusTranslations[$appointment->status] ?? 'معلق' }}</p>
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