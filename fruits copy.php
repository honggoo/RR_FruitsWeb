<?php
    header('Access-Control-Allow-Origin:http://cci-icr.sakura.ne.jp/');
	header('Content-Type:text/plain;charset=UTF-8');
  
    $apiKey = 'a7f6f581-b80e-4021-969e-aaf88acad21e:iH3lWiyjtXW5';

	$question = isset($_POST['question']) ? htmlspecialchars($_POST['question']) : null;
	if( $question==null) header( 'Location: ./errorS.php' );

    $url = 'https://'. $apiKey . '@gateway.watsonplatform.net/retrieve-and-rank/api/v1/solr_clusters/sc4b7d1bdf_89d5_4799_8a99_a7ccc2e03738/solr/fruits_collection/select?q=' . $question . '&wt=csv&fl=id,body';


    $response=file_get_contents($url) or exit("Can not open\n");

    $answer = json_decode($response,true);

    echo $response;
?>
