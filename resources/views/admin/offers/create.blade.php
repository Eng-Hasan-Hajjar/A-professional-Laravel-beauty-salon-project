@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>إضافة عرض جديد</h2>
    <form action="{{ route('offers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label text-right">الاسم</label>
            <input type="text" name="name" class="form-control text-right @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label text-right">الوصف</label>
            <textarea name="description" class="form-control text-right @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="discount_percentage" class="form-label text-right">نسبة الخصم (%)</label>
            <input type="number" name="discount_percentage" step="0.01" class="form-control text-right @error('discount_percentage') is-invalid @enderror" value="{{ old('discount_percentage') }}" required>
            @error('discount_percentage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label text-right">تاريخ البدء</label>
            <input type="date" name="start_date" class="form-control text-right @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label text-right">تاريخ الانتهاء</label>
            <input type="date" name="end_date" class="form-control text-right @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" required>
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="services" class="form-label text-right">الخدمات</label>
            <select name="services[]" class="form-control @error('services') is-invalid @enderror" multiple required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
            @error('services')
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