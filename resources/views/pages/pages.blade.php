@extends('layouts.app')

@section('content')

<style>
    .page-card {
        border-radius: 18px;
        transition: all 0.3s ease;
        border: none;
    }

    .page-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    }

    .modern-table thead {
        background: #111;
        color: #fff;
    }

    .modern-table tbody tr {
        transition: 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background: #f8f9fa;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-published {
        background: #d1f7e3;
        color: #0f9d58;
    }

    .badge-draft {
        background: #ffe5e5;
        color: #d93025;
    }

    .action-btn {
        border-radius: 50px;
        padding: 5px 14px;
        font-size: 13px;
    }
</style>

<div class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Landing Pages</h2>
        <a href="{{ route('pages.create') }}" class="btn btn-dark px-4 rounded-pill">
            + Create Page
        </a>
    </div>

    <!-- STATS CARDS -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card page-card shadow-sm p-4">
                <h6 class="text-muted">Total Pages</h6>
                <h3 class="fw-bold">{{ $total }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card page-card shadow-sm p-4">
                <h6 class="text-muted">Published</h6>
                <h3 class="fw-bold text-success">{{ $published }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card page-card shadow-sm p-4">
                <h6 class="text-muted">Draft</h6>
                <h3 class="fw-bold text-danger">{{ $draft }}</h3>
            </div>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table modern-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Products</th>
                        <th>Created</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $page->title }}</strong>
                            </td>

                            <td>
                                <span class="text-muted">
                                    /{{ $page->slug }}
                                </span>
                            </td>

                            <td>{{ $page->contact_number ?? 'N/A' }}</td>

                            <td>
                                @if($page->is_published)
                                    <span class="status-badge badge-published">
                                        Published
                                    </span>
                                @else
                                    <span class="status-badge badge-draft">
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ is_array($page->product_id) ? count($page->product_id) : 0 }}
                            </td>

                            <td>
                                {{ $page->created_at->format('d M Y') }}
                            </td>

                            <td class="text-end">
                                <a href="{{ route('pages.show', $page->slug) }}"
                                   class="btn btn-sm btn-outline-dark action-btn">
                                    View
                                </a>

                                <a href="{{ route('pages.edit', $page) }}"
                                   class="btn btn-sm btn-outline-primary action-btn">
                                    Edit
                                </a>

                                <form action="{{ route('pages.destroy', $page) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger action-btn">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                No landing pages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
