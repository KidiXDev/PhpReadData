<?php
include 'config/config.php';

$format = isset($_GET['format']) ? $_GET['format'] : 'csv';

$sql = "SELECT id, nama_barang, jumlah, harga FROM barang";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

switch ($format) {
    case 'csv':
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=barang.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'nama_barang', 'jumlah', 'harga'));
        foreach ($data as $row) {
            fputcsv($output, $row, ',', chr(0));
        }
        fclose($output);
        break;

    case 'excel':
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=barang.xls');
        echo "ID\tnama_barang\tjumlah\tharga\n";
        foreach ($data as $row) {
            echo implode("\t", $row) . "\n";
        }
        break;

    case 'json':
        header('Content-Type: application/json');
        header('Content-Disposition: attachment;filename=barang.json');
        echo json_encode($data);
        break;

    case 'xml':
        header('Content-Type: text/xml');
        header('Content-Disposition: attachment;filename=barang.xml');
        $xml = new SimpleXMLElement('<root/>');
        foreach ($data as $row) {
            $item = $xml->addChild('item');
            foreach ($row as $key => $value) {
                $item->addChild($key, htmlspecialchars($value));
            }
        }
        echo $xml->asXML();
        break;

    default:
        echo "Invalid format";
        break;
}

// Redirect to the referring page
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
header("Location: $referer");

$stmt->close();
$conn->close();
