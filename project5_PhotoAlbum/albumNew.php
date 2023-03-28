<?php session_start();
if(!isset($_SESSION["username"])){
header("Location: http://localhost/project5/login.php");
exit();
}
?>
<html>
    <head>
        <title></title>
    </head>
    <style>
        .container{
            width: 100%;
            overflow: auto;
        }
        #output2{
            width: 25% ;
            height:auto;
        }
        #links{
            width: 75%;
        }
        .logbtn{
            position:fixed;
            right:10px;
            top:5px;
        }
        

    </style>
    <body>
        <?php
        $directory = "./images/".$_SESSION["username"];
        $lisImage = scandir($directory);
        $filelisting = array_diff($lisImage, array('.','..'));
                
                ?>
        
            <form action="album.php" method="POST" enctype="multipart/form-data">
                <h3> Welcome! </h3><p id="user"><?php echo ucfirst($_SESSION['username']); ?></p>
                <p>Upload your Images Here!!</p>
                <input type="file" name="file" id="imageFile">
                <br><br>
                <button type="button" name="submit" id="insert" value="Insert" class="B1" onclick="uploadFile()">Upload Image</button>
                <br><br>
                <button type="button" class="logbtn" id ="logbtn" name="logout" onclick="window.location.href='logout.php?logout=true'">Logout</button> 
                
            </form>
            <div class= container>
                <div  id="links"></div>
                <div id="output2" ></div>

            </div>
        <script type="text/javascript">
            var myVar = "";
            var myUserImgList = <?php echo json_encode($filelisting); ?>;
            var viewImgList = Object.values(myUserImgList);
            for(var i=0; i<viewImgList.length;i++){
                myVar += "<a href = '#' onclick='display(this)'>" +viewImgList[i]+"</a><br>";
                document.getElementById("links").innerHTML = myVar;
            }
            console.log(myUserImgList);
            function uploadFile() {
                var formdata = new FormData();
                formdata.append("file", document.getElementById("imageFile").files[0]);
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "album.php", true);
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        var obj = this.responseText;
                        console.log(obj);
                        var data=document.getElementById("links");
                        //var data;
                        data.innerHTML+= "<a href='#' onclick= 'display(this)'>" +document.getElementById("imageFile").files[0]["name"]+"</a><br>";
                        //document.getElementById("links").innerHTML= data;
                       }
                };
                xhttp.send(formdata);
            }
            function display(Img){
                var Img1=document.getElementById("output2");
                var myUser = document.getElementById("user").innerHTML;
                Img1.innerHTML = "<img src= './images/"+ myUser + "/" + Img.innerHTML + "'>";
            }
        </script>
    </body>
</html>
