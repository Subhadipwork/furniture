@extends('admin.layouts.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Forms Elements</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Forms Elements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <h4 class="card-title">Edit Product</h4>
                        {{-- <a href="{{ route('category.index') }}" class="btn btn-primary" style="margin-bottom: 10px; margin-right: 10px;">Back</a> --}}
                        <div style="text-align: right;">
                            <a href="{{ route('product.index') }}" class="btn btn-primary" style="margin-bottom: 10px; margin-right: 10px;text-align: right;">Back</a>
                        </div>
                        {{-- flash massage start --}}
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        {{-- flash massage end --}}
                        <form action="{{ route('product.update', $product->id) }}" method="POST" id="form_id" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Choose Category -->
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Choose Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category" aria-label="Category select">
                                            <option value="" disabled selected>Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Choose Subcategory -->
                                    <div class="mb-3">
                                        <label for="subcategory" class="form-label">Choose Subcategory</label>
                                        <select class="form-select @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory" aria-label="Subcategory select">
                                            <option value="" disabled selected>Subcategory</option>
                                            <!-- Subcategories will be populated here based on the selected category -->
                                        </select>
                                        @error('subcategory_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Other Product Fields -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Product Name -->
                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Product Name</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="product-name" value="{{ old('title', $product->titel) }}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- MRP Price -->
                                    <div class="mb-3">
                                        <label for="mrp_price" class="form-label">MRP Price</label>
                                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="mrp_price" value="{{ old('price', $product->price) }}">
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Sku -->
                                    <div class="mb-3">
                                        <label for="sku" class="form-label">Sku</label>
                                        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" id="sku" value="{{ old('sku', $product->sku) }}">
                                        @error('sku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="col-lg-12 mt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Product Description</h3>
                                        <!-- Short Description -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label class="form-label" for="editor">Short Description</label>
                                                <textarea name="short_description" id="editor" rows="">{{ old('short_description', $product->short_description) }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Description Fields -->
                                        <div class="col-lg-12 mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="form-label" for="editor">Description</label>
                                                            <textarea name="description" id="editor2" rows="">{{ old('description', $product->description) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Specifications -->
                                        <div class="col-lg-12 mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="form-label" for="editor">Specifications</label>
                                                            <textarea name="specification" id="editor3" rows="">{{ old('specification', $product->specification) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- edit image -->

                            <div class="col-lg-12 mt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Edit Image</h4>
                                        @if ($product->productimage != null)
                                        @foreach ($product->productimage as $image)
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <!-- Image Preview -->
                                                <label class="form-label" for="image ">Image Preview</label>
                                                <img id="preview-image-before-upload" src="{{ asset('uploads/products/'.$image->image) }}" alt="" class="img-fluid">

                                                <div class="col-lg-3 mt-4">
                                                    <!-- Add More Button -->
                                                    <button type="button" name="add" id="remove" data-url="{{route('product.removeimage', $image->id)}}" data-id="{{$image->id}}" class="btn btn-danger remove_ajax">Remove </button>
                                                </div>
                                            </div>


                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <!-- Image Upload -->
                            <div class="col-lg-12 mt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row addmore">
                                            <div class="col-lg-6">
                                                <!-- Image -->
                                                <label class="form-label" for="image">Image</label>
                                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                                @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <!-- Image Preview -->
                                                <label class="form-label" for="image[0]">Image Preview</label>
                                                <img id="preview-image-before-upload" src="{{ asset($product->image) }}" alt="" class="img-fluid">
                                            </div>

                                            <div class="col-lg-3">
                                                <!-- Add More Button -->
                                                <button type="button" name="add" id="add" class="btn btn-success add_more">Add More</button>
                                            </div>
                                        </div>
                                        <div id="newRow"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-custom">Update Product</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin_assets/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>


<script>
    $(document).ready(function() {
        var i = 1;
        $('.add_more').click(function() {
            var addmoredetils = ` <div class="row addmore">
                                                <div class="col-lg-6">
                                                    <label class="form-label" for="image">Image</label>
                                                    <input type="file" name="image[${i}]" class="form-control @error('image') is-invalid @enderror" id="image">
                                                    @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="form-label" for="image">Image Preview</label>
                                                    <img id="preview-image-before-upload" src="" alt="" class="img-fluid">
                                                </div>

                                                <div class="col-lg-3">

                                                    <button type="button" name="add" id="add" class="btn btn-danger remove">Remove</button>
                                                </div>
                                            </div>`;
            $(addmoredetils).appendTo("#newRow");
        });

        i = i + 1;
        $(document).on('click', '.remove', function() {
            $(this).parent().parent().remove();
        })

    })
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor2'))
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor3'))
        .catch(error => {
            console.error(error);
        });
</script>


<script>
    $(document).ready(function() {

        $('#category').change(function() {
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('getSubcategory') }}",
                type: "get",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: category_id
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        $('#subcategory').empty();
                        $('#subcategory').append(
                            '<option value="" disabled selected>Select Subcategory</option>'
                        );
                        $.each(data.subcategories, function(id, name) {
                            $('#subcategory').append('<option value="' + id + '">' +
                                name + '</option>');
                        });
                    } else {
                        console.error(data.message);
                    }
                }
            })
        });

    });
</script>

<script>
    tinymce.init({
        selector: '#editor',
        height: 400, // Height of the editor in pixels
        width: '100%' // Width of the editor (can be in pixels or percentage)
    });
</script>
<script>
    $(function() {
        var token = $('meta[name="csrf-token"]').attr('content');
        $(document).on('click', '.remove_ajax', function() {
            var element = $(this);
            var id = $(this).data('id');
            var url = $(this).data('url');
            // alert(url);
            $.ajax({
                type: "GET",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(data) {
                    if (data.status == true) {
                        element.parent().parent().remove();
                    }else{
                        alert(data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    console.log(jqXHR);

                }
            })
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Trigger on change of either mrp_price or selling_price input fields
        $("#mrp_price, #selling_price").on('input', function() {
            var mrp = parseFloat($("#mrp_price").val());
            var sale = parseFloat($("#selling_price").val());

            if (!isNaN(mrp) && !isNaN(sale) && mrp > 0) {
                var discountPercentage = (1 - sale / mrp) * 100;
                $("#discount").val(discountPercentage.toFixed(2));
            } else {
                $("#discount").val('');
            }
        });
    });
</script>
@endpush
@push('styles')
<link href="{{ asset('admin_assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    #form_id {
        background-color: #ffffff;
        padding: 50px;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    #form_id::before {
        content: "Product Form";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #f5f5f5;
        color: #555;
        padding: 10px 0;
        text-align: center;
        border-bottom: 1px solid #e0e0e0;
        font-weight: 600;
    }

    .form-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 15px;
    }

    .form-control,
    .form-select {
        border-radius: 5px;
        /* transition: border 0.2s ease, box-shadow 0.2s ease; */
        transition: border 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        border: 1px solid #e0e0e0;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #bbb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .form-control:hover,
    .form-select:hover {
        transform: translateY(-2px);
    }

    .btn-custom {
        background-color: #e0e0e0;
        border: none;
        border-radius: 30px;
        padding: 10px 25px;
        color: #555;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }

    .btn-custom:hover {
        background-color: #d0d0d0;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-weight: 600;
        color: #333;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 15px;
    }

    .card-title {
        text-align: center;
    }
</style>
@endpush
