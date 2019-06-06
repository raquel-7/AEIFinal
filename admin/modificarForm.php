<html>
    <head> <link rel='stylesheet' href='main.css'>
        <title>Proyecto</title>
    </head>
    <style >
  .edit {
    margin: 20px auto;
    width: 600px;
    padding: 30px 25px;
    background: white;
    border: 1px solid #c4c4c4;
  }
  h1.edit-title {
    font-family: Poppins-Regular, sans-serif;
    margin: -28px -25px 25px;
    padding: 15px 25px;
    line-height: 30px;
    font-size: 25px;
    font-weight: 300;
    color: black;
    background: #f7f7f7;
  }
  h5.edit-title {
    font-family: Poppins-Regular, sans-serif;
    margin: -28px -25px 25px;
    padding: 15px 25px;
    line-height: 30px;
    font-size: 15px;
    font-weight: 300;
    color: black;
    text-align:center;
    background: white;
  }
  label.edit-title{
    font-family: Poppins-Regular, sans-serif;
    margin: -28px -25px 25px;
    padding: 15px 25px;
    line-height: 30px;
    font-size: 15px;
    font-weight: 300;
    color: black;
    text-align:center;
    background: white;
  }
  .edit-input {
    width: 500px;
    height: 50px;
    margin-bottom: 25px;
    margin-left: 30px;
    padding-left: 50px;
    font-size: 15px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  .edit-input:focus {
      border-color:#6e8095;
      outline: none;
    }
  .edit-button {
    width: 100px;
    height: 50px;
    padding: 0;
    margin-left: 100px;
    font-size: 20px;
    color: #fff;
    text-align: center;
    background: #ffc107;
    border: 0;
    border-radius: 5px;
    cursor: pointer;
    outline:0;
  }
  .cancel-button {
    width: 100px;
    height: 50px;
    padding: 0;
    margin-left: 200px;
    font-size: 20px;
    color: #fff;
    text-align: center;
    background: #dddbdb;
    border: 0;
    border-radius: 5px;
    cursor: pointer;
    outline:0;
  }
    </style>


    <body>
      
        <?php
            include 'header.php';
                updateForm($_GET);


        ?>
        
    </body>
</html>
