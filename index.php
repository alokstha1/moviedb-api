<?php
// this is the main page for movie-api
?>

<form action="" method="GET">
    <input type="text" name="query">
    <input type="submit" name="submit_query" value="Search">
</form>

<?php

if ( isset( $_GET['query'] ) && !empty( $_GET['query'] ) ) {
    $query = $_GET['query'];

    // <?php

    $curl = curl_init();


    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=f200ea93d28d03201a0e1caee1ebd3e6&language=en-US&page=1&query=".$query,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if (!empty( $response ) ) {
      // echo $response;

        $json_decode    = json_decode($response);


        if ( !empty( $json_decode->results ) ) {
            ?>
            <ul>
                <?php
                    foreach ($json_decode->results as $result_value) {

                        $movie_link = 'http://localhost/test-movie-api/detail.php?movie_id='.$result_value->id;
                        ?>
                        <li>
                            <a href="<?php echo $movie_link; ?>"><?php echo $result_value->title; ?></a>
                        </li>
                        <?php
                    }
                ?>
            </ul>
            <?php
        }
    }
}