@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل فئة الخدمة</h2>
    <form action="{{ route('service-categories.update', $serviceCategory) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label text-right">اسم الفئة</label>
            <input type="text" name="name" class="form-control text-right @error('name') is-invalid @enderror" value="{{ old('name', $serviceCategory->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label text-right">الوصف</label>
            <textarea name="description" class="form-control text-right @error('description') is-invalid @enderror">{{ old('description', $serviceCategory->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection