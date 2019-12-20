<?php require_once('view/nav.html'); ?>
<?php 
		include'model/PostoDAO.php';
		include'model/TelefoneDAO.php';
		include'model/CombustivelDAO.php';
		$daopostos= new PostoDAO();
		$daotelefone = new TelefoneDAO();
		$daocombustivel = new CombustivelDAO();
		//$postos = $dao->informarJS();
		//$ids = $dao->informarJSID();
		$postosDAO = $daopostos->Read();
		$telefoneDAO = $daotelefone->Read();
		$combustivelDAO = $daocombustivel->Read();
		
		
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

		foreach ($combustivelDAO as $row) {
			@$descricaoc .= $row->getDescricao(). "|";
			@$preco .= $row->getPreco() ."|"; 
			@$idpostoc .= $row->getId_posto()."|";
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
					var descricaoc = '$descricaoc';
					var preco = '$preco';
					var idpostoc = '$idpostoc';
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
	
	
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>	
	<script src="js/leaflet-search.js"></script>
	<script src="js/leaflet.awesome-markers.js"></script>
	<script src="js/leaflet.groupedlayercontrol.min.js"></script>
	<script src="js/Leaflet.Coordinates-0.1.5.min.js"></script>

	
	
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>


		
		
<div id="map" style="width: 100%; height: 630px;"></div>
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
		console.log(array_id = id.split("|"));
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
		descricaoc = descricaoc.substring(0,(descricaoc.length -1));
		preco = preco.substring(0,(preco.length -1));
		idpostoc = idpostoc.substring(0,(idpostoc.length -1));



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
		array_descricaoc = descricaoc.split("|");
		array_preco = preco.split("|");
		array_idpostoc = idpostoc.split("|");
		



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
		var cdesc = [];
		var cpreco = [];
		for(i in array_id){
			for(j in array_idposto){
				if(array_idposto[j] == array_id[i] ){
				tddd[i] = array_ddd[j]; 
				tnumero[i] = array_numero[j];
			}
			}
				for(k in  array_idpostoc){
					if(array_idpostoc[k] == array_id[i] ){
					cdesc[i] = array_descricaoc[k]; 
					cpreco[i] = array_preco[k];
			}
				}
			
			array_marker[i]= L.marker([ array_longitude[i],array_latitude[i] ], {title: array_nome[i] , icon: p}).addTo(map);
			array_marker[i].bindPopup("<h6><b>Nome</b>:"+array_nome[i]+"</h6>"+
				"<h6><b>Bandeira</b>:"+array_bandeira[i]+"</h6>"+
				"<h6><b>Endereço</b>:"+array_endereco[i]+"</h6>"+
				"<h6><b>Horário de Funcionamento </b>: Das "+array_horarioa[i]+" ás "+array_horariof[i]+"</h6>"+
				"<h6><b>Telefone</b>:"+tddd[i]+" "+tnumero[i]+
				"<h6><b>"+cdesc[i]+"</b>:"+"R$ "+cpreco[i]
				+"</h6>"
				)
				;
		
		}
		
		

		//L.control.layers(baseLayers).addTo(map);
		/*var variavel = 0;
		var latitude = 7;
		var longitude =6;
		var nome = 2;
		var bandeira = 1;
		var endereco = 3;
		var horarioa = 4;
		var horariof = 5;*/
		
		//alert();
		//console.log(b);
		/*var array_postos = b.split('|');
		for (i in array_postos) {
			//console.log((array_postos.length)/8);
			//alert(array_postos[i]);
			//console.log(array_postos[i]);
			var v = array_postos[parseInt(i)+parseInt(variavel)];
			var l = array_postos[parseInt(i)+parseInt(latitude)];
			var lo = array_postos[parseInt(i)+parseInt(longitude)];
			var n = array_postos[parseInt(i)+parseInt(nome)];
			var b = array_postos[parseInt(i)+parseInt(bandeira)];
			var e = array_postos[parseInt(i)+parseInt(endereco)];
			var ha = array_postos[parseInt(i)+parseInt(horarioa)]
			var hf = array_postos[parseInt(i)+parseInt(horariof)];
			
			console.log(v+","+b+","+n+","+e+","+ha+","+hf+","+lo+","+l);
			v =  L.marker([ l,lo ], {title: n , icon: p}).addTo(map);
			v.bindPopup("<h1>Nome:</h1><b>"+n+"</b>"
						+"<h1>Bandeira:</h1><b>"+b+"</b>"
						+"<h1>Endereço:</h1><b>"+e+"</b>"
						+"<h1>Horário de Funcionamento:</h1><b> Das "+ha+" às "+hf+"</b>");
			 var limite = ((array_postos.length/8)-1);

			if(i==parseInt(limite)){
				break;
			}else{
			variavel += 7;
			latitude += 7;
			longitude += 7;
			nome += 7;
			bandeira += 7;
			endereco += 7;
			horarioa += 7;
			horariof += 7;
			
			
			}
			

		}

		var algumacoiisa= ["ola","ola2",""];
		console.log(algumacoiisa[1]);*/

		
		
			
				var postos  = L.layerGroup(array_marker);
			
			
			
		
		
		
		/*var marker = L.marker([-16.243333, -47.961867]).addTo(map);
		marker.bindPopup("<b>IFG - Instituto Federal de Goi&aacutes</b>");*/
		//alert("Passou aqui"+ latitude+ longitude);
		/*var posto1 =  L.marker([latitude, longitude], {title:'Posto Serra do Lago', icon: p}).addTo(map);
		posto1.bindPopup("<b>Posto Serra do Lago</b>");
		
		
		var posto3 =  L.marker([-16.253598, -47.948005], {title:'Posto 3', icon: p}).addTo(map);
		posto3.bindPopup("<b>Posto 3</b>");
		var posto4 =  L.marker([-16.263598, -47.948005], {title:'Posto 4', icon: p}).addTo(map);
		posto4.bindPopup("<b>Posto 4</b>");*/
		
		
		
		


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

		var searchLayer;
		
		
		

		searchLayer = L.layerGroup(array_marker).addTo(map);
		
		map.addControl( new L.Control.Search({layer: searchLayer}));
		
		
		var latlng = L.control.coordinates({
			position:"bottomleft",
			decimals:4,
			decimalSeperator:",",
			labeTemplateLat:"Latitude: {y}",
			labelTemplateLng:"Longitude: {x}",
			useLatLngOrder:true
			
		}).addTo(map);
		
		
		
		
		
		
	
</script>



</body>

</html>