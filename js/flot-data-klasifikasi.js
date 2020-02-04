function getKlasifikasi()
{
	var v1 = document.getElementById('avgN1').innerHTML;
	var v2 = document.getElementById('avgN2').innerHTML;
	var v3 = document.getElementById('avgN3').innerHTML;
	var v4 = document.getElementById('avgN4').innerHTML;
	var v5 = document.getElementById('avgN5').innerHTML;
	var v6 = document.getElementById("iKetinggian").value;

	n1 = parseFloat(v1); // temp
	n2 = parseFloat(v2); // hum
	n3 = parseFloat(v3); // Ldr
	n4 = parseFloat(v4); // t.udara
	n5 = parseFloat(v5); // kta
	n6 = parseFloat(v6); // ketinggian


	// console.log("Nilai n = " +n2)  

	var vId = new Array();
	var vNmTanaman = new Array();
  	var vTemp = new Array();
  	var vHum = new Array();
  	var vLdr = new Array();
  	var vKetinggian = new Array();
  	var vKta = new Array();

  	var url = "http://31.220.48.158/projects/iotgateway/raspi02/apiGetDataJsonTanaman.php";
      $.ajax({      
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){           
          for(i=0;i<msg.records.length;i++){
          	vId[i] = msg.records[i].id;
            vNmTanaman[i] = msg.records[i].nama_tanaman;
            vTemp[i] = msg.records[i].temp;
            vHum[i] = msg.records[i].hum;
            vLdr[i] = msg.records[i].ldr;
            vKetinggian[i] = msg.records[i].ketinggian;
            vKta[i] = msg.records[i].kta;
          }
          klasfikasiTanaman(vId, vNmTanaman, vTemp, vHum, vLdr, vKetinggian, vKta);
        }            
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        // Request failed. Show error message to user. 
        // errorThrown has error message.
        alert("a" +errorThrown);
  	});	

    function klasfikasiTanaman(a, b, c, d, e, f, g)
  	{	
  		var cTemp = new Array();
	  	var cHum = new Array();
	  	var cLdr = new Array();
	  	var cKetinggian = new Array();
	  	var cKta = new Array();
	  	var cKnn = new Array();

	  	var sumC=0;
	  	var nKnn=0;

	  	console.log("--------- Hasil Klasifikasi ---------- ")
  		for(i=0;i<a.length;i++){
  			nc = parseInt(c[i]);
  			nd = parseInt(d[i]);
  			ne = parseInt(e[i]);
  			nf = parseInt(f[i]);
  			ng = parseInt(g[i]);

  			nTemp = (n1-nc)*(n1-nc);
  			nHum = (n2-nd)*(n2-nd);
  			nLdr = (n3-ne)*(n3-ne);
  			nKetinggin = (n6-nf)*(n6-nf);
  			nKta = (n5-ng)*(n5-ng);

  			sumC = nTemp + nHum + nLdr + nKetinggin + nKta;
  			nKnn = Math.sqrt(sumC);
  			cKnn[i] = nKnn;  			
  		}
  		console.log(cKnn);
  		bubbleSort(cKnn, b, c, d, e, f, g)
  	}

  	function bubbleSort(a, b, c, d, e, f, g) 
  	{
  		console.log("--------- Hasil Pengurutan ---------- ")
	    var swapped;
	    do {
	        swapped = false;
	        for (var i=0; i < a.length-1; i++) {
	            if (a[i] > a[i+1]) {

	                var temp = a[i];
	                a[i] = a[i+1];
	                a[i+1] = temp;

	                var vB = b[i];
	                b[i] = b[i+1];
	                b[i+1] = vB;

	                swapped = true;
	            }
	        }
	    } while (swapped);
	    console.log(a);
	    console.log(b);

	    // isi data ke table
	    var table = document.getElementById("dataTables-example");
		var x = document.getElementById("dataTables-example").rows.length;
		var tableRef = document.getElementById('dataTables-example').getElementsByTagName('tbody')[0];

		//document.getElementById("dataTables-example").deleteRow(x-1);
		for(i=x; i>1; i--)
		{
			document.getElementById("dataTables-example").deleteRow(i-1);
		}
		
		for(i=0;i<a.length;i++){
			var row = tableRef.insertRow(tableRef.rows.length);
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			k = i+1;
			cell1.innerHTML = k;
			cell2.innerHTML = b[i];
			cell3.innerHTML = a[i];
		}
		
	}
}