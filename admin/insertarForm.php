<html>
    <head> <link rel='stylesheet' href='main.css'>

    </head>
    <style >

    @font-face {
    font-family: Harmony;
    src: url('img/icons/harmony.ttf')  format('truetype');
    }
    titulo {
    	font-family: Harmony;
    }
    /*
    Basic input element using psuedo classes
    */
    .login {
    	margin: 20px auto;
    	width: 450px;
    	padding: 30px 25px;
    	background: white;


    }
    html,
    body {
      height: 100%;
    }
    body {

      font-family: Avenir;
      -webkit-text-size-adjust: 100%;
      -webkit-font-smoothing: antialiased;
    }

    .inp {
      position: relative;
      margin: auto;
      width: 100%;
      max-width: 500px;
    }
    .inp .label {
      position: absolute;
      top: 16px;
      left: 0;
      font-size: 16px;
      color: #9098a9;
      font-weight: 500;
      transform-origin: 0 0;
      transition: all 0.2s ease;
    }
    .inp .border {
      position: absolute;
      bottom: 0;
      left: 0;
      height: 2px;
      width: 100%;
      background: #07f;
      transform: scaleX(0);
      transform-origin: 0 0;
      transition: all 0.15s ease;
    }
    .inp input {
      -webkit-appearance: none;
      width: 100%;
      border: 0;
      font-family: inherit;
      padding: 12px 0;
      height: 48px;
      font-size: 16px;
      font-weight: 500;
      border-bottom: 2px solid #c8ccd4;
      background: none;
      border-radius: 0;
      color: #223254;
      transition: all 0.15s ease;
    }
    .inp input:hover {
      background: rgba(34,50,84,0.03);
    }
    .inp input:not(:placeholder-shown) + span {
      color: #5a667f;
      transform: translateY(-26px) scale(0.75);
    }
    .inp input:focus {
      background: none;
      outline: none;
    }
    .inp input:focus + span {
      color: #07f;
      transform: translateY(-26px) scale(0.75);
    }
    .inp input:focus + span + .border {
      transform: scaleX(1);
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
    font-size: 15px;
    color: #fff;
    text-align: center;
    background: #dddbdb;
    border: 0;
    border-radius: 4px;
    cursor: pointer;
    outline:0;
  }
    </style>

    <body>
        <?php
          include 'header.php';

            $table = $_GET["tabla"];


                insertForm($table);


        ?>
        
    </body>
</html>
