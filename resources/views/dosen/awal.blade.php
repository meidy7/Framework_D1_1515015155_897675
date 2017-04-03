@extends('master')
@section('container')
<div class="panel panel-default">
	<div class="panel-heading">
			<strong>Seluruh Data dosen</strong>
			<a href="{{ url('dosen/tambah') }}" class="btn btn-xs btn-primary pull-right">
		<i class="fa fa-plus"></i> dosen</a>
				<div class="clearfix"></div>
			</div>
			<table class="table">
						<thead>
							<tr>
									<th>No.</th>
									<th>Nama</th>
									<th>NIP</th>
									<th>Alamat</th>
							</tr>
						</thead>
						<tbody>
								<?php $x=1?>
								@foreach ($data as $dosen)
									<tr>
									<td>{{ $dosen->id }}</td>
									<td>{{ $dosen->nama or 'Nama kosong'}}</td>
									<td>{{ $dosen->nip or 'NIP kosong'}}</td>
									<td>{{ $dosen->alamat or 'Alamat kosong'}}</td>
									<td>
										<div class="btn-group" role-"group">
											<a href="{{url('dosen/edit/'.$dosen->id)}}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ubah">
											<i class="fa fa-pencil"></i></a>
											<a href="{{url('dosen/'.$dosen->id)}}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fa fa-eye"></i></a>
											<a href="{{url('dosen/hapus/'.$dosen->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-remove"></i></a>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
					</div>
					@stop