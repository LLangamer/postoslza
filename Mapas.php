<?php require_once('view/nav.html'); ?>

<?php 

include'model/PostoDAO.php';
		include'model/TelefoneDAO.php';
		$daopostos= new PostoDAO();
		$daotelefone = new TelefoneDAO();
		//$postos = $dao->informarJS();
		//$ids = $dao->informarJSID();
		$postosDAO = $daopostos->Read();
		$telefoneDAO = $daotelefone->Read();
		
		
		foreach ($postosDAO as $row) {
			@$id .=  $row->getId() . "|";
			@$nome .= $row->getNome() . "|";
			@$bandeira .= $row->getBandeira() . "|";
			@$endereco .= $row->getEndereco() . "|";
			@$horarioa .= $row->getHorario_a() . "|";
			@$horariof .= $row->getHorario_f() . "|";
			@$latitude .= $row->getLatitude() . "|";
			@$longitude .= $row->getLongitude() . "|";
		}

		foreach ($telefoneDAO as $row) {
			@$ddd .= $row->getDdd(). "|";
			@$numero .= $row->getNumero() ."|"; 
			@$idposto .= $row->getId_posto()."|";
		}

		
		$script = "<script>
					
					var id = '$id';
					var nome = '$nome';
					var bandeira = '$bandeira';
					var endereco = '$endereco';
					var horarioa = '$horarioa';
					var horariof = '$horariof';
					var latitude = '$latitude';
					var longitude = '$longitude';
					var ddd = '$ddd';
					var numero = '$numero';
					var idposto = '$idposto';
						
					</script>";
		
		//$postoJS = "var pessoa = [ "+pessoaNomeJS.pessoaSobrenomeJS.pessoaAlturaJS+" ];";
		echo $script;






 ?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Mapas</title>
	
	

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" /> 
	<link rel="stylesheet" href="css/leaflet-search.css" />
	<link rel="stylesheet" href="css/leaflet.awesome-markers.css"/>
	<link rel="stylesheet" href="css/leaflet.groupedlayercontrol.min.css"/>
	<link rel="stylesheet" href="css/Leaflet.Coordinates-0.1.5.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>	
	<script src="js/leaflet-search.js"></script>
	<script src="js/leaflet.awesome-markers.js"></script>
	<script src="js/leaflet.groupedlayercontrol.min.js"></script>
	<script src="js/Leaflet.Coordinates-0.1.5.min.js"></script>
	
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>



