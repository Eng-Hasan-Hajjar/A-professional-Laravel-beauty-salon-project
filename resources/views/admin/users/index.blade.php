@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">المستخدمون</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary float-right mb-3">إضافة مستخدم جديد</a>
    
    @if(session('success'))
        <div class="alert alert-success text-right">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-right">الاسم</th>
                <th class="text-right">البريد الإلكتروني</th>
                <th class="text-right">الدور</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-right">{{ $user->name }}</td>
                    <td class="text-right">{{ $user->email }}</td>
                    <td class="text-right">
                        {{ $user->roles->pluck('name')->implode('، ') }}
                    </td>
                    <td class="text-right">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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