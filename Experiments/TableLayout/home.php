<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>


    <body>
        <div id="banner">

        </div>

        <div id="main">
            <table id="the_table">
                <tr>
                    <td id="left">
                        <div id="nav">
                            <a>link1</a><br>
                            <a>link2</a><br>
                            <a>link3</a><br>
                        </div>
                    </td>

                    <td id="middle">
                        <div class="post">
                            
                        </div>
                        
                        <div class="post">
                            
                        </div>   
                        
                       <div class="post">
                            
                        </div>
                        
                        <div class="post">
                            
                        </div>                           
                    </td>
                    
                    <td id="right">
                        <div id="ad">
                            
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="footer">

        </div>     
        
  
        
        
        <div id="notification">
            
        </div>
    </body>



    <style>
        * {
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: orange;
            width: 100%;
        }

        #banner, #footer {
            background-color: rgb(56, 56, 56);
            width: 100%;
            height: 60px;
        }

        #main {
            margin-left: auto;
            margin-right: auto;
            min-width: 720px;
            background-color: yellow;
            width: 100%;
        }

        #the_table {
            width: 100%;
            height: 1080px;
            background-color: pink;
            border-collapse: collapse;
            border-spacing: 0;
        }

        td {
            vertical-align: top;
        }

        #left {
            background-color: red;
            width: 20%;
            padding-right: 20px;
        }

        #middle {
            background-color: greenyellow;
            width: 60%;
        }

        #right {
            background-color: darkgoldenrod;
            width: 20%;
            padding-left: 20px;
        }


        #nav, #ad {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 350px;
            background-color: yellow;
            margin-top: 0;
            padding-top: 0;
        }
        
        .post {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 500px;
            background-color: yellow;
            margin-top: 0;
            margin-bottom: 20px;
            padding-top: 0;
        } 
        
        #notification {
            margin: 0;
            padding: 0;
            width: 300px;
            height: 400px;
            background-color: rgba(220, 220, 220, 0.40);
            /*background-color: pink;*/
            position: absolute;
            left: 200px;
            top: 0px;
            border-radius: 10px;
        }        
    </style>
</html>



