function total(data) {
    value = data.length;
    $('.total').append(value);
}

function ativos(data){
 ativo = 0;
 inadimplente = 0;
 bloqueado = 0;
 for(i = 0; i < data.length; i++){
     if(data[i].status == 1){
         ativo = ativo + 1;
     } else if(data[i].status == 2){
         inadimplente = inadimplente + 1;
     } else if(data[i].status == 3) {
         bloqueado = bloqueado + 1;
     }
 }
 $('.ativos').append(ativo);
 $('.inadimplentes').append(inadimplente);
 $('.bloqueados').append(bloqueado);
}


function loadClientsDash(){
     $.getJSON('api/clients', function(data){
     total(data);
     ativos(data);
     });
 }