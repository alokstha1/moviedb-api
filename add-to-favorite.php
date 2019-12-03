<?php
if ( isset($_POST['movie_id'] ) && !empty( $_POST['movie_id'] ) ) {
    echo json_encode(array('success' => 1));
}