@extends('index')
@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-inline-block mr-3">Daftar Dokter</h4>
                <button class="btn btn-info" data-toggle="modal" data-target="#tambah-dokter"><i class="mdi mdi-plus"></i>Tambah Dokter</button>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Nama</th>
                            <th>Dokter Spesialis</th>
                            <th>Jenis Kelamin</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th class="text-center">Aksi</th>
                        </thead>
                        <tbody>
                            @if (count($dokters)>0)
                                @foreach ($dokters as $dokter)
                                    <tr>
                                        <td>{{ $dokter->nama }}</td>
                                        <td>{{ $dokter->tipe_dokters()->first()->tp_dokter ?? 'belum di masukan'}}</td>
                                        <td>{{ $dokter->jenis_kelamins()->first()->jns_kelamin }}</td>
                                        <td>{{ $dokter->created_at }}</td>
                                        <td>{{ $dokter->updated_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDokter{{ $dokter->id }}">Edit</button>
                                            <form action="{{ route('dokter.destroy',$dokter->id) }}" method="post" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6"><h1>MAAF DATA DOKTER BELUM TERDAFTAR</h1></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Modal tambah dokter -->
                <div class="modal fade" id="tambah-dokter" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="">Tambah Dokter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="{{ route('dokter.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group row mx-auto">
                                    <label for="nama" class="col-4 col-form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="col-8 form-control">
                                </div>
                                <div class="form-group row mx-auto">
                                    <label for="tipe_dokter" class="col-4 col-form-label">Tipe Dokter</label>
                                    <input type="text" name="tipe_dokter" id="tipe_dokter" class="col-8 form-control">
                                </div>
                                <div class="form-group row mx-auto">
                                    <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="col-8 form-control">
                                        <option value="">--pilih--</option>
                                        @if (count($jenis_kelamins)>0)
                                            @foreach ($jenis_kelamins as $jenis_kelamin)
                                                <option value="{{ $jenis_kelamin->id }}"> {{ $jenis_kelamin->jns_kelamin }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                <!-- Modal edit dokter-->
                @if (count($dokters)>0)
                    @foreach ($dokters as $dokter)
                    <div class="modal fade" id="editDokter{{ $dokter->id }}" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="Label">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{ route('dokter.update',$dokter->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group row mx-auto">
                                        <label for="nama" class="col-4 col-form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="col-8 form-control" value="{{$dokter->nama}}">
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label for="tipe_dokter" class="col-4 col-form-label">Tipe Dokter</label>
                                        <input type="text" name="tipe_dokter" id="tipe_dokter" class="col-8 form-control" value="{{$dokter->tipe_dokters()->first()->tp_dokter ?? ''}}">
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label for="jenis_kelamin" class="col-4 col-form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="col-8 form-control">
                                            <option value="">--pilih--</option>
                                            @if (count($jenis_kelamins)>0)
                                                @foreach ($jenis_kelamins as $jenis_kelamin)
                                                    <option value="{{ $jenis_kelamin->id }}" {{ ($jenis_kelamin->jns_kelamin == $dokter->jenis_kelamins()->first()->jns_kelamin) ? 'selected' : ''}}> {{ $jenis_kelamin->jns_kelamin }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection