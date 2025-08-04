@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">الموظفون</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary float-right mb-3">إضافة موظف جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
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
                    <td class="text-right">{{ $employee->user->name ?? '-' }}</td>
                    <td class="text-right">{{ $employee->specialty }}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d') }}</td>
                    <td class="text-right">{{ $employee->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
                    <td class="text-right">
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
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