@extends('backend.admin.base');

@section('content')
<div class="modal" id="createModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="{{ url('backend/categoria') }}" method="post" enctype="multipart/form-data" id="createCategoriaForm">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input name="nombre" id="nombre" type="text" required value="{{ old('nombre') }}"  minlength="2" maxlength="60"  placeholder="Nombre de la categoria">
                </div>
                <div class="form-group col-md-6">
                    <label for="imagen">Imagen</label>
                    <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg">                    
                </div>                   
            </div>        
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
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
        <form role="form" action="{{ url('backend/categoria') }}/" method="post" enctype="multipart/form-data" id="editCategoriaForm">
            @method('put')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input name="nombre" id="editNombre" type="text" required value="{{ old('nombre') }}"  minlength="2" maxlength="60"  placeholder="Nombre de la categoria">
                </div>
                <div class="form-group col-md-6">
                    <label for="imagen">Imagen</label>
                    <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg">                    
                </div>                   
            </div>        
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
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
                <a class="navbar-brand" href="javascript:void(0)">Categorias</a>
                  <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                  <a href="javascript:void(0)" id="createCategoria" class="btn btn-primary">Crear categoria</a>
              </div>
          </div>                
        </div>          
    </div>
</nav>
<br><br><br><br><br><br><br>
<div class="container">
    <div class="row">
    <table class="table">
    <thead class=" text-primary">
        <th>
            ID
        </th>
        <th>
            Nombre
        </th>
        <th>
            Fecha creación
        </th>
        <th>
            Editar
        </th>
        <th>
            Borrar
        </th>
    </thead>
    <tbody id="tbody">
    @foreach ($categorias as $categoria)
        <tr>
            <td>
                {{$categoria['id']}}
            </td>
            <td>
                {{$categoria['nombre']}}
            </td>
            <td>
            <a class="tdEdit" data-nombre="{{$categoria['nombre']}}" data-id="{{$categoria['id']}}" href="javascript:void(0)">Editar</a>                
            </td>
            <td>
                Editar
            </td>
            <td>
                Borrar
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

    let crearCategoria = document.getElementById('createCategoria');
    crearCategoria.addEventListener('click', function() {             
        $('#createModal').modal('show');
    });

    let tbody = document.getElementById('tbody');
    let editform = document.getElementById('editCategoriaForm');
    let createform = document.getElementById('createCategoriaForm');
    tbody.addEventListener("click", function (e) {
        if(event.target.classList.contains("tdEdit")){ 
            $('#editModal').modal('show');
            document.getElementById('editNombre').value  = event.target.dataset.nombre;
            var url = createform.getAttribute('action')+'/'+event.target.dataset.id;
            editform.setAttribute('action', url);
        }
        
    });

})();
</script>
@endsection