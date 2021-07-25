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

         <div class="col-9 status">
            <label>Pagamentos Programados </label>
            <div class="progress">
                <div class="progress-bar nextPayment" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100%"></div>
            </div>
            <br>
            <label>Últimos Pagamentos</label>
            <div class="progress">
                <div class="progress-bar paid bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div> 
            <br>
            <label> Pagamentos Pendentes </label>
            <div class="progress">
                <div class="progress-bar  bg-danger" role="progressbar" style="width: 11%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">1</div>
            </div>
            <br>
            <label>Pagamentos Cancelados</label>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">2</div>
            </div>
         </div>

      
       </div>

       
        
    <script type="text/JavaScript" src="{{asset('js/app.js')}}"></script>
    <script type="text/JavaScript" src="{{asset('js/dash.js')}}"></script>
    <script type="text/JavaScript">


        $(function(){
           loadPaymentsDash();
           loadClientsDash();
        });
        
        function loadPaymentsDash(){
            $.getJSON('api/payments', function(data){
                allPayments(data);
                paymentSort(data);
            });
        }

        function allPayments(data){
            paid = 0;
            unpaid = 0;
            for(i = 0; i < data.length; i++){
              if(data[i].status == 0){
                unpaid = unpaid + 1;
              } else if(data[i].status == 1){
                 paid = paid + 1;
              }
            }
            $('.nextPayment').append(unpaid);
            $('.nextPayment').css("width", unpaid *  100 / data.length +"%");
            $('.paid').append(paid);
            $('.paid').css("width", paid * 100 / data.length + "%");
        }

        function paymentSort(data){
            if(data.status){

            }
        }




    </script>
    </body>
</html>