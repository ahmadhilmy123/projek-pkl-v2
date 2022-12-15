@extends('layouts.app')

@section('title', 'Barang')


@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Barang<h1>
        </div>
        <div class="row">
            <div class="table-responsive">
                <div class="bd-highlight d-flex">
                    <div class="card-header-form">
                        <form action="/barang" method="GET" class="mt-3">
                            <div class="input-group">
                                <input type="text" 
                                id="input"
                                class="form-control" 
                                placeholder="Search"  
                                onkeyup='searchTable()'>
                            </div>
                        </form>
                    </div>
                    <div class="p-2 flex-grow-1 bd-highlight text-right">
                        <a href="{{route('tambahbarang')}}" type="button" class="btn btn-success mt-2 mb-4">Tambah +</a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Anggaran</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @foreach ($data as $no=> $row)
                                    <input type="hidden" value="{{ $row->image }}" class="key{{ $no }}">
                                    <input type="hidden" value="{{ $row->nama_barang }}" class="key{{ $no }}">
                                    <input type="hidden" value="{{ $row->stock }}" class="key{{ $no }}">
                                    <input type="hidden" value="{{ $row->anggaran }}" class="key{{ $no }}">
                                    <input type="hidden" value="{{ $row->scan }}" class="key{{ $no }}">
                                    <td>{{$data->firstItem()+$no}}</td>
                                    <td><img src="images/{{$row->image}}" style="width: 60px;"></td>
                                    <td>{{$row ->nama_barang}}</td>
                                    <td>{{$row ->stock}}</td>
                                    <td>{{$row ->anggaran}}</td>
                                    <td>{{$row ->scan}}</td>
                                    <td >
                                        <div class="container d-flex" style="margin: 0;padding: 0;">
                                            <form action="{{route('deletebarang',$row->id)}}" id="delete{{$row->id}}" method="POST" class="d-block">
                                                @csrf
                                                @method('delete')
                                                <a href="#" data-id={{$row->id}} class="btn btn-icon btn-danger m-1 ml-3 mt-3 mb-3delete swal-confrim">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </form>
                                            <a href="{{route('tampilanbarang',$row->id)}}" class="btn btn-primary m-1 mr-3 mb-5 mt-3 "><i class="fas fa-pencil-alt "></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @else
                        <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                            Maaf, tidak ada ditemukan
                        </div>
                        @endif --}}
                        {{$data->links()}}
                
                    </div>
                </div>
        </div>
    </section>
    
    @include('sweetalert::alert')
    @endsection
    @push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('js/after.js') }}"></script>
    @endpush
