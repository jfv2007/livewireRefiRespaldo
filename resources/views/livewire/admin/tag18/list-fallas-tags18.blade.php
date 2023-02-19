<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Fallas de Tags</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tag18s</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>




    {{-- CENTROS COMBO --}}
    <div class="row mb-3 p-2">
        <div class="col-md-3">
            <div wire:ignore>
                <label for="">Centros</label>
                 <select wire:model="selectedCentroListFallas" id="id_centro" class="form-control select2">
                   @foreach ($centros as $centro)
                        <option value="{{ $centro->id }}">{{ $centro->nombre_centro }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- PLANTA COMBO --}}
        <div class=" col-md-3 p2">
            <div wire:ingone>
                @if ($selectedCentroListFallas != 0 && !is_null($selectedCentroListFallas))
                    <label for="planta">Plantas</label>
                    <select wire:model="selectedPlantaListFallas"
                        class="form-control @error('selectedPlanta') is-invalid @enderror">
                        @foreach ($plantas as $planta)
                            <option value="{{ $planta->id }}">{{ $planta->nombre_planta }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div> {{-- "col-md-6" --}}

        {{-- PLANTA COMBO --}}
        <div class=" col-md-3 p2">
            <div wire:ingone>
                <label for="tag">Tag</label>
                <input type="text" style="text-transform:uppercase" wire:model.defer="tag"
                    class="form-control @error('tag') is-invalid @enderror" id="tag"
                    aria-describedby="tagHelp" placeholder="Introducir nombre del Tag">
                @error('tag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div> {{-- "col-md-6" --}}

    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end mb-2">

                    </div>
                    <div class="card">
                        <div class="card-body">
                        @if (count($fallas))
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"></th>
                                        <th scope="col">Tag</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Descripcion falla</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fallas as $falla)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <img src="{{ $falla->foto_url }}" style="width: 50px;"
                                                    class="img img-circle mr-1" alt="">
                                                    <td>{{ $falla->tagfallas->tag }}</td>
                                            </td>

                                            <td>{{ $falla->tagfallas->descripcion }}</td>
                                            <td>{{ $falla->descripcion_falla }}</td>
                                            <td>
                                                @if ($falla->fllastatus->status_revison == 'PEND. ATENDER')
                                                    <span class="badge badge-primary">PEND. ATENDER</span>
                                                @elseif($falla->fllastatus->status_revison)
                                                    <span class="badge badge-success">
                                                    {{ $falla->fllastatus->status_revison }}
                                                     </span>
                                                @endif
                                            </td>



                                             {{-- <td>{{ $falla->fllastatus->status_revison }}</td>  --}}
                                            <td>{{ $falla->created_at }}</td>
                                            <td>
                                              <a href="" wire:click.prevent="edit({{ $falla }})">
                                                        <i class="fa fa-edit mr-2"></i>
                                                    </a>
                                                    <a href=""
                                                        wire:click.prevent="confirmFallaRemoval({{ $falla->id }})">
                                                        <i class="fa fa-trash text-danger mr-2"></i>
                                                    </a>

                                                    <a href=""
                                                        wire:click.prevent="addtrabajo({{ $falla }})">
                                                        <i class="fas fa-brush mr-2"></i>
                                                    </a>

                                                {{-- </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           {{--   @if ($fallas->hasPages())
                                    <div class="card-footer">
                                        <span class="mr-1">Registros</span>
                                        {{ $fallas->total() }} . {{ $fallas->onEachSide(1)->links() }}

                                    </div>
                                @endif
                            @else
                                No existe ningun registro coincidente
                            --}} @endif

                        </div>
                        {{-- <div class="card-footer">
                            {{ links($tag18s) }}
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div> {{-- content --}}



</div>
