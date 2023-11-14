<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pix QR Code</title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        <?php
            require __DIR__ . '/vendor/autoload.php';

            use Mpdf\QrCode\QrCode;
            use Mpdf\QrCode\Output;
            use \App\Pix\Payload;



            // Instancia principal do payload do pix
            $obPayLoad = (new Payload) -> setPixKey('03943936279')
                                        ->setDescription("pagamento do pedido x")
                                        ->setMerchantName("Eduardo Luan")
                                        ->setMerchantCity("Boa vista RR ")
                                        ->setAmount(34)
                                        ->setTxid("edu01");

            // Codigo de pagamento PIX
            $payloadQrCode = $obPayLoad->getPayload();
            $obQrCode = new QrCode($payloadQrCode);

            // gerador de imagem do QR CODE
            $image = (new Output\Png)->output($obQrCode, 400);

            echo '<img src="data:image/png;base64,' . base64_encode($image) . '" alt="Pix QR Code" />';
        ?>

        <p>Scan the QR code or copy the code below for payment:</p>
        <textarea id="pixCode" rows="4" cols="50" readonly><?php echo $payloadQrCode; ?></textarea>
        <button onclick="copyToClipboard()">Copy to Clipboard</button>
    </div>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("pixCode");
            copyText.select();
            document.execCommand("copy");
            alert("Copied the code: " + copyText.value);
        }
    </script>
</body>
</html>
