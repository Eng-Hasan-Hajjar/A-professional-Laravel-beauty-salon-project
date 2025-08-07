@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>إضافة موظف جديد</h2>
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label text-right">اسم المستخدم</label>
            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                <option value="">اختر مستخدم</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="specialty" class="form-label text-right">التخصص</label>
            <input type="text" name="specialty" class="form-control text-right @error('specialty') is-invalid @enderror" value="{{ old('specialty') }}" required>
            @error('specialty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="hire_date" class="form-label text-right">تاريخ التعيين</label>
            <input type="date" name="hire_date" class="form-control text-right @error('hire_date') is-invalid @enderror" value="{{ old('hire_date') }}" required>
            @error('hire_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label text-right">الحالة</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label text-right">صورة الموظف</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection