<?php 

include('./connect.php');
header('Location: ./admin.php');

$option = $_POST['option'];

switch($option) {
    case 'books':
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $author = $_POST['author'];
        $library_id = $_POST['library_id'];

        $exec = "INSERT INTO `books` (`name`, `genre`, `author`, `library_id`) VALUES ('$name', '$genre', '$author', '$library_id')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        echo $exec;
        break;
    case 'customers':
        $name = $_POST['name'];
        $birth = $_POST['birth'];
        $city = $_POST['city'];

        $exec = "INSERT INTO `customers` (`name`, `birth`, `city`) VALUES ('$name', '$birth', '$city')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'books_rentals':
        $book_id = $_POST['bookId'];
        $customer_id = $_POST['customerId'];
        $date = $_POST['date'];

        $exec = "INSERT INTO `books_rentals` (`book_id`, `customer_id`, `date`) VALUES ('$book_id', '$customer_id', '$date')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'requests_to_suppliers':
        $book_id = $_POST['bookId'];
        $request_date = $_POST['requestDate'];
        $delivery_confirmation = $_POST['deliveryConfirmation'] == 'on' ? 1 : 0;
        $corporate_id = $_POST['corporateId'];

        $exec = "INSERT INTO `requests_to_suppliers` (`book_id`, `request_date`, `delivery_confirmation`, `corporate_id`) VALUES ('$book_id', '$request_date', '$delivery_confirmation', '$corporate_id')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'suppliers':
        $corporate_name = $_POST['corporateName'];
        $localization = $_POST['localization'];

        $exec = "INSERT INTO `suppliers` (`corporate_name`, `localization`) VALUES ('$corporate_name', '$localization')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'library':
        $localization = $_POST['localization'];

        $exec = "INSERT INTO `libraries` (`localization`) VALUES ('$localization')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    default: 
        echo 'Falha no switch';
}

?>