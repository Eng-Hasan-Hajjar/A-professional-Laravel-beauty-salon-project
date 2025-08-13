@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">العملاء</h2>
    <a href="{{ route('clients.create') }}" class="btn btn-primary float-right mb-3">إضافة جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الاسم</th>
                <th class="text-right">البريد الإلكتروني</th>
                <th class="text-right">رقم الهاتف</th>
                <th class="text-right">العنوان</th>
                <th class="text-right">تاريخ الميلاد</th>
                <th class="text-right">الجنس</th>
                <th class="text-right">الحالة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td class="text-right">{{ $client->name }}</td>
                    <td class="text-right">{{ $client->email }}</td>
                    <td class="text-right">{{ $client->phone }}</td>
                    <td class="text-right">{{ $client->address ?? '-' }}</td>
                    <td class="text-right">{{ $client->birth_date ? \Carbon\Carbon::parse($client->birth_date)->format('Y-m-d') : '-' }}</td>
                    <td class="text-right">
                        {{ $client->gender == 'male' ? 'ذكر' : ($client->gender == 'female' ? 'أنثى' : 'أخرى') }}
                    </td>
                    <td class="text-right">{{ $client->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
                    <td class="text-right">
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $client->id }}">عرض التفاصيل</button>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for client details -->
                <div class="modal fade" id="detailsModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $client->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $client->id }}">تفاصيل العميل: {{ $client->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    <p><strong>الاسم:</strong> {{ $client->name }}</p>
                                    <p><strong>البريد الإلكتروني:</strong> {{ $client->email }}</p>
                                    <p><strong>رقم الهاتف:</strong> {{ $client->phone }}</p>
                                    <p><strong>العنوان:</strong> {{ $client->address ?? '-' }}</p>
                                    <p><strong>تاريخ الميلاد:</strong> {{ $client->birth_date ? \Carbon\Carbon::parse($client->birth_date)->format('Y-m-d') : '-' }}</p>
                                    <p><strong>الجنس:</strong> {{ $client->gender == 'male' ? 'ذكر' : ($client->gender == 'female' ? 'أنثى' : 'أخرى') }}</p>
                                    <p><strong>الحالة:</strong> {{ $client->status == 'active' ? 'نشط' : 'غير نشط' }}</p>
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