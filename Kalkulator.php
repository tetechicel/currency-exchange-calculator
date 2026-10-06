<?php

function konversiKeIDR($nominal, $mataUang) {

    // 1. Pengecekan jika nominal <= 0 menggunakan if-else
    if ($nominal <= 0) {
        return "Nominal harus lebih dari 0!";
    } else {

        // 2. Proses hitung perkalian ke Rupiah menggunakan switch case
        switch ($mataUang) {
            case "USD":
                $hasil = $nominal * 17884;
                break;
            case "SGD":
                $hasil = $nominal * 13500;
                break;
            case "JPY":
                $hasil = $nominal * 115;
                break;
            default:
                return "Mata uang tidak dikenali!";
        }

        // 3. Return hasil akhirnya
        return "Rp " . number_format($hasil, 0, ',', '.');
    }
}


// Mengecek apakah tombol Konversi ditekan
$hasilKonversi = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nominal = $_POST["nominal"];
    $mataUang = $_POST["mataUang"];
    $hasilKonversi = konversiKeIDR($nominal, $mataUang);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Exchange Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="icon">💱</div>
            <h1>Money Exchange Calculator</h1>

            <p class="subtitle">
                Money converter form IDR to USD, JPY, etc.
            </p>

            <form method="POST">
                <div class="input-group">
                    <label for="nominal">
                        Nominal
                    </label>

                    <input
                        type="number"
                        id="nominal"
                        name="nominal"
                        placeholder="Insert Money Amount"
                        min="0"
                        required
                    >
                </div>


                <div class="input-group">
                    <label for="mataUang">
                        Currency
                    </label>
                    <select id="mataUang" name="mataUang" required>
                        <option value="">-- Choose Currency --</option>

                        <option value="USD">
                            USD - US Dollar
                        </option>
                        <option value="SGD">
                            SGD - Singapore Dollar
                        </option>
                        <option value="JPY">
                            JPY - Japanese Yen
                        </option>
                    </select>
                </div>

                <button type="submit">
                    Convert to IDR
                </button>
            </form>
            <?php if ($hasilKonversi !== null): ?>
                <div class="result-box">
                    <span>conversion result</span>
                    <h2>
                        <?php echo $hasilKonversi; ?>
                    </h2>
                </div>
            <?php endif; ?>


            <div class="kurs">
                <p>Exchange Rate:</p>

                <span>1 USD = Rp 17.884</span>
                <span>1 SGD = Rp 13.500</span>
                <span>1 JPY = Rp 115</span>

            </div>

            <p class="footer">
                Made using PHP & XAMPP
            </p>
        </div>
    </div>
</body>
</html>