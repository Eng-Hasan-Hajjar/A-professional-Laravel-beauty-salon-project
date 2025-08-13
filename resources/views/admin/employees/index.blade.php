@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">الموظفون</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary float-right mb-3">إضافة موظف جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">الصورة</th>
                <th class="text-right">اسم الموظف</th>
                <th class="text-right">التخصص</th>
                <th class="text-right">تاريخ التعيين</th>
                <th class="text-right">الحالة</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td class="text-right">
                        @if ($employee->image && File::exists(public_path($employee->image)))
                            <img src="{{ asset($employee->image) }}" alt="{{ $employee->user->name ?? '-' }}" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="placeholder-image" style="width: 100px; height: 100px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #adb5bd;">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                        @endif
                    </td>
                    <td class="text-right">{{ $employee->user->name ?? '-' }}</td>
                    <td class="text-right">{{ $employee->specialty }}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d') }}</td>
                    <td class="text-right">{{ $employee->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
                    <td class="text-right">
                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#detailsModal{{ $employee->id }}">عرض التفاصيل</button>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for employee details -->
                <div class="modal fade" id="detailsModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $employee->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $employee->id }}">تفاصيل الموظف: {{ $employee->user->name ?? '-' }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <div class="text-right">
                                    @if ($employee->image && File::exists(public_path($employee->image)))
                                        <img src="{{ asset($employee->image) }}" alt="{{ $employee->user->name ?? '-' }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                                    @else
                                        <p><strong>الصورة:</strong> -</p>
                                    @endif
                                    <p><strong>اسم الموظف:</strong> {{ $employee->user->name ?? '-' }}</p>
                                    <p><strong>التخصص:</strong> {{ $employee->specialty }}</p>
                                    <p><strong>تاريخ التعيين:</strong> {{ \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d') }}</p>
                                    <p><strong>الحالة:</strong> {{ $employee->status == 'active' ? 'نشط' : 'غير نشط' }}</p>
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
    .table img, .modal-body img {
        border-radius: 5px;
        object-fit: cover;
    }
</style>
@endsection