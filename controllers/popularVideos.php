<?php

    function channelPopVids($api_key,$region,$max){
        $youtube = file_get_contents(
            'https://youtube.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&chart=mostPopular&maxResults='.$max.'&regionCode='.$region.'&videoCategoryId=10&key='.$api_key
        );

        // Decoding json youtube api response
        $youtube_api_response = json_decode($youtube, true);


        for($x = 0; $x < $max; $x++){

            $vid = $youtube_api_response['items'][$x]['snippet']['title'];
            $channel = $youtube_api_response['items'][$x]['snippet']['channelTitle'];
            $day = substr($youtube_api_response['items'][$x]['snippet']['publishedAt'],5,5);
            $length = $youtube_api_response['items'][$x]['contentDetails']['duration'];
            $vidId = $youtube_api_response['items'][$x]['id'];

            echo '
                <tr style="margin:0;padding:0;">
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="yvideo-box"> 
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/'.$vidId.'" frameborder="0" allowfullscreen></iframe>  
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                      <div class="form-check">'.$day.'</div>
                    </td>
                    <td>'.$vid.'-<span class="small"> '.$length.' </span>&rarr; <span class="font-weight-bold">'.$channel.'</span></td>
                    <td class="td-actions text-right">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#download" 
                            data-video="'.$vid.'" data-id="'.$vidId.'">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                              <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                        </button> 
                    </td>
      
                </tr>';

        }
    }



?>

