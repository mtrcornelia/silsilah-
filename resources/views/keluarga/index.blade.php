<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Silsilah Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-light">
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
			@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $item)
						<li>{{$item}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			@if(session()->has('success'))
				<div class="alert alert-success">
					{{session('success')}}
				</div>
			@endif
            <form action='' method='post'>
				@csrf
				@if(Route::current()->uri =='keluarga/{id}')
					@method('put')
				@endif
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama' id="nama" value="{{ isset($data['nama']) ? $data['nama']:old('nama') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">jenis_kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='jenis_kelamin' id="jenis_kelamin" value="{{ isset($data['jenis_kelamin']) ? $data['jenis_kelamin']:old('jenis_kelamin') }}">
                    </div>
                </div>
				{{-- <div class="mb-3 row">
                    <label for="id_individu_orangtua" class="col-sm-2 col-form-label">Orang Tua</label>
                    <div class="col-sm-10">
						<select class="form-select filter" name="id_individu_orangtua" id="id_individu_orangtua" aria-label="Default select example" >
							<option value="" selected>Pilih Orang Tua</option>
							<option value="" selected></option>
							@if(isset($data) && is_array($data))
								@foreach($data as $item)
									<option value="{{ $item['id'] }}" @if(old('id_individu_orangtua') == $item['id']) selected @endif>{{ $item['nama'] }}</option>
								@endforeach
							@endif
						</select>
					</div>
					
                </div> --}}
				{{-- <div class="mb-3 row">
					<label for="id_individu_orangtua" class="col-sm-2 col-form-label">Orang Tua</label>
					<div class="col-sm-10">
						<select class="form-select filter" name="id_individu_orangtua" id="id_individu_orangtua" aria-label="Default select example">
							<option value="" selected>Pilih Orang Tua</option>
							<!-- Pastikan data orang tua sudah tersedia di variabel $data -->
							@if(isset($data) && is_array($data))
								@foreach($data as $item)
								<option value="{{$item->id}}" selected>{{$item->nama}}</option>
									<option value="{{ $item['id'] }}" {{ old('id_individu_orangtua') == $item['id'] ? 'selected' : '' }}>{{ $item['nama'] }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div> --}}
				<div class="mb-3 row">
					<label for="id_individu_orangtua" class="col-sm-2 col-form-label">Orang Tua</label>
					<div class="col-sm-10">
						<select class="form-select filter" name="id_individu_orangtua" id="id_individu_orangtua" aria-label="Default select example">
							<option value="" selected>Pilih Orang Tua</option>
							@if(isset($dataOrangTua) && is_array($dataOrangTua) && count($dataOrangTua) > 0)
								@foreach($dataOrangTua as $item)
									<option value="{{ $item['id'] }}" @if(old('id_individu_orangtua') == $item['id']) selected @endif>{{ $item['nama'] }}</option>
								@endforeach
							
							@else
								<option value="" disabled>Tidak ada data Orang Tua</option>
							@endif
						</select>
					</div>
				</div>
				
				
				
                <div class="mb-3 row">
                    <label for="hubungan" class="col-sm-2 col-form-label">Hubungan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " name='hubungan' id="hubungan" value="{{ isset($data['hubungan']) ? $data['hubungan']:old('hubungan') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
			<a href="{{ url('tree')}}" class="btn btn-warning btn-sm">Tree</a>
        </div>
        <!-- AKHIR FORM -->
		@if(Route::current()->uri =='keluarga')
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">nama</th>
                        <th class="col-md-3">jenis_kelamin</th>
                        <th class="col-md-2">Orang Tua</th>
                        <th class="col-md-2">Hubungan</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
					<?php $i=1;?>
				@foreach($data as $item)
				<tr>
					
					{{-- <td>{{$item->id}}</td> --}}
					<td>{{$i}}</td>
					<td>{{$item['nama']}}</td>
					<td>{{$item['jenis_kelamin']}}</td>
					<td>{{$item['id_individu_orangtua']}}</td>
					<td>{{$item['hubungan']}}</td>
					
                        <td>
                            <a href="{{ url('keluarga/'.$item['id'])}}" class="btn btn-warning btn-sm">Edit</a>
							<form action="{{ url('keluarga/'.$item['id']) }}" method="post"
							onsubmit="return confirm('apakah yakin menghapus data')"
							class="d-inline">
							@csrf
							@method('delete')
							<button type="submit" name="submit" class="btn btn-danger btn-sm">Del</a>
						</form>
                            
                        </td>
                </tr>
				<?php $i++?>
				@endforeach
                </tbody>
            </table>

        </div>
		@endif
        <!-- AKHIR DATA -->
		
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
	

</body>

</html>