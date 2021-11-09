<?php

    $email = $_SESSION['pelanggan'];
    $jumlahdata = $db->rowCOUNT("SELECT idorder FROM vorder WHERE email = '$email' ");
    $banyak = 3;

    $halaman = ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])){
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else{
        $mulai = 0;
    }


    $sql = "SELECT * FROM vorder WHERE email = '$email' ORDER BY tglorder DESC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);

    $no = 1 + $mulai;

?>



<h1>Histori Pembelian</h1>

<table class="table table-bordered w-50">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Detail</th>
            
        </tr>
    </thead>

    <tbody>
    <?php if (!empty($row)) { ?>
        <?php foreach ($row as $r): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $r['tglorder'] ?></td>
            <td><?php echo $r['total'] ?></td>
            <td> <a href="?f=home&m=detail&id=<?php echo $r['idorder'] ?>" style="text-decoration:none">Detail </a> </td>
        
        </tr>
        <?php endforeach ?>
        <?php } ?>
    </tbody>
</table>


<?php

    for ($i=1; $i <= $halaman ; $i++) { 
            echo '<a href = "?f=home&m=histori&p= '.$i.'" style="text-decoration:none">'.$i.'</a>';
            echo '&nbsp &nbsp &nbsp';
    }

?>