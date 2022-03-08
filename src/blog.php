<?php
  session_start();
  //session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>blog likho</title>
</head>
<body>
    <div>
        <div id="left">
            <div>
               <textarea id="blog" rows="10" cols="60" placeholder="write your blog here...!"></textarea>
            </div>
            <div>
               <button id="btn1" >Upload Blog</button>
               <button id="btn2" >Update Blog</button>
            </div>
        </div>
        <div id="right">

        </div>
    </div>
    <script>
     var blog_array = [];
$(document).ready( function(){
    $('#btn2').hide();
   $('#btn1').on('click' , function() {
       var blog = $('#blog').val();
       $.ajax({
           url: 'post.php',
           datatype: 'json',
           type: 'post',
           data: {
               blog: blog,
               action: 'blog'
           },
           success: function(data){
            blog_array = JSON.parse(data);
            display(blog_array);
           }
       })
   })
})
var index;
function edit(x){
    $('#btn1').hide();
    $('#btn2').show();
    for(var i = 0; i < blog_array.length ; i++){
       if(i == x){
           index = x;
        $('#blog').val(blog_array[i]);
        $('#btn2').on('click' ,function() {
                    $('#btn2').hide();
                    $('#btn1').show();
                      var u_value = $('#blog').val();
                            $.ajax({
                                 url: 'post.php',
                                 datatype: 'json',
                                 type: 'post',
                                 data: {
                                         id: index,
                                         u_value: u_value,
                                         action: 'edit'
                                    },
                                success: function(data){
                                    console.log(data);
                                blog_array = JSON.parse(data);
                                console.log(blog_array);
                                 display(blog_array);
                                }
                            })
         })

       }
    }
}
function Delete(x) {
 for(var i = 0 ;i < blog_array.length ; i++) {
     if(x == i){
          $.ajax({
              url: 'post.php',
              type: 'post',
              datatype: 'json',
              data: {
                  id: x,
                  action: 'delete'
              },
              success: function(data) {
                blog_array = JSON.parse(data);
                display(blog_array);
              }
          })
     }
   }
}
    function display(blog){
        html ='<table>';
        for(var i = 0; i < blog.length ; i++){
            html += '<tr><td><button onclick="edit('+i+')">EDIT</button></td><td><button onclick="Delete(' + i + ')">DELETE</button></td><td>' + blog[i] + '</td></tr>'
        }
        html +='</table>';
        document.getElementById("right").innerHTML = html;
    }

    </script>
    
</body>
</html>