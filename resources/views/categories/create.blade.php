@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}</div>

                <div class="card-body">
                <form method="POST" action="{{ route('addCategory') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="categoryName" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>
                            <div class="col-md-6">
                                <input id="categoryName" type="text" class="form-control" name="categoryName" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="parentCategory" class="col-md-4 col-form-label text-md-right">{{ __('Parent Category') }}</label>
                            <div class="col-md-6">
                                <select name ="parentCategory" class="form-control">
                                    <option value="0">None</option>
                                    @if($categories->count() > 0)
                                        @foreach($categories as $category)
                                            <option value={{ $category['id'] }}>{{ $category['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sortOrder" class="col-md-4 col-form-label text-md-right">{{ __('Sort Order') }}</label>
                            <div class="col-md-6">
                                <input id="sortOrder" type="number" class="form-control" name="sortOrder" value="" min="0" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select name ="status" class="form-control">
                                    <option value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                            <button type="submit" class="btn btn-success">Save</button>
                            </div>
                            <div class="col-md-3">
                            <a href="{{ url('/categories') }}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
