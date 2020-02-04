<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Unbenanntes Dokument</title>
  </head>

  <body>
    <div id="Mydiv">anything</div>

    <script>
     function test(x){
        alert(x)
      };
     var col=document.getElementById('Mydiv');
     
     var adsada = 55555;
     col.innerHTML='<div onclick="alert('+adsada+');test('+adsada+');">Text</div>';
    </script>
  </body>
</html>