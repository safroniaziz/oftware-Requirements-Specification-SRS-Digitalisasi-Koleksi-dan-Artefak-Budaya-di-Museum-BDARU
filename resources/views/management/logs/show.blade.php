@extends('layouts.dashboard')

@section('title', 'View Log - Admin Panel')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Page header-->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                <i class="fas fa-file-alt me-2"></i>
                                View Log: {{ $filename }}
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="{{ route('logs-management.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </a>
                                <a href="{{ route('logs-management.download', $filename) }}" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Page header-->

            <!--begin::Page body-->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Isi File Log</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Log Entry</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lines as $index => $line)
                                            @if(!empty(trim($line)))
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <code class="text-wrap">{{ $line }}</code>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if(empty(array_filter($lines)))
                                <div class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-file-alt fs-2x text-muted mb-3"></i>
                                        <span class="text-muted">File log kosong</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Page body-->
        </div>
    </div>
</div>
@endsection
