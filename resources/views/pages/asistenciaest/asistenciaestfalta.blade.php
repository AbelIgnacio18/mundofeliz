@extends('layouts.master')

@section('tab_tittle','Lista de Asistencia de Estudiantes')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">
   <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">

      <!--SI LOS ERRORES SON DE  LLLAMAMOS Y MOSTRAMOS LOS ERRORES-->
      @if (count($errors) > 0)
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
   </div>
   <div class="header-title">
      <h4 class="card-title mb-0">Estudiantes que faltaron</h4>


   </div>

   <!-- modal para crear nuevos conceptos de pagooo -->
 


</div>

<form action="listar-falta" method="GET" autocomplete="off">
   @method('GET')
   @csrf
   <div class="row">
      <div class="input-group ms-3" style="width: auto;">
         <label for="fecha" class="form-label"></label>
         @if($fecha=="")
         <input type="date" class="form-control" id="fecha" name="fecha" placeholder="" value="<?= date("Y-m-d") ?>">
         @else
         <input type="date" class="form-control" id="fecha" name="fecha" placeholder="" value="{{$fecha}}">
         @endif

         <div class="invalid-feedback">
            Seleccione una fecha válida.
         </div>
         <div class="valid-feedback">
            ¡Se ve bien!
         </div>
      </div>

      <div class="input-group ms-3" style="width: auto;">
         <select name="idaula" class="form-control">
            @if($query=="")
            <option value="">Seleccionar</option>
            @else
            @forelse($aula as $au)
            @if($query==$au->id)
            <option value="{{$query}}">{{$au->nivel}}</option>
            @endif
            @empty
            @endforelse
            @endif

            @forelse($aula as $au)
            <option value="{{$au->id}}">{{$au->nivel}}</option>
            @empty
            @endforelse
         </select>
         <button class="input-group-text btn-info">
            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
               <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
         </button>
      </div>
   </div>
</form>

<div class="card-body p-0">
   <div class="table-responsive mt-4">
      <table id="user-list-table" class="table table-striped" role="grid" data-toggle="">
         <thead>
            <tr>
               <th>N°</th>
               <th>Nombres</th>
               <th>Registrado</th>
               <th>Celular</th>
               <th>Estado</th>
           
            </tr>
         </thead>
         <tbody>
            <?php $contadorgallo = 1; ?>
            @forelse($items as $item)
            <tr>
               <td>
                  <div class="d-flex align-items-center">

                     <?php echo $contadorgallo; ?>


                  </div>
               </td>
               <td>
                  <h6>{{$item->apellidos}}, {{$item->nombre}}</h6>
               </td>
               <td>
                  <h6>
                     {{Carbon\Carbon::parse($item->created_at)->translatedFormat('l, j F Y h:i A')}}
                  </h6>
               </td>
               <td>


                  <h6>{{$item->celular}}</h6>


               </td>
               <td>

                  <h6>
                     @if($item->estado===null)
                     <span> Faltó</span>
                     @endif
                  </h6>

               </td>

               
            </tr>

            @include('pages.asistenciaest.modal')
            <?php $contadorgallo++; ?>

            @empty

            @endforelse

         </tbody>
      </table>
   </div>
</div>
@endsection