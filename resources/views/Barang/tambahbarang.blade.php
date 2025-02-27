@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    
  
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

    <link rel="stylesheet" href="{{asset('assets/css/mystyle.css')}}">

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Barang</h1>
        </div>
        <div class="row">
           <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form  method="POST"  action="/insertbarang/"  enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="image">Foto</label>
                                    <div id="camera" class="img-fluid"></div>
                                    <br/>
                                    <input type=button class="btn btn-sm btn-primary" value="Take Snapshot" onClick="take_snapshot()">
                                    <input type="hidden" name="image" class="image-tag">
                                    <div id="results">Your captured image will appear here...</div>
                                    
                                    @error('image')
                                        <div class="alert alert-danger" role="alert">
                                            Data Harus diisi!
                                        </div>
                                    @enderror
                                    <textarea id="signature64" name="signed" style="display: none"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control 
                                    @error('nama_barang')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                                    @error('nama_barang')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stock</label>
                                    <input type="text" name="stock" class="form-control 
                                    @error('stock')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('stock') }}"> 
                                    @error('stock')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Anggaran</label>
                                    <input type="text" name="anggaran" class="form-control 
                                    @error('anggaran')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('anggaran') }}">
                                    @error('anggaran')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Barcode</label>
                                    <input type="text" name="scan" class="form-control 
                                    @error('scan')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('scan') }}">
                                    @error('scan')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button class="btn btn-primary" type="submit" id="simpanEdit123">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
 
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
    <script >
        Webcam.set({
                width: 350,
                height: 250,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#camera');
            function take_snapshot() {
                Webcam.snap( function(data_uri) {
                    $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="img-fluid mt-4"/>';
                } );
            }

            let signature;

            function setupSignature(){
                const canvas = document.querySelector('canvas');
                signature = new SignaturePad(canvas);
            }

            $(document).ready(setupSignature)

            $('#clear').click(function() {
            signature.clear()
            $('#signature64').val('');
            console.log($('#signature64').val())
            });

            $('#simpanEdit123').click(function(){
                let ttd = signature.toDataURL();
                let data = $('#signature64').val(ttd)
                console.log($('#signature64').val())

            })

            let width = window.screen.width;
            if(width < 480){
                const video = document.querySelector('#camera video');
                const sig = document.querySelector('#sig');
                video.style.width = "17rem";
                sig.style.width = "15rem";
            }
            
        // var canvas = document.getElementById('signature-pad');
        // var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
        // $('#clear').click(function(e) {
        //     e.preventDefault();
        //     sig.signature('clear');
        //     $("#signature64").val('');
        // });

        

    </script>
  </body>
</html>