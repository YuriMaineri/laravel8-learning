<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <div class="col-md-8">
                <div class="card">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{session('success')}} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong> {{session('danger')}} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> {{session('warning')}} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                    <div class="card-header"> All Category </div>
                

            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row"> {{$category->id}} </th>
                        <td> {{$category->category_name}} </td>
                        <td> {{$category->user->name}} </td>
                        <td> 
                            @if($category->created_at == NULL)
                            <span class="text-danger"> Não tem data definida </span>
                            @else
                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans()}} 
                            @endif 
                        </td>
                        <td>
                            <a href="{{ url('category/edit/'.$category->id) }} " class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>

                {{ $categories->links() }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Add Category </div>
                    <div class="card-body">
                        <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('category_name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>

            </div>
        </div>

        <!-- Trash List -->
        <div class="container mt-4">
            <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Trash List </div>

            <table class="table table-striped table-hover table-bordered table-danger">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($trachCat as $category)
                    <tr>
                        <th scope="row"> {{$category->id}} </th>
                        <td> {{$category->category_name}} </td>
                        <td> {{$category->user->name}} </td>
                        <td> 
                            @if($category->created_at == NULL)
                            <span class="text-danger"> Não tem data definida </span>
                            @else
                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans()}} 
                            @endif 
                        </td>
                        <td>
                            <a href="{{ url('category/restore/'.$category->id) }} " class="btn btn-info btn-sm">Restore</a>
                            <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger btn-sm">P Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>

                {{ $trachCat->links() }}
                </div>
            </div>
            <div class="col-md-4">
            
            </div>

            </div>
        </div>
    </div>
</x-app-layout>