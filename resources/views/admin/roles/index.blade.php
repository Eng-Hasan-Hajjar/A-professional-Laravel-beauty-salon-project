@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">الأدوار</h2>
    <a href="{{ route('roles.create') }}" class="btn btn-primary float-right mb-3">إضافة دور جديد</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-right">الاسم</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td class="text-right">{{ $role->name }}</td>
                    <td class="text-right">
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-info ml-2">تعديل</a>
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline;">
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