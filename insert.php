

<?php
$data = $_POST["image"];


$image_array_1 = explode(";", $data);


$image_array_2 = explode(",", $image_array_1[1]);


$data = base64_decode($image_array_2[1]);

$imageName = time().".png";

file_put_contents("img/".$imageName, $data);

$conn = mysqli_connect("localhost", "root", "","testing");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "insert into task(images) values ('$imageName')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
