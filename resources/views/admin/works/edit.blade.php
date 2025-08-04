@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('works.index') }}" class="btn btn-default float-sm-left">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                </div>
                <div class="col-sm-6">
                    <h1 class="m-0 text-right"><i class="fas fa-briefcase"></i> تعديل العمل</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row text-right">
                <div class="col-md-9 mx-auto">
                    <div class="card card-light text-right">
                        <div class="card-header bg-gradient-light text-right">
                            <h3 class="card-title text-right"><i class="fas fa-briefcase text-right "></i> تفاصيل العمل</h3>
                        </div>
                        <div class="card-body bg-white">
                            @if ($errors->any())
                                <div class="alert alert-danger text-right">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success text-right">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger text-right">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('works.update', $work->id) }}" method="POST" enctype="multipart/form-data" class="text-right">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title" class="form-label">اسم العمل <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="title" id="title" class="form-control text-right @error('title') is-invalid @enderror"
                                               value="{{ old('title', $work->title) }}" required>
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">الوصف</label>
                                    <div class="input-group">
                                        <textarea name="description" id="description" class="form-control text-right @error('description') is-invalid @enderror"
                                                  dir="auto">{{ old('description', $work->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">تاريخ البدء <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                                       value="{{ old('start_date', $work->start_date) }}" required>
                                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                                @error('start_date')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date" class="form-label">تاريخ الانتهاء <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                                       value="{{ old('end_date', $work->end_date) }}" required>
                                                <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                                @error('end_date')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="id_employee" class="form-label">الموظف <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="id_employee" id="id_employee" class="form-select @error('id_employee') is-invalid @enderror" required>
                                            <option value="">اختر الموظف</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ old('id_employee', $work->id_employee) == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->user->name ?? 'غير متوفر' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        @error('id_employee')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="main_image">الصورة الرئيسية</label>
                                    <input type="file" name="main_image" id="main_image" class="form-control text-right @error('main_image') is-invalid @enderror">
                                    @if ($work->main_image)
                                        <img src="{{ asset($work->main_image) }}" alt="Main Image" style="max-width: 200px; margin-top: 10px;">
                                    @endif
                                    @error('main_image')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gallery_images">معرض الصور (اختياري)</label>
                                    <input type="file" name="gallery_images[]" id="gallery_images" class="form-control text-right @error('gallery_images') is-invalid @enderror" multiple>
                                    @if ($work->galleryImages && $work->galleryImages->count() > 0)
                                        @foreach ($work->galleryImages as $image)
                                            <img src="{{ asset($image->image_path) }}" alt="Gallery Image" style="max-width: 100px; margin: 10px;">
                                        @endforeach
                                    @else
                                        <p style="margin-top: 10px;">لا توجد صور في المعرض</p>
                                    @endif
                                    @error('gallery_images')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> تحديث العمل
                                </button>
                            </form>
                        </div>
                        <div class="card-footer bg-light text-muted text-center">
                            <small>نظام إدارة الأعمال © {{ date('Y') }} | تم التطوير بواسطة <a href="#" class="text-primary">فريق العمل</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection