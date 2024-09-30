@extends('backend.layouts.main')
@section('page-title', 'Hotels List')
@section('main-content')
    {{-- table to show the hotel --}}
    <div class="card mt-5">
        <h5 class="card-header">List of all hotels</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="text-white">
                    <tr class="bg-primary">
                        <th class="text-white">S.N</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($hotels->isNotEmpty())
                        @foreach ($hotels as $hotel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $hotel->title }}
                                </td>
                                <td>
                                    <form action="{{ route('hotel.destroy', $hotel->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                <h6 class="text-center">--------Please add the hotel first----------</h6>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>

@endsection