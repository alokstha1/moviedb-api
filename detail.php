<?php
// detail movie page
// echo 'fasdfasdf';

if ( isset( $_GET['movie_id'] ) && !empty( $_GET
['movie_id'] ) ) {


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$_GET['movie_id']."?language=en-US&api_key=f200ea93d28d03201a0e1caee1ebd3e6",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS => "{}",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {

        $json_response  = json_decode($response);

        if ( !empty( $json_response ) ) {

            echo $json_response->title;
            echo "<br/>";
            ?>
            <a href="#" class="add-favorite" data-id="<?php echo $json_response->id; ?>">Add to Favorite</a>
            <?php
        }
    }

    // related movies section
    ?>
    <h2>Related movies</h2>
    <?php

    $similar_movie_curl = curl_init();

    curl_setopt_array($similar_movie_curl, array(
      CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$_GET['movie_id']."/similar?page=1&language=en-US&api_key=f200ea93d28d03201a0e1caee1ebd3e6",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS => "{}",
    ));

    $similar_movie_response = curl_exec($similar_movie_curl);
    $simliar_movies_err = curl_error($similar_movie_curl);

    curl_close($similar_movie_curl);

    if ($simliar_movies_err) {
      echo "cURL Error #:" . $simliar_movies_err;
    } else {
      echo $similar_movie_response;
    }

}