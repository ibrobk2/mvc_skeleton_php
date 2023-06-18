<?php

// Retrieve the request payload
$requestPayload = file_get_contents('php://input');
$data = json_decode($requestPayload, true);

// Check if the event is payment.success
if ($data['event'] === 'payment.success') {
    // Payment successful, update user's wallet here
    $reserveAccountNumber = $data['data']['DAN'];
    $amount = $data['data']['amount'];

    // TODO: Implement your wallet update logic here

    // Example logic: Update the user's wallet balance in the database
    $updatedBalance = getUserWalletBalance($reserveAccountNumber) + $amount;
    updateUserWalletBalance($reserveAccountNumber, $updatedBalance);

    // Log the wallet update
    error_log("User wallet updated: Reserve Account Number $reserveAccountNumber, Amount $amount");
}

// Return a response to the webhook request
http_response_code(200);

/**
 * Example function to get the user's wallet balance from the database
 * Replace this function with your actual implementation to fetch the balance from your database.
 *
 * @param string $reserveAccountNumber
 * @return float
 */
function getUserWalletBalance($reserveAccountNumber)
{
    // TODO: Replace this with your actual database query logic
    // Example implementation (using MySQLi):
    $mysqli = new mysqli("localhost", "username", "password", "database_name");
    $stmt = $mysqli->prepare("SELECT balance FROM user_wallets WHERE reserve_account_number = ?");
    $stmt->bind_param("s", $reserveAccountNumber);
    $stmt->execute();
    $stmt->bind_result($balance);
    $stmt->fetch();
    $stmt->close();
    $mysqli->close();

    return $balance;
}

/**
 * Example function to update the user's wallet balance in the database
 * Replace this function with your actual implementation to update the balance in your database.
 *
 * @param string $reserveAccountNumber
 * @param float $balance
 */
function updateUserWalletBalance($reserveAccountNumber, $balance)
{
    // TODO: Replace this with your actual database query logic
    // Example implementation (using MySQLi):
    $mysqli = new mysqli("localhost", "username", "password", "database_name");
    $stmt = $mysqli->prepare("UPDATE user_wallets SET balance = ? WHERE reserve_account_number = ?");
    $stmt->bind_param("ds", $balance, $reserveAccountNumber);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
}
