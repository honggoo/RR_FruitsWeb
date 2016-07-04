<?php
    header('Access-Control-Allow-Origin:http://cci-icr.sakura.ne.jp/');
	header('Content-Type:text/plain;charset=UTF-8');
  
    $apiKey = 'a7f6f581-b80e-4021-969e-aaf88acad21e:iH3lWiyjtXW5';

	$question = isset($_POST['question']) ? htmlspecialchars($_POST['question']) : null;
	if( $question==null) header( 'Location: ./errorS.php' );

    $url = 'https://'. $apiKey . '@gateway.watsonplatform.net/retrieve-and-rank/api/v1/solr_clusters/sc4b7d1bdf_89d5_4799_8a99_a7ccc2e03738/solr/fruits_collection/select?q=' . $question . '&wt=csv&fl=id,body';

//file_get_contents関数でデータを取得
if($answer = @file_get_contents($url)){
    //ここにデータ取得が成功した時の処理
    var_dump( $answer);
}else{
    //エラー処理
    if(count($http_response_header) > 0){
        //「$http_response_header[0]」にはステータスコードがセットされているのでそれを取得
        $status_code = explode(' ', $http_response_header[0]);  //「$status_code[1]」にステータスコードの数字のみが入る
 
        //エラーの判別
        switch($status_code[1]){
            //404エラーの場合
            case 404:
                $answer = "指定したページが見つかりませんでした";
                break;
 
            //500エラーの場合
            case 500:
                $answer = "指定したページがあるサーバーにエラーがあります";
                break;
 
            //その他のエラーの場合
            default:
                $answer = "何らかのエラーによって指定したページのデータを取得できませんでした";
        }
    }else{
        //タイムアウトの場合 or 存在しないドメインだった場合
        $answer = "タイムエラー or URLが間違っています";
    }
}
 

    /*
    $response=@file_get_contents($url) or exit("Can not open\n");

    $answer = json_decode($response,true);
    
    echo $answer;
    */
    

?>
