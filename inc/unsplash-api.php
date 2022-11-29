<?php
// Access settings.php and get access key
define('ALLOWSETTINGS', TRUE);
require_once('./settings.php');

// Build public api query get json, render html
class UnsplashPublicAPI {
    public $url;
    public $json;
    public $html;

    public function __construct( $query, $per_page, $pages ) {
        $this->url = 'https://api.unsplash.com/search/photos?&query='.$query.'&per_page='.$per_page.'&page='.$pages;
    }

    public function getCurl() {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Client-ID ".ACCESS_KEY,
            ),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url,
        ]);
        
        $resp = curl_exec($curl);

        // Check response and return
        if ( curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200 ) {
            $this->json = $resp;
        }

        // Close request, clear up resources
        curl_close($curl); 
    }

    public function results() {
        // cURL get request to api
        $this->getCurl();
        
        // Check if valid, decode and loop to build output
        if ( isset($this->json) ) {
            $i = 0;
            $loading = 'loading="eager"';
            $jsonArr = json_decode($this->json);

            foreach($jsonArr->results as $result) {

                //Lazy load after intial 6 images
                if ($i > 6) {
                    $loading = 'loading="lazy"';
                }

                // Build HTML Ouput - image hotlinking required by API
                $this->html .=
                '<figure class="unsplash-img">
                    <picture>
                        <img src="'.$result->urls->raw.'&w=480&h=480&auto=format&fit=crop" alt="'.$result->alt_description.'" '.$loading.'>
                        <figcaption><span>Credit: '.$result->user->name.'</span></figcaption>
                    </picture>
                </figure>'
                ;

                $i++;
            } 
        } else {
            $this->html .= '<h2>There was an issue, please try again later</h2>';
        }    
    }
    
}

?>