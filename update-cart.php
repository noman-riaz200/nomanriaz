<?php
session_start();
include('includes/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $serviceId = $input['service_id'];
    $action = $input['action'];

    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $serviceId) {
                switch ($action) {
                    case 'increase':
                        $item['quantity']++;
                        break;
                    case 'decrease':
                        if ($item['quantity'] > 1) {
                            $item['quantity']--;
                        }
                        break;
                    case 'remove':
                        $item['quantity'] = 0; // Will be filtered out next
                        break;
                }
                break;
            }
        }

        // Remove items with quantity 0
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) {
            return $item['quantity'] > 0;
        });

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>