<div class="modal fade" id="model-edit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Actualizar Concepto</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <form action="{{ route('app.config-lectivo.update', $item->id) }}" method="POST">
        @method('PUT')
        @csrf
        
        <!-- Mostrar errores si existen -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="años" class="form-label">Años:</label>
            <input type="text" name="años" class="form-control @error('años') is-invalid @enderror" 
                   id="años" placeholder="Ej: 2025" value="{{ old('años', $item->años) }}">
            @error('años')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inicio" class="form-label">Inicio:</label>
            <input type="date" name="inicio" class="form-control @error('inicio') is-invalid @enderror" 
                   id="inicio" value="{{ $item->inicio ? \Carbon\Carbon::parse($item->inicio)->format('Y-m-d') : '' }}">
            @error('inicio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
       
        <div class="form-group">
            <label for="fin" class="form-label">Fin:</label>
            <input type="date" name="fin" class="form-control @error('fin') is-invalid @enderror" 
                   id="fin"  value="{{ $item->fin ? \Carbon\Carbon::parse($item->fin)->format('Y-m-d') : '' }}">
            @error('fin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4 col-xs-6">
            <div>
                <label class="form-label">Estado:</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input @error('estado') is-invalid @enderror" 
                               type="radio" name="estado" id="estado_activo" value="1" 
                               {{ old('estado', $item->estado) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="estado_activo">
                            Activo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('estado') is-invalid @enderror" 
                               type="radio" name="estado" id="estado_inactivo" value="0"
                               {{ old('estado', $item->estado) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="estado_inactivo">
                            Inactivo
                        </label>
                    </div>
                    @error('estado')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-center mt-2">
            <button type="submit" class="btn btn-info">Actualizar</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>
      </div>
   </div>
</div>
</div
