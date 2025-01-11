<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <form action="{{ route('company.update',$companies->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="container">
                        <br>

                        <div class="row mb-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter company name" value="{{ $companies->name ?? old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    email="Enter email address" value="{{ $companies->email ?? old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <!-- Logo -->
                            <div class="col-md-6">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo" value="{{ old('logo') }}">
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($companies->logo)
                                    <img src="{{ asset('storage/' . $companies->logo) }}" alt="Uploaded Logo" width="100">
                                @endif
                            </div>
                            <!-- Website -->
                            <div class="col-md-6">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website"
                                    placeholder="Enter website URL" value="{{ $companies->website ?? old('website') }}">
                                @error('website')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="button">
                                <button type="submit" class="btn btn-primary"> 
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
