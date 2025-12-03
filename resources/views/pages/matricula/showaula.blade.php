@extends('layouts.master')

@section('tab_tittle','Detalle de Matricula')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">
   <div class="header-title">
      <h3 class="text-primary card-title mb-0">Matrícula {{$aula->nivel}} {{$aula->grado}} {{$aula->seccion}}</h3>
   </div>
</div>

<div class="card-body p-0">
   <div class="table-responsive mt-4">
      <table id="user-list-table" class="table table-striped" role="grid">
         <thead>
            <tr>
               <th>N°</th>
               <th>Estudiante</th>
               <th>Nivel</th>
               <th>Pensión</th>
               <th>Concepto</th>
               <th>D. Admisión</th>
               <th>DNI</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>

            @forelse($matricula as $matri)
            <tr>
               {{-- Columna vacía para numeración DataTables --}}
               <td></td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->estudiante->apellidos}}, {{$matri->estudiante->nombre}}</h6>
                     @if($matri->estado==1)
                        <span class="badge bg-danger"> trasladad@</span>
                     @endif
                  </div>
               </td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->aula->nivel}} {{$matri->aula->grado}} {{$matri->aula->seccion}}</h6>
                  </div>
               </td>

               <td>
                  <div class="iq-media-group iq-media-group-1">
                     @forelse(($matri->meses->toArray()) as $me)
                        <a href="#" class="iq-media-1">
                           <div class="icon iq-icon-box-3 rounded-pill">{{$me['mes']}}</div>
                        </a>
                     @empty
                     @endforelse
                  </div>
               </td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->concepto->concepto}}</h6>
                  </div>
               </td>

               <td>
                  @php
                     $pensiones = $matri->estudiante->pagos->flatMap->pensiones;
                     $conceptosMostrar = [
                        'M2025' => 'MTR',
                        'C2025' => 'COP',
                        'PSC2025' => 'PS',
                        'UE2025' => 'UTE',
                     ];
                  @endphp

                  <div class="iq-media-group iq-media-group-1">
                     @foreach ($conceptosMostrar as $codigo => $label)
                        @if ($pensiones->firstWhere('concepto.codigo', $codigo))
                           <a href="#" class="iq-media-1">
                              <div class="icon iq-icon-box-3 rounded-pill">{{ $label }}</div>
                           </a>
                        @endif
                     @endforeach
                  </div>
               </td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->estudiante->dni}}</h6>
                  </div>
               </td>

               <td>
                  <div class="flex align-items-center list-user-action">
                     <a class="btn btn-sm btn-icon text-success"
                        data-bs-original-title="Ver"
                        href="{{route('app.matriculas.show',$matri->id)}}">
                        <span class="btn-inner">
                           <svg width="20" viewBox="0 0 24 24" fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                           </svg>
                        </span>
                     </a>

                     <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="modal"
                        data-bs-target="#model-delete-{{$matri->id}}">
                        <span class="btn-inner">
                           <svg width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                              <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                    stroke-width="1.5"></path>
                              <path d="M20.708 6.23975H3.75" stroke-width="1.5"></path>
                              <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                    stroke-width="1.5"></path>
                           </svg>
                        </span>
                     </a>
                  </div>
               </td>
            </tr>

            @include('pages.matricula.delete')
            @empty
            @endforelse

         </tbody>
      </table>
   </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
   $('#user-list-table').DataTable({
      order: [[1, 'asc']], // ordenar por Estudiante
      columnDefs: [
            {
               targets: 0, // columna N°
               orderable: false,
               searchable: false,
               render: function (data, type, row, meta) {
                    return meta.row + 1; // numeración automática
               }
            }
      ]
   });
});
</script>

@endsection
