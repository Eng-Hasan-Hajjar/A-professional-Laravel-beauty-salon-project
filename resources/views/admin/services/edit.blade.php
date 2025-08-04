@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل الخدمة</h2>
    <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label text-right">اسم الخدمة</label>
            <input type="text" name="name" class="form-control text-right @error('name') is-invalid @enderror" value="{{ old('name', $service->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label text-right">الوصف</label>
            <textarea name="description" class="form-control text-right @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label text-right">السعر</label>
            <input type="number" name="price" step="0.01" class="form-control text-right @error('price') is-invalid @enderror" value="{{ old('price', $service->price) }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label text-right">المدة (بالدقائق)</label>
            <input type="number" name="duration" class="form-control text-right @error('duration') is-invalid @enderror" value="{{ old('duration', $service->duration) }}" required>
            @error('duration')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label text-right">الفئة</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">اختر فئة</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label text-right">صورة الخدمة</label>
            @if($service->image)
                <div class="mb-2">
                    <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" style="max-width: 150px; border-radius: 5px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="image-preview" class="mt-2"></div>
        </div>
        <div class="mb-3">
            <label for="availability" class="form-label text-right">التوفر</label>
            <select name="availability" class="form-control @error('availability') is-invalid @enderror" required>
                <option value="always" {{ old('availability', $service->availability) == 'always' ? 'selected' : '' }}>متوفر دائمًا</option>
                <option value="seasonal" {{ old('availability', $service->availability) == 'seasonal' ? 'selected' : '' }}>موسمي</option>
                <option value="on_demand" {{ old('availability', $service->availability) == 'on_demand' ? 'selected' : '' }}>حسب الطلب</option>
            </select>
            @error('availability')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="target_audience" class="form-label text-right">الجمهور المستهدف</label>
            <input type="text" name="target_audience" class="form-control text-right @error('target_audience') is-invalid @enderror" value="{{ old('target_audience', $service->target_audience) }}">
            @error('target_audience')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="requirements" class="form-label text-right">المتطلبات</label>
            <textarea name="requirements" class="form-control text-right @error('requirements') is-invalid @enderror">{{ old('requirements', $service->requirements) }}</textarea>
            @error('requirements')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="featured" class="form-label text-right">مميزة</label>
            <input type="checkbox" name="featured" value="1" {{ old('featured', $service->featured) ? 'checked' : '' }} class="form-check-input">
            @error('featured')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label text-right">الحالة</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>غير نشط</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.borderRadius = '5px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection