@extends('admin.layouts.app')

@section('content')
    <section class="content-header" dir="rtl">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-right">
                    <h1>إضافة عمل جديد</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('works.index') }}" class="btn btn-default float-left">رجوع</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content" dir="rtl">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" dir="rtl">
                            @if ($errors->any())
                                <div class="alert alert-danger text-right">
                                    <ul class="mb-0 pr-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger text-right">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('works.store') }}" method="POST" enctype="multipart/form-data" dir="rtl">
                                @csrf
                                <div class="form-group text-right">
                                    <label for="title">اسم العمل</label>
                                    <input type="text" name="title" id="title" 
                                           class="form-control text-right @error('title') is-invalid @enderror" 
                                           value="{{ old('title') }}" required
                                           dir="auto">
                                    @error('title')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <label for="description">الوصف</label>
                                    <textarea name="description" id="description" 
                                              class="form-control text-right @error('description') is-invalid @enderror" 
                                              dir="auto">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <label for="start_date">تاريخ البدء</label>
                                    <input type="date" name="start_date" id="start_date" 
                                           class="form-control text-right @error('start_date') is-invalid @enderror" 
                                           value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <label for="end_date">تاريخ الانتهاء</label>
                                    <input type="date" name="end_date" id="end_date" 
                                           class="form-control text-right @error('end_date') is-invalid @enderror" 
                                           value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <label for="id_employee">الموظف</label>
                                    <select name="id_employee" id="id_employee" 
                                            class="form-control text-right @error('id_employee') is-invalid @enderror" 
                                            required>
                                        <option value="">اختر الموظف</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->user->name ?? 'غير متوفر' }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_employee')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <label for="main_image">الصورة الرئيسية</label>
                                    <input type="file" name="main_image" id="main_image" class="form-control text-right @error('main_image') is-invalid @enderror">
                                    @error('main_image')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <label for="gallery_images">معرض الصور (اختياري)</label>
                                    <input type="file" name="gallery_images[]" id="gallery_images" class="form-control text-right @error('gallery_images') is-invalid @enderror" multiple>
                                    @error('gallery_images')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success float-left">حفظ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection