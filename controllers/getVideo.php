<?php

    function getVideo($api_key,$id,$ftype){
        $youtube = file_get_contents(
            'https://youtube.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id='.$id.'&key='.$api_key
        );

        // Decoding json youtube api response
        $youtube_api_response = json_decode($youtube, true);

        $vid = $youtube_api_response['items'][0]['snippet']['title'];
        $channel = $youtube_api_response['items'][0]['snippet']['channelTitle'];
        $day = substr($youtube_api_response['items'][0]['snippet']['publishedAt'],0,10);
        $length = $youtube_api_response['items'][0]['contentDetails']['duration'];
        $vidId = $youtube_api_response['items'][0]['id'];
        $url = 'https://www.youtube.com/watch?v='.$vidId;
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $downloadId = $match[1];

        echo '
            <tr>
                <td>
                  <div class="form-check">'.$day.'</div>
                </td>
                <td>'.$vid.'-<span class="small"> '.$length.' </span>&rarr; <span class="font-weight-bold">'.$channel.'</span></td>
                <td class="td-actions text-right">
                    
                </td>
  
            </tr>

            <tr>
                <td colspan="3">
                  <iframe scrolling="yes" src="https://www.yt-download.org/@api/button/'.$ftype.'/'.$downloadId.'" allowtransparency="true">
                  </iframe>
                </td>
            </tr>';
    }



?>

