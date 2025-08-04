@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">الإشعارات</h2>
    <a href="{{ route('notifications.create') }}" class="btn btn-primary float-right mb-3">إضافة إشعار جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">المستخدم</th>
                <th class="text-right">العميل</th>
                <th class="text-right">العنوان</th>
                <th class="text-right">الرسالة</th>
                <th class="text-right">النوع</th>
                <th class="text-right">الحالة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <td class="text-right">{{ $notification->user->name ?? '-' }}</td>
                    <td class="text-right">{{ $notification->client->name ?? '-' }}</td>
                    <td class="text-right">{{ $notification->title }}</td>
                    <td class="text-right">{{ $notification->message }}</td>
                    <td class="text-right">
                        @php
                            $typeTranslations = [
                                'appointment' => 'موعد',
                                'offer' => 'عرض',
                                'general' => 'عام',
                            ];
                        @endphp
                        {{ $typeTranslations[$notification->type] ?? 'عام' }}
                    </td>
                    <td class="text-right">
                        @php
                            $statusTranslations = [
                                'sent' => 'مرسل',
                                'pending' => 'معلق',
                                'failed' => 'فشل',
                            ];
                        @endphp
                        {{ $statusTranslations[$notification->status] ?? 'معلق' }}
                    </td>
                    <td class="text-right">
                        <a href="{{ route('notifications.edit', $notification) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="d-inline">
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