<div id="map" style="width: 100%; height: 500px;"></div>
<script>

	var 
		mbUrl1= 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiaGVucmlwZmYiLCJhIjoiY2pvNHE4b2VzMDI5ZTNwb2MyNXBxdHppMCJ9.3oM1-lAM6KE_xOZGFelmFw',
	    mbUrl2 = 'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}';

		var maparua  = L.tileLayer(mbUrl1, {id: 'mapbox.streets', maxZoom: 20}),
        mapasatelite  = L.tileLayer(mbUrl2, {subdomains:['mt0','mt1','mt2','mt3'], maxZoom: 20});

		var map = L.map('map', {
			center: [-16.2514778,-47.9177558], 
			zoom: 15,
			layers: [maparua, mapasatelite]
		});

		var p = L.AwesomeMarkers.icon({
		icon: 'gas-pump',
		prefix: 'fa',
		markerColor: 'red'
		});
		
		var teste;
	
		//L.control.layers(baseLayers).addTo(map);
		
		id = id.substring(0,(id.length -1));
		nome = nome.substring(0,nome.length -1);
		bandeira = bandeira.substring(0,(bandeira.length -1));
		endereco = endereco.substring(0,(endereco.length -1));
		horarioa = horarioa.substring(0,(horarioa.length -1));
		horariof = horariof.substring(0,(horariof.length -1));
		latitude = latitude.substring(0,(latitude.length -1));
		longitude = longitude.substring(0,(longitude.length -1));
		ddd = ddd.substring(0,(ddd.length -1));
		numero = numero.substring(0,(numero.length -1));
		idposto = idposto.substring(0,(idposto.length -1));


		array_id = id.split("|");
		array_nome = nome.split("|");
		array_bandeira = bandeira.split("|");
		array_endereco = endereco.split("|");
		array_horarioa = horarioa.split("|");
		array_horariof = horariof.split("|");
		array_latitude = latitude.split("|");
		array_longitude = longitude.split("|");
		array_ddd = ddd.split("|");
		array_numero = numero.split("|");
		array_idposto = idposto.split("|");
		



		/*console.log(nome.split("|"));
		console.log(bandeira.split("|"));
		console.log(endereco.split("|"));
		console.log(horarioa.split("|"));
		console.log(horariof.split("|"));
		console.log(latitude.split("|"));
		console.log(longitude.split("|"));*/
		var array_marker =[];
		var tddd = [];
		var tnumero = [];
		for(i in array_id){
			for(j in array_idposto){
				if(array_idposto[j] == array_id[i] ){
				tddd[i] = array_ddd[j]; 
				tnumero[i] = array_numero[j];

			}else{
				
			}
			
			}
			
			array_marker[i]= L.marker([ array_longitude[i],array_latitude[i] ], {title: array_nome[i] , icon: p}).addTo(map);
			array_marker[i].bindPopup("<h6><b>Nome</b>:"+array_nome[i]+"</h6>"+
				"<h6><b>Bandeira</b>:"+array_bandeira[i]+"</h6>"+
				"<h6><b>Endereço</b>:"+array_endereco[i]+"</h6>"+
				"<h6><b>Horário de Funcionamento </b>: Das "+array_horarioa[i]+" ás "+array_horariof[i]+"</h6>"+
				"<h6><b>Telefone</b>:"+tddd[i]+" "+tnumero[i]




				+"</h6>"
				)
				;
		
		}
		
		
		/*var marker = L.marker([-16.243333, -47.961867]).addTo(map);
		marker.bindPopup("<b>IFG - Instituto Federal de Goi&aacutes</b>");*/
		//alert("Passou aqui"+ latitude+ longitude);
		
		
		
		var postos  = L.layerGroup(array_marker);


		/*var circle = L.circle([-16.250337, -47.952855], {
    		color: 'red',
    		fillColor: '#f03',
    		fillOpacity: 0.5,
    		radius: 500
		}).addTo(map);
		circle.bindPopup("Eu sou um c&iacuterculo");

		var polygon = L.polygon([
    		[-16.245588, -47.941754],
    		[-16.246279, -47.940294],
    		[-16.247525, -47.941172],
			[-16.246738, -47.942392]
		]).addTo(map);
		polygon.bindPopup("Eu sou um pol&iacutegono");*/
		
		var baseMaps = {
			"Rua": maparua,
			"Sat&eacutelite": mapasatelite
		};
		
		var groupedOverlays = {
			"<b>Camadas</b>":  {"<b>Postos</b>": postos}
		};
		
		L.control.groupedLayers(baseMaps,groupedOverlays).addTo(map);
		
		//L.control.layers(baseLayers).addTo(map);
		//var searchLayer = L.layerGroup([posto1,posto2,posto3,posto4]).addTo(map);
		//map.addControl( new L.Control.Search({layer: searchLayer}));

		
		var latlng = L.control.coordinates({
			position:"bottomleft",
			decimals:4,
			decimalSeperator:",",
			labeTemplateLat:"Latitude: {y}",
			labelTemplateLng:"Longitude: {x}",
			useLatLngOrder:true
			
		}).addTo(map);
		
		//var teste = posto1.getLatLng();
		//console.log(teste.lng);
		
		//var postos;
		
		/*function addVariavel(){
			for(var i=0;i<4;i++){
				postos[i] = i;
			}
		}*/
		
		
		function addMarker(){
			var lat = document.getElementById("lat").value;
			var lng = document.getElementById("lng").value;
			var nome = document.getElementById("nome").value;
			//var v = postos.lenght + 1; 
			//console.log(postos[v]); 
			var postol =   L.marker([lat, lng], {title:nome, icon: p}).addTo(map);
			postol.bindPopup("<b>"+nome+"</b>");
			//adicionar coordenadas no banco
			/*addVariavel();
			for(int i=0;i<postos.lenght;i++){
				console.log(postos[i]);
			}*/
			console.log(lat+','+lng+','+nome);
		};
		
		var mapcoords = document.getElementById("mapcoords");
		
		
		map.on("click",function(event) {
			mapcoords = event.latlng;
			console.log(mapcoords);
			var lat = mapcoords.lat.toString().slice(0,10);
			var lng = mapcoords.lng.toString().slice(0,10);
			
			//document.getElementById("lat").value = mapcoords.slice(7,17).replace(')','').replace(',','');
			//document.getElementById("lng").value = mapcoords.slice(18,29).replace(')','').replace(',','');
			document.getElementById("lat").value = lat;
			document.getElementById("lng").value = lng;
		});
			
		
		
	
</script>

<form action="controller/salvarPosto.php" method="post" ">
  <hr />

  <div class="row ml-3" >
  <h1>Cadastrar Posto</h1>
	</div>
  <div class="row ml-3" >

  	<div class="form-group col-md-4">
      <label for="campo3">Nome</label>
      <input id="nome"type="text" class="form-control" name="nome" value="" required>
    </div>
    <div class="form-group col-md-4">
      <label for="name">Latitude</label>
      <input id="lat" type="text" class="form-control" name="lat" value="" required>
    </div>

    <div class="form-group col-md-4">
      <label for="campo2">Longitude</label>
      <input 	id="lng"type="text" class="form-control" id="cpfcnpj" name="lng" value="" maxLength="18" onkeypress="" onblur="" required>
    </div>

    
  </div>
  <div class="row ml-3">
    <div class="form-group col-md-5">
      <label for="campo1">Endereço</label>
      <input type="text" class="form-control" name="endereco" value="" required>
    </div>
    <div class="form-group col-md-4">
      <label for="campo1">Bandeira</label>
      <input type="text" class="form-control" name="bandeira" value="" required>
    </div>

      <div class="form-group col-md-4">
      <label for="campo1">Horário de Abertura</label>
      <input type="time" class="form-control" name="ha" value="" required>
    </div>
    <div class="form-group col-md-4">
      <label for="campo1">Horário de Fechamento</label>
      <input type="time" class="form-control" name="hf" value="" required>
    </div>
    
    

      
    
    <div class="col-md-12">
      <button   type="submit" class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>
</body>

</html>