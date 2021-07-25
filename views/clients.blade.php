<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>



      <div class="row">

        <div class="col-2">
             <div class="card-dash bg-primary">
                 <div class="card-title text-white">TOTAL DE CLIENTES</div>
                 <i class="fas fa-users">
                 <span style="padding-left:5px;" class="total text-white">  </span></i>
             </div>
         </div>

         <div class="col-2">
             <div class="card-dash bg-success">
                 <div class="card-title text-white"> CLIENTES ATIVOS </div>
                 <i style="font-size:18px;" class="fas fa-chart-line">
                 <span style="padding-left:5px;" class="ativos text-white"> </span></i>
             </div>
         </div>

         <div class="col-2">
             <div class="card-dash bg-danger">
                 <div class="card-title text-white"> INADIMPLENTES </div>
                 <i style="font-size:18px;" class="fas fa-exclamation-triangle">
                 <span style="padding-left:5px;" class="inadimplentes text-white">  </span></i>
             </div>
         </div>

         <div class="col-2">
             <div class="card-dash bg-warning">
                 <div class="card-title text-white">BLOQUEADOS </div>
                 <i style="font-size:18px;" class="fas fa-users-slash">
                 <span style="padding-left:5px;" class="bloqueados text-white"> </span></i>
             </div>
         </div>

    </div>

       <div class="row">

        <div class="col-3">
            <ul class="list-group ">
              <li class="list-group-item"><a href="/"> Home </a> </li>
              <li class="list-group-item"><a href="/clientes"> Clientes</a> </li>
              <li class="list-group-item" > <a href="/pagamentos">Pagamentos</a></li>
              <li class="list-group-item" ><a href="#"> Campo Extra </a> </li>
              <li class="list-group-item" ><a href="#"> Campo Extra</a></li>
            </ul>
         </div>

        <div class="col-9">
           <table  id="tableClient" class="table table-hover">
               <thead>
                   <tr>
                       <th class="col-2"> ID </th>
                       <th class="col-4"> Clientes </th>
                       <th class="col-3 text-center">Status</th>
                       <th class="col-3 text-center">Ações</th>
                   </tr>
               </thead>
               <tbody>

               </tbody>
           </table>
           <div class="footer">
                <button class="btn register btn-outline-dark" onclick="modalOpen()" type="button">Cadastrar Clientes</button>
        </div>
      
      
       </div>

  
  <!-- Modal -->
  <div class="modal fade" id="modalClients" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Clientes</h5>
          <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
        </div>
        <div class="modal-body">
          <form class="form-group">
             <input type="hidden" id="id">
             <label>Nome</label>
             <input type="text" id="name" name="name" class="form-control" placeholder="Nome Cliente"><br>
             <label>Status</label> <br>
             <select id="status">
                <option value= " ">Selecione Uma Opção</option>
                <option value="1">Ativo</option>
                <option value="2">Inadimplente</option>
                <option value="3">Bloqueado</option>
             </select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
       </form> 
      </div>
    </div>
  </div>

<script type="text/JavaScript" src="{{asset('js/app.js')}}"></script>
<script type="text/JavaScript" src="{{asset('js/dash.js')}}"></script>
<script type="text/JavaScript">

    $.ajax ({
        headers: {
           'X-CSRF-TOKEN': '{{"csrf_token()"}}'
        },
    });

     $(function(){
       loadClientsDash();
       loadClients();
     });

    function statusName(dataStatus){
      status = " ";
      if(dataStatus == 1) {
        status = "ATIVO";
      } else if(dataStatus == 2){
        status = "INADIMPLENTE";
      } else {
        status = "BLOQUEADO";
      }
      return status;
    }

    function lines(data) {
        line = "<tr>" + 
        "<td class='col-2'>" + data.id + "</td>" + 
        "<td class='col-4'>" + data.name + "</td>" + 
        "<td class='col-3 text-center'>" + statusName(data.status) + "</td>" + 
        "<td class='col-3 text-center'><button class='btn btn-primary btn-sm' onclick='editClient("+ data.id +")'>Editar</button> " +
        " <button class='btn btn-danger btn-sm' onclick='deleteClient("+ data.id + ")'>Excluir</button></td>" +
        "</tr>";
        return line;
    }

     function loadClients(){
         $.getJSON('/api/clients', function (data){
           for(i=0; i < data.length; i++){
               client = lines(data[i]);
               $('#tableClient>tbody').append(client);
           }
         });
     }

     function modalOpen(){
         $('#modalClients').modal('show');
     }

     $('#modalClients').submit(function(event){
        event.preventDefault();
        if($("#id").val() == ""){
          newClient();
        } else {
          updateClient();
        }
        $('#modalClients').modal('hide');
     });

     function newClient(){
       client =  {
         name: $('#name').val(),
         status: $('#status').val()
        };
        $.ajax({
         type: 'POST',
         url: '/api/clients',
         context: this, 
         data: client,
         success: function (data) {
           newClient = JSON.parse(data);
           client = lines(newClient);
           $('#tableClient>tbody').append(client);
         }, error: function(data) {
           console.log(data);
         }
       });
     }

     function editClient(id){
      $.getJSON('/api/clients/' + id, function(data) {
          $("#id").val(data.id);
          $("#name").val(data.name);
          $("#status").val(data.status);
          $("#modalClients").modal('show');
        });
     }

     function updateClient(){
       client = {
           id : $("#id").val(),
           name : $("#name").val(),
           status : $("#status").val(),
       };
       $.ajax({
        type: "PUT",
        url : 'api/clients/' + client.id,
        context: this,
        data:client, 
        success: function(data){
                client = JSON.parse(data);
                lines = $("#tableClient>tbody>tr");
                e = lines.filter( function(i, element) {
                    return element.cells[0].textContent == client.id;
                });
                if(e){
                    e[0].cells[1].textContent = client.name;
                    e[0].cells[2].textContent = statusName(client.status);
                }
            },
            error: function(cliente){
                console.log(cliente);
            }
       });
     }

     function deleteClient(id) {
      $.ajax({
            type : "DELETE",
            url : "/api/clients/" + id,
            context: this, 
            success: function(){
              line = $("#tableClient>tbody>tr");
              e = line.filter(function (i, element){
                  return element.cells[0].textContent == id;
              });
              if(e) {
                 e.remove();
              }
            }, error: function(){
                console.log("Erro Delete");
            }
        });
     }

    

</script>
       
    </body>
</html>

