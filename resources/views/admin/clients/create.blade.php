@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>إضافة عميل جديد</h2>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label text-right">الاسم</label>
            <input type="text" name="name" class="form-control text-right @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text-right">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control text-right @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label text-right">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control text-right @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label text-right">العنوان</label>
            <input type="text" name="address" class="form-control text-right @error('address') is-invalid @enderror" value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label text-right">تاريخ الميلاد</label>
            <input type="date" name="birth_date" class="form-control text-right @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label text-right">الجنس</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                <option value="">اختر الجنس</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>أخرى</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label text-right">ملاحظات</label>
            <textarea name="notes" class="form-control text-right @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
            @error('notes')
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
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection