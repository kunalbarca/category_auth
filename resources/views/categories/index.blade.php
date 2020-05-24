@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <h3>Categories</h3>
                </div>
                <div class="col-md-7">
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/createCategory') }}" class="btn btn-s btn-success pull-right">Add Category</a>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="black white-text">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Sort Order</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                            <tr>
                            <th scope="row">
                                <!-- Default unchecked -->
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck-{{$category['id']}}">
                                <label style="margin-bottom: 1.5rem;" class="custom-control-label" for="tableDefaultCheck-{{$category['id']}}"></label>
                                </div>
                            </th>
                            <td>{{ $category['parentName'] }} {{ $category['name'] }}</td>
                            <td>{{ $category['sortOrder'] }}</td>
                            @if($category['isActive'] == 1)
                            <td>Enabled</td>
                            @else
                            <td>Disabled</td>
                            @endif
                            <td>
                            <span><a href="{{ route('editCategory').'/'. $category['id']}}">Edit</a> || </span>
                            <span><a href="{{ route('deleteCategory').'/'. $category['id']}}">Delete</a></span>
                            </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="12">No records found!</td></tr>
                    @endif
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
