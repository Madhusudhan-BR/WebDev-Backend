<?php
$city = "";
$newWeather = "";
$error = "";
if(array_key_exists("city",$_GET) {


    $city = $_GET["city"];

    $file_headers = @get_headers('http://www.weather-forecast.com/locations/' . str_replace(" ", "", $city) . '/forecasts/latest');
    if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $error = "Such a city doesnt exist. Please check city name";

    } else {
        $exists = true;

        $pageContents = file_get_contents('http://www.weather-forecast.com/locations/' . str_replace(" ", "", $city) . '/forecasts/latest');
        $pageContents = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $pageContents);

        $weather = explode('</span></span></span>', $pageContents[1]);
        $newWeather = $weather[0];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Weather Scrapper </title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> 
      
      
    <style type="text/css">
        html { 
          background: url(bg.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }   
        
        body {
            background: none;
        }
        
        .container {
            text-align: center;
            margin-top: 200px;
            width: 500px;
        }

        #weather {
            margin-top: 15px;
        }
    </style>  
  </head>
  <body>
   
      <div class="container">
      
      <h1> What's the weather like?</h1>
      
                <form>
                      <div class="form-group">
                        <label for="city">Please enter a city</label>
                        <input type="text" class="form-control" id="city" aria-describedby="cityHelp" placeholder="Enter a city" name="city" value="<?php if ($city) {
                            echo $city;
                        } ?>">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>

                    <div id="weather">

                        <?php
                            if ($newWeather){
                                echo '<div class="alert alert-success" role="alert">'. $newWeather . '
                                </div>';
                            }
                            else if ($error){
                                echo '<div class="alert alert-danger" role="alert">'. $error . '
                                </div>';
                            }
                        ?>

                    </div>
             </form>      
          
      
      </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>