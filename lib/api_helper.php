<?php
require_once(__DIR__ . "/load_api_keys.php");

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch?query=pasta&cuisine=italian&excludeCuisine=greek&diet=vegetarian&intolerances=gluten&equipment=pan&includeIngredients=tomato%2Ccheese&excludeIngredients=eggs&type=main%20course&instructionsRequired=true&fillIngredients=false&addRecipeInformation=false&titleMatch=Crock%20Pot&maxReadyTime=20&ignorePantry=true&sort=calories&sortDirection=asc&minCarbs=10&maxCarbs=100&minProtein=10&maxProtein=100&minCalories=50&maxCalories=800&minFat=10&maxFat=100&minAlcohol=0&maxAlcohol=100&minCaffeine=0&maxCaffeine=100&minCopper=0&maxCopper=100&minCalcium=0&maxCalcium=100&minCholine=0&maxCholine=100&minCholesterol=0&maxCholesterol=100&minFluoride=0&maxFluoride=100&minSaturatedFat=0&maxSaturatedFat=100&minVitaminA=0&maxVitaminA=100&minVitaminC=0&maxVitaminC=100&minVitaminD=0&maxVitaminD=100&minVitaminE=0&maxVitaminE=100&minVitaminK=0&maxVitaminK=100&minVitaminB1=0&maxVitaminB1=100&minVitaminB2=0&maxVitaminB2=100&minVitaminB5=0&maxVitaminB5=100&minVitaminB3=0&maxVitaminB3=100&minVitaminB6=0&maxVitaminB6=100&minVitaminB12=0&maxVitaminB12=100&minFiber=0&maxFiber=100&minFolate=0&maxFolate=100&minFolicAcid=0&maxFolicAcid=100&minIodine=0&maxIodine=100&minIron=0&maxIron=100&minMagnesium=0&maxMagnesium=100&minManganese=0&maxManganese=100&minPhosphorus=0&maxPhosphorus=100&minPotassium=0&maxPotassium=100&minSelenium=0&maxSelenium=100&minSodium=0&maxSodium=100&minSugar=0&maxSugar=100&minZinc=0&maxZinc=100&offset=0&number=10&limitLicense=false&ranking=2",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
		"X-RapidAPI-Key: ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
function _sendRequest($url, $key, $data = [], $method = 'GET', $isRapidAPI = true, $rapidAPIHost = "")
{
    global $API_KEYS;
    // Check if the API key is set and not empty
    if (!isset($API_KEYS) || !isset($API_KEYS[$key]) || empty($API_KEYS[$key])) {
        throw new Exception("Missing or empty API KEY");
    }
    $headers = [];
    if ($isRapidAPI) {
        $headers = [
            "X-RapidAPI-Host" => $rapidAPIHost,
            "X-RapidAPI-Key" => $API_KEYS[$key],
        ];
    } else {
        $headers = [
            "x-api-key" => $API_KEYS[$key]
        ];
    }
    $callback = fn(string $k, string $v): string => "$k: $v";
    $headers = array_map($callback, array_keys($headers), array_values($headers));
    $curl = curl_init();

    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "", // Specify encoding if known
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ];

    if ($method == 'GET') {
        $options[CURLOPT_URL] = "$url?" . http_build_query($data);
    } else {
        $options[CURLOPT_URL] = $url;
        $options[CURLOPT_POST] = true;
        $options[CURLOPT_POSTFIELDS] = http_build_query($data);
    }
    error_log("curl options: " . var_export($options, true));
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        throw new Exception($err);
    } else {
        return ["status"=>200, "response"=>$response];
    }
}

/**
 * Send a GET request to the specified URL.
 * 
 * @param string $url The URL to send the request to.
 * @param string $key The API key to use for the request.
 * @param array $data The data to send with the request.
 * @param bool $isRapidAPI Whether the request is for RapidAPI.
 * @param string $rapidAPIHost The host value for the RapidAPI Header
 * 
 * @return array The response status and body.
 */
function get($url, $key, $data = [], $isRapidAPI = true, $rapidAPIHost = "")
{
    return _sendRequest($url, $key, $data, 'GET', $isRapidAPI, $rapidAPIHost);
}


/**
 * Send a POST request to the specified URL.
 * 
 * @param string $url The URL to send the request to.
 * @param string $key The API key to use for the request.
 * @param array $data The data to send with the request.
 * @param bool $isRapidAPI Whether the request is for RapidAPI.
 * @param string $rapidAPIHost The host value for the RapidAPI Header
 * 
 * @return array The response status and body.
 */
function post($url, $key, $data = [], $isRapidAPI = true,  $rapidAPIHost = "")
{
    return _sendRequest($url, $key, $data, 'POST', $isRapidAPI, $rapidAPIHost);
}