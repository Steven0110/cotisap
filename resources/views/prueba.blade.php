<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="{{ asset('assets/js-plugins/jquery-3.1.1.min.js') }}" type="text/javascript"></script> 

</head>
<body>
    
    <input type="submit" name="SaveSAP" id="SaveSAP" value="Conectar">
        <br>
    <input type="submit" name="SendQ" id="SendQ" value="Crear cotización">
        <br>
    <input type="submit" name="SendF" id="SendF" value="Crear Factura">
        <br>
    <script>

        $(document).ready(function(){

            var token = "";

            $("#SaveSAP").click(function(){

                $.ajax({
                    method: "post",
                    url: "http://192.168.120.7/token",
                    data:{
                        username:"admin",
                        password:"admin",
                        grant_type:"password"
                    }, success: function(result){
                        token = result.access_token
                        console.log(token);
                    }
                });

            });

            $("#SendQ").click(function(){

                $.ajax({
                    method: "post",
                    url: "http://192.168.120.7/api/sap/cotizacion",
                    headers: {
                        "Authorization": "bearer " + token
                    },
                    data: {
	                        "CardCode" : "0127",
	                        "NumAtCard": "1000002",
	                        "products": [{
		                            "ItemCode": "OMS24",
		                            "Quantity": 100000,
		                            "UnitPrice": 100000
	                            },{
		                            "ItemCode": "OMS24",
		                            "Quantity": 100000,
		                            "UnitPrice": 100000
	                            }]
                            },
                    success: function(result){
                        console.log(result);
                    }
                });

            });

            $("").click(function(){

                $.ajax({
                    method: "post",
                    url: "",
                    headers: {
                        "Authorization": "bear " + token 
                    },
                    data: {

                    },
                    success: function(result){

                    }
                });

            });


        });
    
    </script>

</body>
</html>