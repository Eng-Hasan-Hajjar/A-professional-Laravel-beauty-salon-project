@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل العميل</h2>
    <form action="{{ route('clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label text-right">الاسم</label>
            <input type="text" name="name" class="form-control text-right @error('name') is-invalid @enderror" value="{{ old('name', $client->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text-right">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control text-right @error('email') is-invalid @enderror" value="{{ old('email', $client->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label text-right">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control text-right @error('phone') is-invalid @enderror" value="{{ old('phone', $client->phone) }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label text-right">العنوان</label>
            <input type="text" name="address" class="form-control text-right @error('address') is-invalid @enderror" value="{{ old('address', $client->address) }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label text-right">تاريخ الميلاد</label>
            <input type="date" name="birth_date" class="form-control text-right @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $client->birth_date ? \Carbon\Carbon::parse($client->birth_date)->format('Y-m-d') : '') }}">
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label text-right">الجنس</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                <option value="">اختر الجنس</option>
                <option value="male" {{ old('gender', $client->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                <option value="female" {{ old('gender', $client->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                <option value="other" {{ old('gender', $client->gender) == 'other' ? 'selected' : '' }}>أخرى</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label text-right">ملاحظات</label>
            <textarea name="notes" class="form-control text-right @error('notes') is-invalid @enderror">{{ old('notes', $client->notes) }}</textarea>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label text-right">الحالة</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive" {{ old('status', $client->status) == 'inactive' ? 'selected' : '' }}>غير نشط</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection