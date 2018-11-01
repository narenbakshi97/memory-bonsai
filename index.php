<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/addons/p5.dom.min.js"></script>
	<script src="flower.js"></script>
	<script src="bonsai.js"></script>
	<script src="trunk.js"></script>
	<title>Cherrish memory</title>

	<style>
		body{
			overflow-x: hidden;
			background: url("bg1.jpg");
			background-repeat: no-repeat;
			background-size: cover;
		}
		.stitched {
		   padding: 20px;
		   margin: 5px;
		   background: #020;
		   color: #DAA520;
		   font-weight: bold;
		   line-height: 1.3em;
		   border: 2px dashed #DAA520;
		   border-radius: 10px;
		   box-shadow: 0 0 0 4px #000, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
		   text-shadow: -1px -1px #aa3030;
		   font-weight: normal;
		   cursor:pointer;
		}
		h3{
			display: inline;
		}
		#formDiv{
			font-family: 'Shadows Into Light', cursive;
			height:610px;
			width:1000px;
			background-color:rgba(255,255,255,0.5);
			color:#ed225d;
		}
		#memoryDiv{
			font-family: 'Shadows Into Light', cursive;
			border:5px pink solid;
			margin:0 20% 0 30%;
			width:500px;
			background-color:rgba(255,255,255,0.9);
			color:#ed225d;
		}
		#memoryDiv h2{
			font-size:40px;
		}
		#memoryDiv span{
			display:block;
			font-size:30px;
			text-align:right;
		}
		#memoryDiv p{
			font-size:25px;
		}
		#memoryDiv img{
			display: block;
			margin:3% auto;
		    max-width: 450px;
		    max-height:500px;
		}
		.form-group{
			margin:20px;
		}
		.label-control{
			margin:10px;
			font-weight:bold;
			text-transform: uppercase;
			font-size:25px;
		}
		.form-control input, .form-control textarea{
			padding:10px 30px;
			font-size:20px;
			color:#ed225d;
		}
		:hover .btn-pink{
			color:#fff;
			background:rgb(255,105,180);
		}
		.btn-pink{
			color:#eee;
			background:rgb(255,20,147);
			padding:10px 20px;
		}
		#memoryDiv button{
			margin-top:200px;
			position:absolute;
			z-index:1;
			color:#ed225d;
			font-size:80px;
			font-weight:bold;
			background:transparent;
			border:0;
		}
	</style>
</head>
<body class="container-fluid">
	<div id="tree"></div>

</body>
<script type="text/javascript">
	function newFlower(){
		console.log("called");
		memoryFlowers = [];
		<?php
		$db = mysqli_connect("localhost","root","","bonsai"); //keep your db name
		$sql = "SELECT * FROM mem";
		$result = $db->query($sql);
		while($row = $result->fetch_assoc()) {
        ?>
        	memoryFlowers.push(new MemoryFlower('<?php echo $row["title"];?>','<?php echo $row["memory"];?>','<?php echo $row["date"];?>','<?php echo $row["time"];?>',"<?php echo 'data:image/jpeg;base64,'.base64_encode( $row['image'] )?>",memoryFlowers.length));
        <?php
    	}
    	?>
	}

	function showPrev(fIndex){
		memoryDiv.remove();
		let index = (fIndex - 1);
		if(index == -1){
			index = memoryFlowers.length-1;
		}
		//console.log(index);
		showMemory(memoryFlowers[index]);
	}

	function showNext(fIndex){
		memoryDiv.remove();
		let index = (fIndex + 1)%memoryFlowers.length;
		//console.log(index);
		showMemory(memoryFlowers[index]);
	}

	function showMemory(flower){
		memoryOpen = true;
		memoryDiv = createDiv("<button onclick='showPrev("+flower.index+")' style='margin-left:-100px;'>&lt;</button><button onclick='showNext("+flower.index+")' style='margin-left:500px;'>&gt;</button><img src='"+flower.img+"'/><h3 class='text-center'>"+(flower.index+1)+"/ "+ (memoryFlowers.length) +"</h3><h2>"+flower.title+"</h2><span>"+flower.date+" "+flower.time+"</span><p>"+flower.memory+"</p>");
		memoryDiv.id("memoryDiv");
		memoryDiv.addClass("col-md-12");
		memoryDiv.position(0,0);
	}
</script>
<?php
   $dbh = new PDO("mysql:host=localhost;dbname=bonsai", "root", "");
    if(isset($_POST["submit"])){
    	$title = $_POST['title'];
    	$memory = $_POST['memory'];
    	$date = $_POST['date'];
    	$time = $_POST['time'];

	    $imagename= $_FILES["userfile"]["name"]; 
	    //echo $imagename;
	    $imagetmp 	= (file_get_contents($_FILES['userfile']['tmp_name']));
	    $stmt = $dbh->prepare("INSERT INTO mem(title,memory,date,time,image) VALUES(?,?,?,?,?)");
	    $stmt->bindParam(1,$title);
	    $stmt->bindParam(2,$memory);
	    $stmt->bindParam(3,$date);
	    $stmt->bindParam(4,$time);
	    $stmt->bindParam(5,$imagetmp);
	    $stmt->execute();
	    if($stmt){
	    	echo "<script>alert('Memory added!');</script>";
	    	// header('index.php');
	    }
	}
?>
</html>