<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $work->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .gallery-img { max-height: 150px; object-fit: cover; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $work->title }}</h1>
        @if ($work->main_image_url)
            <img src="{{ $work->main_image_url }}" class="img-fluid mb-4" alt="{{ $work->title }}">
        @endif
        <p>{{ $work->description }}</p>
        <h3>معرض الصور</h3>
        <div class="row">
            @foreach ($work->images as $image)
                <div class="col-md-3">
                    <img src="{{ $image->image_url }}" class="gallery-img img-fluid" alt="صورة معرض">
                    @can('delete', $image)
                        <form action="{{ route('work-images.destroy', $image) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف الصورة؟')">حذف</button>
                        </form>
                    @endcan
                </div>
            @endforeach
        </div>
        @can('create', App\Models\WorkImage::class)
            <form action="{{ route('work-images.store', $work) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="images" class="form-label">إضافة صور للمعرض</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">إضافة الصور</button>
            </form>
        @endcan
        @can('update', $work)
            <a href="{{ route('works.edit', $work) }}" class="btn btn-warning mt-3">تعديل</a>
        @endcan
        @can('delete', $work)
            <form action="{{ route('works.destroy', $work) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
            </form>
        @endcan
        <a href="{{ route('works.index') }}" class="btn btn-secondary mt-3">رجوع</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>