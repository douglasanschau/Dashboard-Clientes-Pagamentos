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
              <li class="list-group-item" ><a href="#"> Campo Extra </a></li>
            </ul>
         </div>

        <div class="col-9">
            <div class="card-header bg-light border">
                        <button style="font-size:15px;" class="btn btn-outline-success" onclick="modalOpen()" type="button">
                        <i style="padding-right:15px;" class="fas fa-hand-holding-usd"></i>Cadastrar Novo Pagamento </button>  
            </div>
           <table  id="tablePayment" class="table table-light table-striped">
               <thead>
                   <tr>
                       <th class="col-1 text-center"> ID </th>
                       <th class="col-3 text-center"> Cliente </th>
                       <th class="col-2 text-center">Vencimento</th>
                       <th class="col-2 text-center">Status</th>
                       <th class="col-2 text-center"> Valor </th>
                       <th class="col-2 text-center">Ações</th>
                   </tr>
               </thead>
               <tbody>
                
               </tbody>
           </table>
      
       </div>

  
  <!-- Modal -->
  <div class="modal fade" id="modalPayments" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Cobranças</h5>
          <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
        </div>
        <div class="modal-body">
          <form class="form-group">
             <input type="hidden" id="id">
             <input type="hidden" id="status">
             <label>Clientes</label>
             <select id="client" name="client" class="custom-select">
             @foreach($clients as $client)
                <option value={{$client->id}}>{{$client->name}}</option>
             @endforeach
             </select> <br>
             <label>Vencimento</label> <br>
             <input type="date" name="date" id="date" class="form-control">
             <label>Valor</label> <br>
             <input type="text" name="price" id="price" class="form-control">
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

    function datePayment(date, status) {
      var date = new Date(date);
      var now = new Date();
      vencimento = "";
        if(status == 0 && date >= now ) {
           vencimento = "<p style='color:green'> Em Aberto </p>";
        } else if(status == 0 && date < now) {
            vencimento = "<p style='color:red'> Pendente </p>";
        } else if(status == 1) {
            vencimento =  date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear();
        }
          return vencimento;
    }

    function lines(data) {
        line = "<tr>" + 
        "<td class='col-1 text-center'>" + data.id + "</td>" + 
        "<td class='col-3 text-center'>" + data.client + "</td>" + 
        "<td class='col-2 text-center'>" + datePayment(data.date, data.status) + "</td>" + 
        "<td class='col-2 text-center'>" + paymentStatus(data.status) + "</td>" + 
        "<td class='col-2 text-center'>" + 'R$' + parseFloat(data.price).toFixed(3) + "</td>" + 
        "<td class='col-2 text-center'> <button class='btn btn-success btn-sm' onclick='paymentDone("+ data.id +")'>Pago</button> " +
        " <button class='btn btn-danger btn-sm' onclick='deletePayment("+ data.id +")'>Excluir</button> </td>" +
        "</tr>";
        return line;
    }

    function paymentStatus (data) {
       status = "";
       if(data == 0) {
           status = "<p class='card bg-warning text-white'>Pendente</p>";
       } else {
           status = "<p class='card bg-success text-white'>Pago</p>";
       }
       return status;
    }

    function paymentDone(data){
          payment = {
            id : data,
            status : 1
          };
          $.ajax({
            type : "PUT",
            url : "api/payments/" + payment.id,
            context : this,
            data : payment,
            success:function(data) {
                payment = JSON.parse(data);
                location.reload();
            },
            error: function(data){
                console.log(data);
            }
          })
    }


    function loadPayments(){
        $.getJSON('/api/payments', function(data){
            for(i=0; i < data.length; i++){
               payment = lines(data[i]);
               $('#tablePayment>tbody').append(payment);
           }
        });
    }

    function modalOpen(){
        $('#modalPayments').modal('show');
    }

    $('#modalPayments').submit(function(event){
        event.preventDefault();
        savePayment();
        $('#modalPayments').modal('hide');
    });

    function savePayment(){
        payment = {
            client : $("#client").val(),
            date: $("#date").val(),
            price : $("#price").val(),
            status: 0
        };
        $.ajax({
         type : 'POST',
         url: 'api/payments',
         context: this,
         data: payment, 
         success: function(){
             location.reload();
         }, error:function(data){
             console.log(data);
         }
        });
    }

    function deletePayment(id){
        $.ajax({
          type: 'DELETE',
          url: 'api/payments/' + id,
          context: this,
          success: function(){
            line = $("#tablePayment>tbody>tr");
              e = line.filter(function (i, element){
                  return element.cells[0].textContent == id;
              });
              if(e) {
                 e.remove();
              }
          }, error: function(data){
              console.log(data);
          }
        });
    }


    $(function(){
      loadClientsDash();
      loadPayments();
    });
    

</script>
       
    </body>
</html>
