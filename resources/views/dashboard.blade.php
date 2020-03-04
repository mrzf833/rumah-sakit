@extends('index')
@section('content')
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-5">$ 15,0000</h2>
          <h6 class="card-text">Increased by 60%</h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-5">45,6334</h2>
          <h6 class="card-text">Decreased by 10%</h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-5">95,5741</h2>
          <h6 class="card-text">Increased by 5%</h6>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title d-inline-block mr-3">Riwayat Pasien</h4>
          @if (Auth::user()->roles()->first()->nama != 'dokter')
          <button class="btn btn-info d-inline-block" data-target="#tambah-riwayat" data-toggle="modal"><i class="mdi mdi-plus"></i>Tambah Riwayat Pasien</button>
          @endif
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th> nama </th>
                  <th> dokter </th>
                  <th> diagnosa penyakit </th>
                  <th> status </th>
                  @if (Auth::user()->roles()->first()->nama != 'dokter')
                  <th>Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @if (count($riwayat_pasiens) > 0)
                  @foreach ($riwayat_pasiens as $riwayat_pasien)
                  <tr>
                    <td>
                          {{ $riwayat_pasien->pasiens()->first()->nama }}
                    <td> {{ $riwayat_pasien->dokters()->first()->nama }} </td>
                    <td>
                      {{ $riwayat_pasien->diagnosa_penyakit}}
                    </td>
                    <td>
                      @if ($riwayat_pasien->status_pengobatans()->first()->status == "selesai")
                      <button class="btn btn-success">{{ $riwayat_pasien->status_pengobatans()->first()->status }}</button>
                      @endif
                      @if($riwayat_pasien->status_pengobatans()->first()->status == "rawat inap")
                      <button class="btn btn-danger" data-toggle="modal" data-target="#rawatInap{{ $riwayat_pasien->first()->id_rawat_inap }}">{{ $riwayat_pasien->status_pengobatans()->first()->status }}</button>
                      <!-- Modal -->
                      <div class="modal fade" id="rawatInap{{ $riwayat_pasien->first()->id_rawat_inap }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="">Info Rawat Inap</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group row mx-auto">
                                <div class="col-4 col-form-label">Nomor Kamar</div>
                                <div class="col-8 col-form-label">{{ $riwayat_pasien->rawat_inaps()->first()->no_kamar }}</div>
                              </div>
                              <div class="form-group row mx-auto">
                                <div class="col-4 col-form-label">Nama Perawat</div>
                                <div class="col-8 col-form-label">{{ $riwayat_pasien->rawat_inaps()->first()->perawats()->first()->nama ?? '' }}</div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                      @if($riwayat_pasien->status_pengobatans()->first()->status == "rawat jalan")
                      <button class="btn btn-danger">{{ $riwayat_pasien->status_pengobatans()->first()->status }}</button>
                      @endif
                    </td>
                    @if (Auth::user()->roles()->first()->nama != 'dokter')
                      <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editRiwayat{{ $riwayat_pasien->id }}">Edit</button>
                        <form action="{{ route('riwayat.destroy',$riwayat_pasien->id) }}" method="post" class="d-inline-block">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger">Delete</button>
                        </form>
                      </td>
                @endif
                  </tr>
                  @if (Auth::user()->roles()->first()->nama != 'dokter')
                  <!-- Modaledit riwayat pasien -->
                  <div class="modal fade" id="editRiwayat{{ $riwayat_pasien->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <form action="{{ route('riwayat.update',$riwayat_pasien->id) }}" method="post" class="sini">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          @csrf
                          @method('PUT')
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Riwayat Pasien</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row mx-auto">
                              <label for="nama" class="col-4 col-form-label">Nama</label>
                              <div class="col-8">
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $riwayat_pasien->pasiens()->first()->nama }}">
                              </div>
                            </div>
                            <div class="form-group row mx-auto">
                              <label for="dokter" class="col-4 col-form-label">dokter</label>
                              <div class="col-8">
                                <select name="dokter" id="dokter" class="form-control dokter">
                                  <option value="">--pilih--</option>
                                  @foreach ($dokters as $dokter)
                                      <option value="{{ $dokter->id }}" {{ ( $dokter->id == $riwayat_pasien->id_dokter ) ? 'selected' : ''}}>{{ $dokter->nama }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group row mx-auto">
                              <label for="penyakit" class="col-4 col-form-label">diagnosa penyakit</label>
                              <div class="col-8">
                                <input type="text" name="penyakit" id="penyakit" class="form-control" value="{{ $riwayat_pasien->diagnosa_penyakit }}">
                              </div>
                            </div>
                            <div class="form-group row mx-auto">
                              <label for="status" class="col-4 col-form-label">status</label>
                              <div class="col-8">
                                <select name="status" id="status" class="form-control statuss">
                                  <option value="">--pilih--</option>
                                  @foreach ($statuss as $status)
                                      <option isi="{{ $status->status }}" value="{{ $status->id }}" {{ ( $status->id == $riwayat_pasien->id_status_pengobatan ) ? 'selected' : '' }}>{{ $status->status }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="status-inap" {{ ($riwayat_pasien->status_pengobatans()->first()->status == "rawat inap") ? '' : 'style=display:none'}} no_kamar="{{ $riwayat_pasien->rawat_inaps()->first()->no_kamar ?? ''}}" idpasien="{{ $riwayat_pasien->id }}" perawat="{{ $riwayat_pasien->rawat_inaps()->first()->id_perawat ?? ''}}">
                              <div class="form-group row mx-auto">
                                <label for="kamar" class="col-4 col-form-label">Nomor Kamar</label>
                                <div class="col-8">
                                <input type="text" name="kamar" id="kamar" class="form-control" value="{{ $riwayat_pasien->rawat_inaps()->first()->no_kamar ?? ''}}">
                                </div>
                              </div>
                              <div class="form-group row mx-auto">
                                <label for="perawat" class="col-4 col-form-label">Perawat</label>
                                <div class="col-8">
                                  <select name="perawat" id="perawat" class="form-control perawat">
                                    <option value="">--pilih--</option>
                                    @if ($riwayat_pasien->id_rawat_inap != null)
                                    @foreach ($riwayat_pasien->dokters()->first()->perawats()->get() as $perawat)
                                      <option value="{{ $perawat->id }}" {{ ( $perawat->id == $riwayat_pasien->rawat_inaps()->first()->id_perawat ) ? 'selected' : ''}}>{{ $perawat->nama }}</option>
                                    @endforeach
                                    @else
                                    @foreach ($riwayat_pasien->dokters()->first()->perawats()->get() as $perawat)
                                      <option value="{{ $perawat->id }}">{{ $perawat->nama }}</option>
                                    @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                      </div>
                    </div>
                  </form>
                  </div>
                  @endif
                  @endforeach
                @else
                <tr>
                  <td colspan="5" class="text-center text-uppercase"><h1>maaf data riwayat belum tersedia</h1></td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @if (Auth::user()->roles()->first()->nama != 'dokter')
            <!-- Modal -->
    <div class="modal fade" id="tambah-riwayat" tabindex="-1" role="dialog" aria-hidden="true">
      <form action="{{ route('riwayat.store') }}" method="post" class="sini">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Edit Riwayat Pasien</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row mx-auto">
                <label for="pasien" class="col-4 col-form-label">Nama</label>
                <div class="col-8">
                  <select name="pasien" id="pasien" class="form-control">
                    <option value="">--pilih--</option>
                    @if (count($pasienns)>0)
                        @foreach ($pasienns as $pasie)
                        <option value="{{ $pasie->id }}">{{ $pasie->nama }}</option>
                        @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group row mx-auto">
                <label for="dokter" class="col-4 col-form-label">dokter</label>
                <div class="col-8">
                  <select name="dokter" id="dokter" class="form-control dokter">
                    <option value="">--pilih--</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row mx-auto">
                <label for="penyakit" class="col-4 col-form-label">diagnosa penyakit</label>
                <div class="col-8">
                  <input type="text" name="penyakit" id="penyakit" class="form-control" value="">
                </div>
              </div>
              <div class="form-group row mx-auto">
                <label for="status" class="col-4 col-form-label">status</label>
                <div class="col-8">
                  <select name="status" id="status" class="form-control statuss">
                    <option value="">--pilih--</option>
                    @foreach ($statuss as $status)
                        <option isi="{{ $status->status }}" value="{{ $status->id }}">{{ $status->status }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="status-inap" style="display:none">
                <div class="form-group row mx-auto">
                  <label for="kamar" class="col-4 col-form-label">Nomor Kamar</label>
                  <div class="col-8">
                  <input type="text" name="kamar" id="kamar" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group row mx-auto">
                  <label for="perawat" class="col-4 col-form-label">Perawat</label>
                  <div class="col-8">
                    <select name="perawat" id="perawat" class="form-control perawat">
                      <option value="">--pilih--</option>
                      @if (!empty($riwayat_pasien))
                        @foreach ($riwayat_pasien->dokters()->first()->perawats()->get() as $perawat)
                          <option value="{{ $perawat->id }}">{{ $perawat->nama }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
      </div>
    </form>
    </div>
    @endif
  </div>
@endsection
@section('script')
    <script>
      $(document).ready(function(){
        $('.dokter').change(function(){
          if($(this).val() != ''){
            var id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var close = $(this).closest('div.modal-body');
            var perawattt = $(this).closest('div.modal-body').find('.status-inap').attr('perawat');
            $.ajax({
              url : "{{ route('riwayat.select_perawat') }}",
              type : 'post',
              data : {id : id, _token : _token},
              success : function(result){
                $(close).find('.perawat').html(result);
                $(close).find('.perawat [value="'+ perawattt +'"]').attr('selected',true);
              }
            })
          }
          if($(this).val() == ''){
            var close = $(this).closest('div.modal-body');
            $(close).find('.perawat').html('<option value="">--pilih dokter dulu terlebih dahulu--</option>')
          }
        })
        $('.statuss').change(function(){
          var no_kamar = $(this).closest('div.modal-body').find('.status-inap').attr('no_kamar');
          var perawattt = $(this).closest('div.modal-body').find('.status-inap').attr('perawat');
          if( $(this).find('option:selected').attr('isi') == 'rawat inap'){
            var id_dokter = $(this).closest('div.modal-body').find('.dokter').val();
            var _token = $('input[name="_token"]').val();
            var close = $(this).closest('div.modal-body');
            $('.status-inap').show();
            $.ajax({
              url: "{{ route('riwayat.select_kamar') }}",
              type: 'post',
              data: {id: id_dokter,  _token: _token},
              success: function(result){
                $(close).find('.perawat').html(result);
                $(close).find('.perawat [value="'+ perawattt +'"]').attr('selected',true);
              }
            })
            $(close).find('[name="kamar"]').val(no_kamar);
          }
          if( $(this).find('option:selected').attr('isi') != 'rawat inap'){
            $('.status-inap').hide();
          }
        })
      })
    </script>
@endsection