<!DOCTYPE html>
<html>
    <head>
        <title>Kalkulator Diskon</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1> KALKULATOR DISKON </h1>
        <form method="POST">
            <label for="member">Status Member</label>
            <select name="member" id="member">
                <option value="yes">Ya</option>
                <option value="no">Tidak</option>
            </select>

            <table>
                <tr>
                    <td>Harga</td>
                    <td>Rp<input name="harga" type="number" required></td>
                </tr>

                <tr>
                    <td>Diskon</td>
                    <td><input name="diskon" type="number" required>%</td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input id="tombol-submit" type="submit" name="submit" value="submit">
                    </td>
                </tr>

                <?php
                if (isset($_POST['submit'])) {
                    $member = $_POST['member'] === 'yes';
                    $harga = $_POST['harga'];
                    $diskon = $_POST['diskon'];

                    function hitungDiskon($totalBelanja, $Member, $diskonTambahan) {
                        $diskon = 0;

                        if ($Member) {
                            // Member mendapatkan potongan 10% terlebih dahulu
                            $diskon = 10;

                            // Jika belanja lebih dari 1.000.000, tambahan diskon 15%
                            if ($totalBelanja > 1000000) {
                                $diskon = 15;
                            } 
                            // Jika belanja 500.000, tambahan diskon 10%
                            else if ($totalBelanja >= 500000) {
                                $diskon = 10;
                            }
                        } else {
                            // Jika bukan member dan belanja lebih dari 1.000.000, diskon 10%
                            if ($totalBelanja > 1000000) {
                                $diskon = 10;
                            } 
                            // Jika belanja lebih dari 500.000, diskon 5%
                            else if ($totalBelanja >= 500000) {
                                $diskon = 5;
                            }
                        }

                        // Tambahkan diskon tambahan dari input pengguna
                        // $diskon += $diskonTambahan;

                        // Hitung total potongan harga
                        $totalDiskon = ($diskon / 100) * $totalBelanja;

                        // Hitung harga akhir setelah diskon
                        $hargaAkhir = $totalBelanja - $totalDiskon;

                        return array($totalDiskon, $hargaAkhir);
                    }

                    list($totalDiskon, $hargaAkhir) = hitungDiskon($harga, $member, $diskon);
                   
                    echo "<tr><td>Total bayar</td><td>Rp " . number_format($hargaAkhir, 0, ',', '.') . "</td></tr>";
                }
                ?>
            </table>
        </form>
    </body>
</html>