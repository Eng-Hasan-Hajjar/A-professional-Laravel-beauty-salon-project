@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">المواعيد</h2>
                    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))


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
                                @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))


                <th class="text-right">الإجراءات</th>

                @endif
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

                                    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))

                    <td class="text-right">
                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline">
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