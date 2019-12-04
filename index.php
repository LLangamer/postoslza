<?php require_once('view/nav.html'); ?>
<?php 
		include'model/PostoDAO.php';
		$dao = new PostoDAO();
			
		$postos = $dao->informarJS();
		$ids = $dao->informarJSID();
		

		$script = "<script> 
			
					var b = '$postos';
					var id = '$ids';
						
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
		
		
		//L.control.layers(baseLayers).addTo(map);
		var variavel = 0;
		var latitude = 7;
		var longitude =6;
		var nome = 2;
		var bandeira = 1;
		var endereco = 3;
		var horarioa = 4;
		var horariof = 5;
		//alert();
		//console.log(b);
		var array_postos = b.split('|');
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


		
		var array_ids = id.split(',');
		console.log(id);
		id = id.substring(0,(id.length -1));
		console.log(id);
		var postos  = L.layerGroup(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
		
		
		/*var marker = L.marker([-16.243333, -47.961867]).addTo(map);
		marker.bindPopup("<b>IFG - Instituto Federal de Goi&aacutes</b>");*/
		//alert("Passou aqui"+ latitude+ longitude);
		/*var posto1 =  L.marker([latitude, longitude], {title:'Posto Serra do Lago', icon: p}).addTo(map);
		posto1.bindPopup("<b>Posto Serra do Lago</b>");
		
		var posto2 =  L.marker([-16.259000, -47.949000], {title:'Posto 2', icon: p}).addTo(map);
		posto2.bindPopup("<b>Posto 2</b>");
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

		
		searchLayer = L.layerGroup(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16).addTo(map);
		
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