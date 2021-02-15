@extends('backend.base');

@section('content')
<div class="modal" id="createModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" action="{{ url('backend/producto') }}" method="post" enctype="multipart/form-data" id="createProductoForm">
            @csrf
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="text-dark" for="inputState">State</label>

                    @if(isset($categorias))
                        <select name="idcategoria" id="idcategoria" class="text-dark form-control">
                        <option disable class="text-dark" selected value="">Seleciona una categoria</option>

                        @foreach($categorias as $categoria)
                    
                            <option class="text-dark" value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    
                        @endforeach 

                    @else
                        no hay categorias
                    @endif
  
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-dark" for="nombre">Nombre</label>
                        <input name="nombre" id="nombre" type="text" required value="{{ old('nombre') }}" class="text-dark form-control" minlength="2" maxlength="80"  placeholder="Nombre del producto">
                    </div>                    
                </div>
                <div class="form-group col-md-6">
                    <label class="text-dark" for="descripcion">Descripción</label><br>
                    <textarea class="text-dark" required minlength="10" class="form-control" name="descripcion" id="descripcion" cols="50" rows="3" placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="uso">Uso</label>
                        <select name="uso" id="uso"class="text-dark form-control">
                        <option class="text-dark" disable selected>Indica el uso</option>
                            <option class="text-dark" value="0">Nuevo</option>
                            <option class="text-dark" value="1">Usado</option>
                            <option class="text-dark" value="2">Gastado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" min="0.10" max="9999.99" step="0.01" value="{{ old('precio') }}" class="form-control text-dark"  placeholder="Precio del producto">
                    </div>                   
                </div>
                <div class="col-md-6">
                    <label class="text-dark" for="imagen">Imagen</label>
                    <input type="file" name="imagen[]" class="form-control text-dark" placeholder="Precio del producto" multiple>                     
                </div>                                      
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Crear producto</button>            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>

<div class="modal" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" action="{{ url('/producto') }}/" method="post" enctype="multipart/form-data" id="editProductoForm">
            @method('put')
            @csrf
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="text-dark" for="editidcategoria">Categoria</label>

                    @if(isset($categorias))
                        <select name="editidcategoria" id="editidcategoria" class="text-dark form-control">
                        <option disable class="text-dark" selected value="">Seleciona una categoria</option>

                        @foreach($categorias as $categoria)
                    
                            <option class="text-dark" value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    
                        @endforeach 

                    @else
                        no hay categorias
                    @endif
  
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-dark" for="nombre">Nombre</label>
                        <input name="editnombre" id="editnombre" type="text" required value="{{ old('nombre') }}" class="text-dark form-control" minlength="2" maxlength="80"  placeholder="Nombre del producto">
                    </div>                    
                </div>
                <div class="form-group col-md-6">
                    <label class="text-dark" for="descripcion">Descripción</label><br>
                    <textarea class="text-dark" required minlength="10" class="form-control" name="editdescripcion" id="editdescripcion" cols="50" rows="3" placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="uso">Uso</label>
                        <select name="edituso" id="edituso"class="text-dark form-control">
                        <option class="text-dark" disable selected>Indica el uso</option>
                            <option class="text-dark" value="0">Nuevo</option>
                            <option class="text-dark" value="1">Usado</option>
                            <option class="text-dark" value="2">Gastado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="precio">Precio</label>
                        <input type="number" name="editprecio" id="editprecio" min="0.10" max="9999.99" step="0.01" value="{{ old('precio') }}" class="form-control text-dark"  placeholder="Precio del producto">
                    </div>                   
                </div>
                <div class="col-md-6">
                    <label class="text-dark" for="imagen">Imagen</label>
                    <input type="file" name="editimagen[]" class="form-control text-dark" placeholder="Precio del producto" multiple>                     
                </div>                                      
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Crear producto</button>            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
    <div class="container-fluid">
        <div class="navbar-wrapper">
        <div class="card">
              <div class="card-body">
                <a class="navbar-brand" href="javascript:void(0)">Mis productos</a>
                  <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                  <a href="javascript:void(0)" id="createProducto" class="btn btn-primary">Crear producto</a>
              </div>
          </div>                
        </div>          
    </div>
</nav>
<br><br><br><br><br><br><br>
<div class="container">
    <div class="row">
    <table class="table">
    <thead class="text-primary">
        <th>        
            ID
        </th>
        <th>
            Nombre
        </th>
        <th>
            Precio
        </th>
        <th>
            Uso
        </th>
        <th>
            Estado            
        </th>
        <th>
            Fecha
        </th>
        <th>
            editar
        </th>
        <th>
            Finalizado
        </th>
    </thead>
    <tbody id="tbody">
    @foreach ($productos as $producto)
        <tr>
            <td text-primary>
                {{$producto['id']}}
            </td>
            <td>
                {{$producto['nombre']}}
            </td>
            <td>
                {{$producto['precio']}}
            </td>
            <td>
                {{$uso[$producto['uso']]}}
            </td>
            <td>
                {{$estado[$producto['estado']]}}
            </td>
            <td>
                {{$producto['fecha']}}
                
            </td>
            <td>
            <a class="tdEdit" 
            
                data-id="{{$producto['id']}}" data-idcategoria="{{$producto['idcategoria']}}"
                data-nombre="{{$producto['nombre']}}" data-descripcion="{{$producto['descripcion']}}"
                data-descripcion="{{$producto['descripcion']}}" data-uso="{{$producto['uso']}}"
                data-precio="{{$producto['precio']}}" data-fecha="{{$producto['fecha']}}"
                data-estado="{{$producto['estado']}}" data-imagen[]="{{implode(',', $producto['imagen'])
                    }}"
            href="javascript:void(0)">Editar</a>
            </td>
            <td>
            <a href="{{ url('/backend/producto'). '/' .  $producto['id'] . '/finalizar'}}">vendido/restaurar</a>
            </td>
        </tr>
    @endforeach       
    </tbody>
</table>
    </div>
</div>
@endsection
@section('prescript')
<script>
(function () {

    let createProducto = document.getElementById('createProducto');
    createProducto.addEventListener('click', function() {             
        $('#createModal').modal('show');
    });

    let tbody = document.getElementById('tbody');
    let editform = document.getElementById('editProductoForm');
    let createform = document.getElementById('createProductoForm');
    tbody.addEventListener("click", function (e) {
        if(event.target.classList.contains("tdEdit")){ 
            
            id  = event.target.dataset.idcategoria;
            document.getElementById('editidcategoria').value  = event.target.dataset.idcategoria;
            document.getElementById('editnombre').value  = event.target.dataset.nombre;
            document.getElementById('editdescripcion').value  = event.target.dataset.descripcion;
            document.getElementById('edituso').value  = event.target.dataset.uso;
            document.getElementById('editprecio').value  = event.target.dataset.precio;   
            var url = createform.getAttribute('action')+'/'+event.target.dataset.id;
            editform.setAttribute('action', url);         
            $('#editModal').modal('show');
        
        }
        
    });

})();
</script>
@endsection