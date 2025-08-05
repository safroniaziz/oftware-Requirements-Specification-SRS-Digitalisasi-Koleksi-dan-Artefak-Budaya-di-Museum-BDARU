@props(['title', 'value', 'icon', 'color', 'percentage', 'description'])

<div class="card card-flush border-0 bg-white shadow-sm">
    <div class="card-body p-6">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-50px me-4">
                <div class="symbol-label bg-light-{{ $color }}">
                    <i class="{{ $icon }} fs-2x text-{{ $color }}">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-semibold text-gray-800 fs-6">{{ $title }}</span>
                    <span class="fw-bold text-{{ $color }} fs-5">{{ $value }}</span>
                </div>
                <div class="text-gray-600 fs-8 mb-2">{{ $description }}</div>
                <div class="d-flex align-items-center">
                    <div class="progress h-6px w-100 me-3">
                        <div class="progress-bar bg-{{ $color }}" style="width: {{ $percentage }}%"></div>
                    </div>
                    <span class="fw-bold text-{{ $color }} fs-8">{{ $percentage }}%</span>
                </div>
            </div>
        </div>
    </div>
</div>
