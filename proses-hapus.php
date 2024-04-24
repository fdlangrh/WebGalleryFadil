<?php

   include 'koneksi.php';
      
   if(isset($_GET['idp'])){
	   $foto = mysqli_query($conn, "SELECT image FROM tb_foto WHERE image_id = '".$_GET['idp']."' ");
	   $p = mysqli_fetch_object($foto);
	   
	   unlink('./foto/'.$p->image);
	   
	    $deleteL = mysqli_query($conn, "DELETE FROM tb_likefoto WHERE image_id = '".$_GET['idp']."' ");
		 $deleteK = mysqli_query($conn, "DELETE FROM tb_komentarfoto WHERE image_id = '".$_GET['idp']."' ");
	  $delete = mysqli_query($conn, "DELETE FROM tb_foto WHERE image_id = '".$_GET['idp']."' ");
	  echo '<script>window.location="data-image.php"</script>';
   }

?>