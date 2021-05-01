

<!DOCTYPE html>
<html>
<head>

<style class="cp-pen-styles">
    
body {
  margin: 40px;
}

.parent {
  
 height: 500px; 
width: 500px; 
              
}
    
.wrapper {
  display: grid;
  grid-template-rows: 61px 61px 61px 61px 61px ;
  grid-template-columns: 61px 61px 61px 61px;
  grid-gap: 1px;
  background-color: #fff;
  color: #444;
   z-index: 2;
    position: absolute;
    opacity: 0.5;
}
    
    .container {
  z-index: 1;
        position: absolute;
        
}


.box {
  background-color: #444;
  color: #fff;

    padding: 0px;
  font-size: 100%;
  cursor: crosshair;
  
  display: flex;
  justify-content: center;
  align-items: center;
    border-color: blue;
    z-index: 2;
    opacity: 0.5;
}
    

    
    </style>
    
</head>
<body>
  
    <div class="parent">
    <div class="container">
       <img src="World.png" alt="Girl in a jacket" style="width:248px;height:248px;">
</div>
        
<div class="wrapper">
  <div class="box a">A</div>
  <div class="box b">B</div>
  <div class="box c">C</div>
  <div class="box d">D</div>
    
  <div class="box e">E</div>
  <div class="box f">F</div>   
    <div class="box g">G</div>
    <div class="box h">H</div>
    
    <div class="box i">I</div>
    <div class="box j">J</div>
    <div class="box k">K</div>
    <div class="box l">L</div>
    
    <div class="box m">M</div>
    <div class="box n">N</div>
    <div class="box o">O</div>
    <div class="box p">P</div> 
</div>
   </div> 
     
    <input type="text" id="mytext">
    
    <script>
    var newArray= new Array();
window.addEventListener("DOMContentLoaded", function() {
  let boxes = document.querySelectorAll(".box");

  Array.from(boxes, function(box) {
     
    box.addEventListener("click", function() {
     // alert(this.classList[1]);
       var test = this.classList[1];
        newArray.push(this.classList[1]);

        //alert("newArray contents = "+ newArray);
        
       // alert(newArray.join(''));
        var join = newArray.join('');
     document.getElementById("mytext").value = join;   
    });
      
     
      
  });
    
});
        

    </script>
    
</body>
</html>