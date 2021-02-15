@extends('backend.admin.base');

@section('content')
<br><br>
<div class="container">
    <div class="row justify-content-md-center">       
        <div class="col col-lg-8">
            <form role="form" action="{{ url('backend/categoria') }}" method="post" id="createProductoForm">
            @csrf
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputState">State</label>

                    @if(isset($categorias))
                        <select name="idcategoria" id="idcategoria" class="form-control">
                        <option disable selected value="">Seleciona una categoria</option>

                        @foreach($categorias as $categoria)
                    
                            <option style="background-color: black;" value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    
                        @endforeach 

                    @else
                        no hay categorias
                    @endif
  
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input name="nombre" id="nombre" type="text" required value="{{ old('nombre') }}" class="form-control" minlength="2" maxlength="80"  placeholder="Nombre del producto">
                    </div>                    
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea required minlength="10" class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="uso">Uso</label>
                        <select name="uso" id="uso" class="form-control">
                        <option disable selected>Indica el uso</option>
                            <option style="background-color: black;" value="0">Nuevo</option>
                            <option style="background-color: black;" value="1">Usado</option>
                            <option style="background-color: black;" value="2">Gastado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" min="0.10" max="9999.99" step="0.01" value="{{ old('precio') }}" class="form-control"  placeholder="Precio del producto">
                    </div>                   
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>                   
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>        
    </div>
</div>

@endsection