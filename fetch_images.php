<?php
$conn = mysqli_connect("localhost", "root", "","testing");
 $sql = "select images from task";
 
 $result = $conn->query($sql);

 if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
     {
        $image_src= "img/".$row['images'];
        echo "<img src='$image_src' class='img-thumbnail' />";
    
    
 }
}
 
 
?>
