@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">جداول الموظفين</h2>
    <a href="{{ route('employee-schedules.create') }}" class="btn btn-primary float-right mb-3">إضافة جدول جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الموظف</th>
                <th class="text-right">اليوم</th>
                <th class="text-right">وقت البدء</th>
                <th class="text-right">وقت الانتهاء</th>
                <th class="text-right">الحالة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td class="text-right">{{ $schedule->employee->user->name ?? '-' }}</td>
                    <td class="text-right">
                        @php
                            $days = [
                                'Monday' => 'الإثنين',
                                'Tuesday' => 'الثلاثاء',
                                'Wednesday' => 'الأربعاء',
                                'Thursday' => 'الخميس',
                                'Friday' => 'الجمعة',
                                'Saturday' => 'السبت',
                                'Sunday' => 'الأحد'
                            ];
                        @endphp
                        {{ $days[$schedule->day_of_week] ?? '-' }}
                    </td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                    <td class="text-right">{{ $schedule->status == 'active' ? 'متاح' : 'غير متاح' }}</td>
                    <td class="text-right">
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $schedule->id }}">عرض التفاصيل</button>
                        <a href="{{ route('employee-schedules.edit', $schedule) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('employee-schedules.destroy', $schedule) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for schedule details -->
                <div class="modal fade" id="detailsModal{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $schedule->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $schedule->id }}">تفاصيل الجدول: {{ $schedule->employee->user->name ?? '-' }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    <p><strong>الموظف:</strong> {{ $schedule->employee->user->name ?? '-' }}</p>
                                    <p><strong>اليوم:</strong> {{ $days[$schedule->day_of_week] ?? '-' }}</p>
                                    <p><strong>وقت البدء:</strong> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</p>
                                    <p><strong>وقت الانتهاء:</strong> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</p>
                                    <p><strong>الحالة:</strong> {{ $schedule->status == 'active' ? 'متاح' : 'غير متاح' }}</p>
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