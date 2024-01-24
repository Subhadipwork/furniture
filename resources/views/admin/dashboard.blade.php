@extends('admin.layouts.layout')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dark Sidebar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Dark Sidebar</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



        </div> <!-- container-fluid -->
    </div>
@endsection

{{-- Dynamic seript for chart --}}


@push('scripts')
    {{-- dashbord --}}
    {{-- <script src="{{ asset('admin_assets/plugins/apexcharts/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin_assets/js/pages/dashboard.init.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin_assets/js/pages/apexcharts.init.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin_assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}



@endpush


{{-- Dynamic seript for chart --}}

{{-- @push('styles')
    
@endpush --}}
