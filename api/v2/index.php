<?php
//ini_set('log_errors', 1);
//ini_set('error_log', '/path/to/your/php-error.log');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
class nolife_ai {

    function curlit($url) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Charset: utf-8"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            $oo = curl_exec($ch);
            if (!$oo) {
                return "";
            } else {
                return $oo;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    function fetch_did_you_know($word) : string {
        $fetch = "https://en.wikipedia.org/w/api.php?origin=*&action=query&format=json&prop=extracts&titles=" . urlencode($word);
        $buffer = $this->curlit($fetch);
        $buffer = mb_convert_encoding($buffer, 'UTF-8', mb_detect_encoding($buffer, 'UTF-8, ISO-8859-1', true));
        $json = json_decode($buffer, true);

        try {
            $page = array_values($json["query"]["pages"])[0];
            // $title = $page["title"];

            $extract = $page["extract"];
            $htmlContent = $extract;  // Your HTML content goes here

            // Create a new DOMDocument instance and load the HTML content
            $dom = new DOMDocument();
            // Use libxml_use_internal_errors to suppress errors due to malformed HTML
            libxml_use_internal_errors(true);
            if (empty($htmlContent)) {
                return "";
            }
            $dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors(); // Clear errors after parsing

            // Create a new DOMXPath instance and query for the first <p> tag
            $xpath = new DOMXPath($dom);
            $paragraphs = $xpath->query('//p[not(contains(., "refer to") or contains(., "refers to"))]');

            // Check if we have at least one <p> tag
            if ($paragraphs->length > 0) {
                $randomIndex = rand(0, $paragraphs->length - 1);

                // Fetch the random <p> tag
                $randomP = $paragraphs->item($randomIndex);

                // Extract the content inside the <p> tag
                $randomPContent = $dom->saveHTML($randomP);
                return trim(strip_tags($randomPContent));
            } else {
                return "";
            }
        } catch (\Exception $e) {
            return "";
        }
    }

    // add smileys to messages
    function addSmileys($msg) : string {
        $smileyPatterns = file($_ENV["nolife_path"]."data/alias.txt");
        $smileyReplacements = [];

        // Pre-process the smileys into a key-value array
        foreach ($smileyPatterns as $smileyPattern) {
            list($smiley, $replacement) = array_map('trim', explode("=>", $smileyPattern));
            $smileyReplacements[$smiley] = $replacement;
        }

        // Iterate through the smiley replacements and update the message
        foreach ($smileyReplacements as $smiley => $replacement) {
            // Add spaces to ensure that only standalone smileys are replaced
            $smileyWithSpaces = " {$smiley} ";
            $replacementWithSpaces = " {$replacement} ";
            if (strpos($msg, $smileyWithSpaces) !== false) {
                $msg = str_replace($smileyWithSpaces, $replacementWithSpaces, $msg);
            }
        }

        return $msg;
    }


    // replace curse words with random things
    function replace_curse_words($msg) : string {
        $curse_words = file($_ENV["nolife_path"]."data/banned-words.txt");
        $things = file($_ENV["nolife_path"]."data/question-responses/things.txt");
        $random_thing = $things[mt_rand(0, count($things) - 1)];
        $msg = str_replace($curse_words, $random_thing, $msg);
        return $msg;
    }

    // detect and answer questions
    function detect_and_answer_questions($input) : string {
        $response = "";
        $things = file($_ENV["nolife_path"]."data/question-responses/things.txt");
        $questions = file($_ENV["nolife_path"]."data/words-questions.txt");
        foreach ($questions as $question) {
            $question_word = explode(":", $question)[0];
            if (strpos($input, $question_word) !== false) {
                $available_responses = file($_ENV["nolife_path"]."data/question-responses/" . trim(explode(":", $question)[1]));
                return $available_responses[mt_rand(0, count($available_responses) - 1)];
            }
        }
        return $response;
    }

    function remove_spacings($input): string {
        $input = preg_replace('/\s{2,}/', ' ', $input);
        return trim($input);
    }

    function remove_garbage_input($input) : string {
        $input = strtolower($input);
        $input = preg_replace("/[^a-zA-Z0-9 ]/", '', $input);
        $garbage = file($_ENV["nolife_path"]."data/words-meaningless.txt");
        foreach ($garbage as $garbage_word) {
            $input = str_replace($garbage_word, "", $input);
        }
        return $this->remove_spacings($input);
    }

    function respond_randomly() : string {
        $things = file($_ENV["nolife_path"]."data/random.txt");
        return $things[mt_rand(0, count($things) - 1)];
    }

    function snob_response($input): string {
        $things = file($_ENV["nolife_path"]."data/question-responses/did-you-know.txt");
        return $things[mt_rand(0, count($things) - 1)]. " " . $input;
    }

    function detect_and_assign_colors($input) : string {
        $colors = file($_ENV["nolife_path"]."data/colors.txt");
        foreach ($colors as $color) {
            $color_word = explode(":", $color)[0];
            if (strpos($input, $color_word) !== false) {
                return trim(explode(":", $color)[1]);
            }
        }
        return "#e0f7fa";
    }

    // main render function
    function render() : string {
        $input = " ".strip_tags($this->remove_spacings($_POST["msg"]))." ";

        // filter out curse words
        $input = $this->replace_curse_words($input);

        // filtered input
        $filtered_input = $this->remove_garbage_input($input);

        // detect and assign colors
        $chat_color = $this->detect_and_assign_colors($filtered_input);

        // check if we know anything about what the user is talking about
        $random_word = explode(" ", $filtered_input)[mt_rand(0, count(explode(" ", $filtered_input)) - 1)];
        $did_you_know = $this->fetch_did_you_know($random_word);

        // detect and answer questions
        $response = $this->detect_and_answer_questions($filtered_input);

        if (empty($did_you_know)) {
            if (empty($response)) {
                $response = $this->respond_randomly();
            }
        } else {
            $response = $response . " " . $this->snob_response($did_you_know);
        }

        // no question detected, respond with something that doesn't mean anything.
        if (empty($response)) {
            $response = $this->respond_randomly();
        }

        // filter out curse words
        $response = $this->replace_curse_words($response);

        // add smileys
        $response = $this->addSmileys($response);
        $input = $this->addSmileys($input);

        $response = str_replace("%random%", mt_rand(1,999), $response);

        return json_encode([
            "nolife" => $response,
            "bg_color" => $chat_color,
            "color" => "#000",
            "msg" => $input,
        ]);
    }
}
try {
    $_ENV["nolife_path"] = $_SERVER["DOCUMENT_ROOT"]."/";
    $new_life = new nolife_ai();
    echo $new_life->render();
} catch (\Exception $e) {
    echo json_encode([
        "nolife" => "I'm sorry, I don't know what to say.",
        "color_1" => "#e0f7fa",
        "msg" => "I have no idea what I'm saying!",
    ]);
}