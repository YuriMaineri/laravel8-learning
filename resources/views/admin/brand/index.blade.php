<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
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
                    <div class="card-header"> All Brand </div>
                

            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <th scope="row"> {{$brand->id}} </th>
                        <td> {{$brand->brand_name}} </td>
                        <td> <img src="{{ asset($brand->brand_image) }}" style="height:40px; width:70px"> </td>
                        <td> 
                            @if($brand->created_at == NULL)
                            <span class="text-danger"> Não tem data definida </span>
                            @else
                            {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans()}} 
                            @endif 
                        </td>
                        <td>
                            <a href="{{ url('brand/edit/'.$brand->id) }} " class="btn btn-info btn-sm text-light">Edit</a>
                            <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Deseja excluir {{$brand->brand_name}}?')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>

                {{ $brands->links() }}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Add Brand </div>
                    <div class="card-body">
                        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" class="form-control">
                                @error('brand_name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                <input type="file" name="brand_image" class="form-control">
                                @error('brand_image')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        <button type="submit" class="btn btn-primary">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
