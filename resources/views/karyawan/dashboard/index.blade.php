@extends('layout.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-tachometer-alt"></i> {{ $title }}
    </h1>

    <div class="alert {{ Auth::user()->is_tugas ? 'alert-success' : 'alert-warning' }} shadow-sm">
        <i class="fas fa-info-circle mr-2"></i>
        {{ $status_tugas }}
    </div>
@endsection
