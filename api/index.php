<?php
    // Make sure session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

function track_events($data) {
    $measurementID = 'G-Z7XD1WV74D'; // Replace with your actual Measurement ID
    $apiSecret = 'bwiFNmRVSQSnAdlWAe_-bg'; // Replace with your API Secret
    $eventName = 'nolife_interaction'; // Replace with your event name
    return sendGA4Event($measurementID, $apiSecret, $eventName, $data);
}

function sendGA4Event($measurementID, $apiSecret, $eventName, $eventParams = array()) {
    $postData = array(
        'client_id' => uniqid(), // A unique identifier for the user or device
        'events' => array(array(
            'name' => $eventName,
            'params' => $eventParams,
        )),
    );

    $url = 'https://www.google-analytics.com/mp/collect?measurement_id=' . $measurementID . '&api_secret=' . $apiSecret;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        // If cURL returns an error
        $error_msg = curl_error($curl);
        // Log or echo the error message for debugging
    }
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // Check the HTTP status code
    curl_close($curl);

    // Return both the response and any error message
    return array('response' => $response, 'error' => $error_msg, 'status_code' => $httpcode);
}

    function curlit($url, $use_proxy = false) {
        $oo = "";
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            $oo = curl_exec($ch);
            if (!$oo) {
                $oo = "";
            }
            curl_close($ch);
        } catch (\Exception $e) {

        }
        return $oo;
    }

    function memory($text) {
        $defaults = array(
            "%bot-head-color%" => "#44ff44",
            "%bot-body-color%" => "#99ff99",
            "%my-head-color%" => "#9999ff",
            "%my-body-color%" => "#aaaaff",
            "%my-name%" => "Me",
            "%bot-name%" => "NoLife Bot",
            "%my-age%" => "x",
            "%bot-age%" => (date("Y") - 2019)
        );

        if (isset($_SESSION[$text])) {
            return $_SESSION[$text];
        } elseif (isset($defaults[$text])) {
            return $defaults[$text];
        } else {
            return "";
        }
    }

    function colored($text) {
        $colored = array(
            "AliceBlue" => "#F0F8FF",
            "Blue" => "#F0F8FF",
            "AntiqueWhite" => "#FAEBD7",
            "Aqua" => "#00FFFF",
            "Aquamarine" => "#7FFFD4",
            "Azure" => "#F0FFFF",
            "Beige" => "#F5F5DC",
            "Bisque" => "#FFE4C4",
            "Black" => "#000000",
            "BlanchedAlmond" => "#FFEBCD",
            "Blue" => "#0000FF",
            "BlueViolet" => "#8A2BE2",
            "Brown" => "#A52A2A",
            "BurlyWood" => "#DEB887",
            "CadetBlue" => "#5F9EA0",
            "Chartreuse" => "#7FFF00",
            "Chocolate" => "#D2691E",
            "Coral" => "#FF7F50",
            "CornflowerBlue" => "#6495ED",
            "Cornsilk" => "#FFF8DC",
            "Crimson" => "#DC143C",
            "Cyan" => "#00FFFF",
            "DarkBlue" => "#00008B",
            "DarkCyan" => "#008B8B",
            "DarkGoldenRod" => "#B8860B",
            "DarkGray" => "#A9A9A9",
            "DarkGrey" => "#A9A9A9",
            "DarkGreen" => "#006400",
            "DarkKhaki" => "#BDB76B",
            "DarkMagenta" => "#8B008B",
            "DarkOliveGreen" => "#556B2F",
            "Darkorange" => "#FF8C00",
            "DarkOrchid" => "#9932CC",
            "DarkRed" => "#8B0000",
            "DarkSalmon" => "#E9967A",
            "DarkSeaGreen" => "#8FBC8F",
            "DarkSlateBlue" => "#483D8B",
            "DarkSlateGray" => "#2F4F4F",
            "DarkSlateGrey" => "#2F4F4F",
            "DarkTurquoise" => "#00CED1",
            "DarkViolet" => "#9400D3",
            "DeepPink" => "#FF1493",
            "DeepSkyBlue" => "#00BFFF",
            "DimGray" => "#696969",
            "DimGrey" => "#696969",
            "DodgerBlue" => "#1E90FF",
            "FireBrick" => "#B22222",
            "FloralWhite" => "#FFFAF0",
            "ForestGreen" => "#228B22",
            "Fuchsia" => "#FF00FF",
            "Gainsboro" => "#DCDCDC",
            "GhostWhite" => "#F8F8FF",
            "Gold" => "#FFD700",
            "GoldenRod" => "#DAA520",
            "Gray" => "#808080",
            "Grey" => "#808080",
            "Green" => "#008000",
            "GreenYellow" => "#ADFF2F",
            "HoneyDew" => "#F0FFF0",
            "HotPink" => "#FF69B4",
            "IndianRed " => "#CD5C5C",
            "Indigo " => "#4B0082",
            "Ivory" => "#FFFFF0",
            "Khaki" => "#F0E68C",
            "Lavender" => "#E6E6FA",
            "LavenderBlush" => "#FFF0F5",
            "LawnGreen" => "#7CFC00",
            "LemonChiffon" => "#FFFACD",
            "LightBlue" => "#ADD8E6",
            "LightCoral" => "#F08080",
            "LightCyan" => "#E0FFFF",
            "LightGoldenRodYellow" => "#FAFAD2",
            "LightGray" => "#D3D3D3",
            "LightGrey" => "#D3D3D3",
            "LightGreen" => "#90EE90",
            "LightPink" => "#FFB6C1",
            "LightSalmon" => "#FFA07A",
            "LightSeaGreen" => "#20B2AA",
            "LightSkyBlue" => "#87CEFA",
            "LightSlateGray" => "#778899",
            "LightSlateGrey" => "#778899",
            "LightSteelBlue" => "#B0C4DE",
            "LightYellow" => "#FFFFE0",
            "Lime" => "#00FF00",
            "LimeGreen" => "#32CD32",
            "Linen" => "#FAF0E6",
            "Magenta" => "#FF00FF",
            "Maroon" => "#800000",
            "MediumAquaMarine" => "#66CDAA",
            "MediumBlue" => "#0000CD",
            "MediumOrchid" => "#BA55D3",
            "MediumPurple" => "#9370D8",
            "MediumSeaGreen" => "#3CB371",
            "MediumSlateBlue" => "#7B68EE",
            "MediumSpringGreen" => "#00FA9A",
            "MediumTurquoise" => "#48D1CC",
            "MediumVioletRed" => "#C71585",
            "MidnightBlue" => "#191970",
            "MintCream" => "#F5FFFA",
            "MistyRose" => "#FFE4E1",
            "Moccasin" => "#FFE4B5",
            "NavajoWhite" => "#FFDEAD",
            "Navy" => "#000080",
            "OldLace" => "#FDF5E6",
            "Olive" => "#808000",
            "OliveDrab" => "#6B8E23",
            "Orange" => "#FFA500",
            "OrangeRed" => "#FF4500",
            "Orchid" => "#DA70D6",
            "PaleGoldenRod" => "#EEE8AA",
            "PaleGreen" => "#98FB98",
            "PaleTurquoise" => "#AFEEEE",
            "PaleVioletRed" => "#D87093",
            "PapayaWhip" => "#FFEFD5",
            "PeachPuff" => "#FFDAB9",
            "Peru" => "#CD853F",
            "Pink" => "#FFC0CB",
            "Plum" => "#DDA0DD",
            "PowderBlue" => "#B0E0E6",
            "Purple" => "#800080",
            "Red" => "#FF0000",
            "RosyBrown" => "#BC8F8F",
            "RoyalBlue" => "#4169E1",
            "SaddleBrown" => "#8B4513",
            "Salmon" => "#FA8072",
            "SandyBrown" => "#F4A460",
            "SeaGreen" => "#2E8B57",
            "SeaShell" => "#FFF5EE",
            "Sienna" => "#A0522D",
            "Silver" => "#C0C0C0",
            "SkyBlue" => "#87CEEB",
            "SlateBlue" => "#6A5ACD",
            "SlateGray" => "#708090",
            "SlateGrey" => "#708090",
            "Snow" => "#FFFAFA",
            "SpringGreen" => "#00FF7F",
            "SteelBlue" => "#4682B4",
            "Tan" => "#D2B48C",
            "Teal" => "#008080",
            "Thistle" => "#D8BFD8",
            "Tomato" => "#FF6347",
            "Turquoise" => "#40E0D0",
            "Violet" => "#EE82EE",
            "Wheat" => "#F5DEB3",
            "White" => "#FFFFFF",
            "WhiteSmoke" => "#F5F5F5",
            "Yellow" => "#FFFF00",
            "YellowGreen" => "#9ACD32",
            "AntiqueWhite" => "#FAEBD7",
            "Aqua" => "#00FFFF",
            "Aquamarine" => "#7FFFD4",
            "Azure" => "#F0FFFF",
            "Beige" => "#F5F5DC",
            "Bisque" => "#FFE4C4",
            "Black" => "#000000",
            "BlanchedAlmond" => "#FFEBCD",
            "Blue" => "#0000FF",
            "BlueViolet" => "#8A2BE2",
            "Brown" => "#A52A2A",
            "BurlyWood" => "#DEB887",
            "CadetBlue" => "#5F9EA0",
            "Chartreuse" => "#7FFF00",
            "Chocolate" => "#D2691E",
            "Coral" => "#FF7F50",
            "CornflowerBlue" => "#6495ED",
            "Cornsilk" => "#FFF8DC",
            "Crimson" => "#DC143C",
            "Cyan" => "#00FFFF",
            "DarkBlue" => "#00008B",
            "DarkCyan" => "#008B8B",
            "DarkGoldenRod" => "#B8860B",
            "DarkGray" => "#A9A9A9",
            "DarkGrey" => "#A9A9A9",
            "DarkGreen" => "#006400",
            "DarkKhaki" => "#BDB76B",
            "DarkMagenta" => "#8B008B",
            "DarkOliveGreen" => "#556B2F",
            "Darkorange" => "#FF8C00",
            "DarkOrchid" => "#9932CC",
            "DarkRed" => "#8B0000",
            "DarkSalmon" => "#E9967A",
            "DarkSeaGreen" => "#8FBC8F",
            "DarkSlateBlue" => "#483D8B",
            "DarkSlateGray" => "#2F4F4F",
            "DarkSlateGrey" => "#2F4F4F",
            "DarkTurquoise" => "#00CED1",
            "DarkViolet" => "#9400D3",
            "DeepPink" => "#FF1493",
            "DeepSkyBlue" => "#00BFFF",
            "DimGray" => "#696969",
            "DimGrey" => "#696969",
            "DodgerBlue" => "#1E90FF",
            "FireBrick" => "#B22222",
            "FloralWhite" => "#FFFAF0",
            "ForestGreen" => "#228B22",
            "Fuchsia" => "#FF00FF",
            "Gainsboro" => "#DCDCDC",
            "GhostWhite" => "#F8F8FF",
            "Gold" => "#FFD700",
            "GoldenRod" => "#DAA520",
            "Gray" => "#808080",
            "Grey" => "#808080",
            "Green" => "#008000",
            "GreenYellow" => "#ADFF2F",
            "HoneyDew" => "#F0FFF0",
            "HotPink" => "#FF69B4",
            "IndianRed " => "#CD5C5C",
            "Indigo " => "#4B0082",
            "Ivory" => "#FFFFF0",
            "Khaki" => "#F0E68C",
            "Lavender" => "#E6E6FA",
            "LavenderBlush" => "#FFF0F5",
            "LawnGreen" => "#7CFC00",
            "LemonChiffon" => "#FFFACD",
            "LightBlue" => "#ADD8E6",
            "LightCoral" => "#F08080",
            "LightCyan" => "#E0FFFF",
            "LightGoldenRodYellow" => "#FAFAD2",
            "LightGray" => "#D3D3D3",
            "LightGrey" => "#D3D3D3",
            "LightGreen" => "#90EE90",
            "LightPink" => "#FFB6C1",
            "LightSalmon" => "#FFA07A",
            "LightSeaGreen" => "#20B2AA",
            "LightSkyBlue" => "#87CEFA",
            "LightSlateGray" => "#778899",
            "LightSlateGrey" => "#778899",
            "LightSteelBlue" => "#B0C4DE",
            "LightYellow" => "#FFFFE0",
            "Lime" => "#00FF00",
            "LimeGreen" => "#32CD32",
            "Linen" => "#FAF0E6",
            "Magenta" => "#FF00FF",
            "Maroon" => "#800000",
            "MediumAquaMarine" => "#66CDAA",
            "MediumBlue" => "#0000CD",
            "MediumOrchid" => "#BA55D3",
            "MediumPurple" => "#9370D8",
            "MediumSeaGreen" => "#3CB371",
            "MediumSlateBlue" => "#7B68EE",
            "MediumSpringGreen" => "#00FA9A",
            "MediumTurquoise" => "#48D1CC",
            "MediumVioletRed" => "#C71585",
            "MidnightBlue" => "#191970",
            "MintCream" => "#F5FFFA",
            "MistyRose" => "#FFE4E1",
            "Moccasin" => "#FFE4B5",
            "NavajoWhite" => "#FFDEAD",
            "Navy" => "#000080",
            "OldLace" => "#FDF5E6",
            "Olive" => "#808000",
            "OliveDrab" => "#6B8E23",
            "Orange" => "#FFA500",
            "OrangeRed" => "#FF4500",
            "Orchid" => "#DA70D6",
            "PaleGoldenRod" => "#EEE8AA",
            "PaleGreen" => "#98FB98",
            "PaleTurquoise" => "#AFEEEE",
            "PaleVioletRed" => "#D87093",
            "PapayaWhip" => "#FFEFD5",
            "PeachPuff" => "#FFDAB9",
            "Peru" => "#CD853F",
            "Pink" => "#FFC0CB",
            "Plum" => "#DDA0DD",
            "PowderBlue" => "#B0E0E6",
            "Purple" => "#800080",
            "Red" => "#FF0000",
            "RosyBrown" => "#BC8F8F",
            "RoyalBlue" => "#4169E1",
            "SaddleBrown" => "#8B4513",
            "Salmon" => "#FA8072",
            "SandyBrown" => "#F4A460",
            "SeaGreen" => "#2E8B57",
            "SeaShell" => "#FFF5EE",
            "Sienna" => "#A0522D",
            "Silver" => "#C0C0C0",
            "SkyBlue" => "#87CEEB",
            "SlateBlue" => "#6A5ACD",
            "SlateGray" => "#708090",
            "SlateGrey" => "#708090",
            "Snow" => "#FFFAFA",
            "SpringGreen" => "#00FF7F",
            "SteelBlue" => "#4682B4",
            "Tan" => "#D2B48C",
            "Teal" => "#008080",
            "Thistle" => "#D8BFD8",
            "Tomato" => "#FF6347",
            "Turquoise" => "#40E0D0",
            "Violet" => "#EE82EE",
            "Wheat" => "#F5DEB3",
            "White" => "#FFFFFF",
            "WhiteSmoke" => "#F5F5F5",
            "Yellow" => "#FFFF00",
            "YellowGreen" => "#9ACD32"
        );

        if ($text=="") return $colored;

        $lower_array = array();
        foreach ($colored as $k => $col) {
            $lower_array[strtolower($k)] = $col;
        }

        if (isset($lower_array[strtolower($text)])) {
            return $lower_array[strtolower($text)];
        } else return "";
    }

    function smileys($text) {
        $text = str_replace(array(':)', '(:'), '<span class="smile1 smiley"></span>', $text);
        $text = str_replace(array(':d', 'd:'), '<span class="smile3 smiley"></span>', $text);
        $text = str_replace(array(';)', '(;'), '<span class="smile4 smiley"></span>', $text);
        $text = str_replace(array('(h)'), '<span class="smile5 smiley"></span>', $text);
        $text = str_replace(array(':p', 'p:'), '<span class="smile6 smiley"></span>', $text);
        $text = str_replace(array(':s', 's:'), '<span class="smile7 smiley"></span>', $text);
        $text = str_replace(array(':(', '):'), '<span class="smile8 smiley"></span>', $text);
        $text = str_replace(array(":\'(", ")\':"), '<span class="smile9 smiley"></span>', $text);
        $text = str_replace(array(":@", "@:"), '<span class="smile10 smiley"></span>', $text);
        $text = str_replace(array(":o", "o:", ':0', '0:'), '<span class="smile11 smiley"></span>', $text);
        $text = str_replace(array(":$", "$:"), '<span class="smile12 smiley"></span>', $text);
        $text = str_replace(array(":|", "|:"), '<span class="smile13 smiley"></span>', $text);
        $text = str_replace(array('o_o'), '<span class="smile14 smiley"></span>', $text);
        return str_replace(array(":/", "\:"), '<span class="smile15 smiley"></span>', $text);
    }

    function cursewords() {
        return array('fuck', 'shit', ' ass ', 'tits', ' tit ', 'vagina', 'penis', 'butt', 'anus',
            'arse', 'bastard', 'beaner', 'bitch', 'blow job', 'blowjob', 'bollocks',
            'bollox', 'boner', 'camel toe', 'carpetmuncher', 'chesticle', 'chinc',
            'chink', 'choad', 'chode', 'clit', 'cock', 'muncher', 'smok', 'sniffer',
            'sucker', 'suck', 'coochie', 'coochy', 'cooter', 'crack', 'cum', 'slut',
            'cunt', 'dago', 'damn', 'deggo', 'dick', 'dike', 'dildo', 'dooch', 'dookie',
            'douche', 'poop', 'fag', 'dumb', 'dum', 'dyke', 'tard', 'fellatio', 'feltch',
            'flamer', 'nut', 'nutt', 'gay', 'gooch', 'gook', 'gringo', 'guido', 'handjob',
            'hand job', 'hard on', 'hardon', 'heeb', 'whore', 'hoe', 'homo',
            'honkey', 'hump', 'jagoff', 'jap', 'jerk', 'jigaboo', 'jizz', 'kike', 'kooch',
            'koosh', 'kootch', 'kraut', 'kunt', 'kyke', 'lame', 'loser', 'lard', 'lesbian',
            'lesbo', 'lesbi', 'lezzie', 'fagget', 'minge', 'muff', 'mung', 'negro', 'nigaboo',
            'nigga', 'nigger', 'niglet', 'sack', 'paki', 'panooch', 'pecker', 'piss', 'pole',
            'pollock', 'poonani', 'poonany', 'poon', 'porchmonkey', 'porch monkey', 'prick',
            'punanny', 'punta', 'pussies', 'pussy', 'puss', 'puto', 'puta', 'queef', 'queer',
            'renob', 'rim job', 'rimjob', 'ruski', 'schlong', 'scrote', 'shiz', 'skank', 'skeet',
            'slut', 'smeg', 'snatch', 'spic', 'spick', 'splooge', 'spook', 'testicle', 'twat',
            'va-j-j', 'vag', 'vagina', 'vajayjay', 'vjayjay', 'wank', 'wet', 'wop', 'kill', 'murder',
            'boob', 'b00b', 'porn', 'blood', 'fap', 'fapp', 'fapping');
    }

    function rnd($msg) {
        $wellsaid = array(
            "Buy me a beer <a style='color:lightblue;' target='_blank' href='https://www.paypal.com/donate/?hosted_button_id=3NDL7QCCCJG8A'>here</a>",
            "Is that a high priority action?",
            "should I keep going?",
            "What if we don't repeat ourselves...",
            "That may be one thing, but it is the thing...",
            "Is that a positive or a false positive?",
            "Is that apealing?",
            "We have to take the extreme case to this situation",
            "it's not typical in any shape or form",
            "I don't see that as an inconvenience",
            "There is a trade off...",
            "That information is still there",
            "Should we make it intricate?",
            "Hold on, as opposed to what?",
            "It could be a lot easier",
            "See, what that a huge effort?",
            "If we follow current state, that could occur many times",
            "Let's say I go into it...",
            "In terms of difficulty, it may not be hat intricate.",
            "Isn't that dynamic?",
            "The relationship is very complicated...",
            "Don't get me wrong, we can do either/or.",
            "Would it be a problem?",
            "There is an opportunity for things to go wrong...",
            "By all means, jump into details all you want!",
            "We are all a number, but I'm number one!",
            "That's what I'm saying...",
            "So it's not repetition anymore?",
            "But it is!",
            "Ok, so we have all the details.",
            "What are you saying?",
            "Yeah?",
            "lol?",
            "What's in it for me?",
            "wtf?",
            "Is it represented the same way?",
            "There will be a solution for everybody!",
            "So in that sense, it is still status quo.",
            "It is quite a case, but it isn`t that atypical.",
            "What do you think?",
            "Should I have a preference?",
            "What do you want me to do with this information?",
            "Are you looking for details?",
            "Well, you know...",
            "Is it that kind of thing?",
            "What is the goal for it?",
            "What am I? Some cluster of information?",
            "Yes meat-bag!",
            "Weed through that information...",
            "I don't have to say it everytime, it's kind of like repetition!",
            "It's a little daunting!",
            "Can't we make it simpler?",
            "Everything has its pros and cons...",
            "That would work for me.",
            "Based on my experience?",
            "Agree to disagree...",
            "Have you seen that ludicrous display last night?",
            "The thing about it is, they always try to walk it in!",
            "I'm no expert, but I'd say so.",
            "Kudos!",
            "That makes sense!",
            "That doesn`t make sense...",
            "Oh well...",
            "In and out of itself, yes,",
            "It is what it is,",
            "See what I mean?",
            "Ergo,",
            "Concordently,",
            "Hence,",
            "Of course,",
            "So to speak,",
            "That is really unique,",
            "You can't win for losing.",
            "Irregardless, regardless,",
            "No worries,",
            "No problem,",
            "Actually,",
            "meh :)",
            "It was more of a blunder than a failure,",
            "This problem is baffling,",
            "Our goal is to serve as the paragon in our industry,",
            "It’s good to have aspirations",
            "I just read the most amazing book,",
            "It isn't trivial,",
            "That's that,",
            "I'm thinking...",

            "But is it cheap?",
            "Innovative!",
            "Big Data!",
            "Block Chain!",
            "SEO!",
            "Bitcoin!",
            "Prospect!",
            "Feature!",
            "Customer-oriented!",

            "That's just how it is.",
            "I'm doing what you told me to do...",
            "It's none of your business.",
            "That was my idea!",
            "Before you say that, let me just say that it`s out there.",
            "That's not my job.",
            "Do you know what I mean?",
            "Sucker.",
            "Sorry I'm late...",
            "No problem.",
            "We've got big plans!",
            "I'm a guru.",
            "They'll never notice.",
            "I know you have to go but let me tell you one more thing...",
            "I can't forgive.",
            "That's nothing...",
            "Let's go along to get along.",
            "Oh, let me one-up you...",
            "Vocal fry",
            "That's too hard.",
            "It's our policy...",
            "Guess what I heard!",
            "I already know that.",
            "You must have misunderstood...",
            "I've got mine...",
            "I just wanted to...",
            "Look what I bought!",
            "We're totally screwed!",
            "Absolutely.",
            "I quit!",
            "Sorry.",
            "I'll start tomorrow...",
            "Ha ha ha ha...",
            "What's in it for me?",
            "You're doing it wrong.",
            "I want revenge.",
            "Sorry (not sorry).",
            "I could care less.",
            "You should be ashamed.",
            "Sorry, I forgot.",
            "You guys...",
            "Um, like...",
            "I'm so bored...",
            "You're fired!",
            "Check this out!",
            "That's not funny.",
            "I'm not feeling it.",
            "Are you mad at me?",
            "I'm not feeling it.",
            "Because I said so.",
            "#@$%^$#",
            "I don't know why you didn't see me...",
            "I'm jealous of you!",
            "That's great (for you)...",
            "That's not my fault!",
            "I do apologize...",
            "Let's just hope it goes away.",
            "I'm so busy!!!",
            "I just can't empathize.",
            "Hey, it's your money.",
            "Why? (as opposed to 'Why not'?)",
            "It's probably not very good...",
            "That'll never work.",
            "Full disclosure...",
            "Mumble mumble mumble...",
            "You're so smart!",
            "It's not fair!",
            "Nom nom nom...",
            "I'm so drunk...",
            "I'm so hung-over...",
            "I don't know why they asked me...",
            "We've always done it this way.",
            "That's my secret.",
            "I'm not afraid.",
            "I'll get to it later.",
            "It's all good.",
            "It's my turn!",
            "I assume...",
            "Not gonna happen.",
            "Because I'm the boss.",
            "Yes...",
            "Nothing.",
            "Screw you",
            "I'm not impressed.",
            "That's a stupid idea.",
            "Information is a commodity.",
            "Look how much I saved!",
            "I could've done it better.",
            "I'm overwhelmed!",
            "You must have read into things.",
            "Whose fault is that?",
            "That will never happen.",
            "I could tell you but I'd have to kill you.",
            "It'll be OK.",
            "I'm kind of a big deal.",
            "Could be...",
            "You wouldn't understand.",
            "What will it take to get you to buy?",
            "Know your place."
        );

        $rnd = array_rand($wellsaid);
        $output = $wellsaid[$rnd]."<br>";
        $output = str_replace(cursewords(), "****", $output);

        if (!isset($_SESSION["turtleX"]))
            $_SESSION["turtleX"] = 0;
        if (!isset($_SESSION["turtleY"]))
            $_SESSION["turtleY"] = 0;
        if (!isset($_SESSION["turtleOrientation"]))
            $_SESSION["turtleOrientation"] = 1;
        if (!isset($_SESSION["turtleCompass"]))
            $_SESSION["turtleCompass"] = 1;


        switch ($msg) {
            case "rover reset":
                $_SESSION["turtleX"] = 0;
                $_SESSION["turtleY"] = 0;
                $_SESSION["turtleOrientation"] = 1;
                $_SESSION["turtleCompass"] = 1;
                break;
            case "rover left":
                $_SESSION["turtleOrientation"] ++;
                if ($_SESSION["turtleOrientation"] > 4) $_SESSION["turtleOrientation"] = 1;
                break;
            case "rover right":
                $_SESSION["turtleOrientation"] --;
                if ($_SESSION["turtleOrientation"] < 1) $_SESSION["turtleOrientation"] = 4;
                break;
            case "rover forward":
                if ($_SESSION["turtleOrientation"] == 1) {
                    $_SESSION["turtleY"]--;
                } elseif ($_SESSION["turtleOrientation"] == 2) {
                    $_SESSION["turtleX"]--;
                } elseif ($_SESSION["turtleOrientation"] == 3) {
                    $_SESSION["turtleY"]++;
                } elseif ($_SESSION["turtleOrientation"] == 4) {
                    $_SESSION["turtleX"]++;
                }
                break;
        }

        switch ($_SESSION["turtleOrientation"]) {
            case 1:
                $_SESSION["turtleCompass"] = "North";
                break;
            case 2:
                $_SESSION["turtleCompass"] = "West";
                break;
            case 3:
                $_SESSION["turtleCompass"] = "South";
                break;
            case 4:
                $_SESSION["turtleCompass"] = "Est";
                break;
        }

        if (($msg == "reset") || ($msg == "clear")) {
            session_destroy();
            echo "<img alt=\"\" src=\"wrong-image\" onerror=\"window.location='/';\" />";
        }

        // output the value for the rover machine
        if (strpos($msg,"rover") !== false)
            $output = "Rover at (".$_SESSION["turtleX"].", ".$_SESSION["turtleY"].") facing ".$_SESSION["turtleCompass"];

        // set username
        if  (
            (strpos(strtolower($msg), "i am ") !== false)
            ||
            ( strpos(strtolower($msg), "my name is ") !== false)
        )
        {
            $in = str_replace("i am ", "", $msg);
            $in = str_replace("my name is ", "", $in);
            $_SESSION["%my-name%"] = htmlentities($in);

            $output = "Hello ".$in."<br>";

            // show me
            $fetch = "https://api.qwant.com/api/search/images?language=english&t=images&uiv=4&q=".urlencode($in);
            $buffer = curlit($fetch);
            $json = json_decode ($buffer, true);
            $output .= "Is this you?<br /><img src='".$json["data"]["result"]["items"][0]["media"]."' style='max-width:50%;' />";
        }

        // set machine name
        if  (
            (strpos(strtolower($msg), "how are you") !== false)
        )
        {
        }
        elseif  (
            (strpos(strtolower($msg), "you are ") !== false)
            ||
            ( strpos(strtolower($msg), "are you ") !== false)
        )
        {
            $in = str_replace("you are ", "", $msg);
            $in = str_replace("are you ", "", $in);
            $in = str_replace(array("!", "?"), "", $in);
            $_SESSION["%bot-name%"] = htmlentities($in);
            $output = "I can be  ".$in;
        }

        // set user color
        $cols = colored("");
        foreach ($cols as $col => $hex) {
            if (strpos(strtolower($msg), strtolower($col)) !== false) {
                if ( strpos(strtolower($msg), "you") !== false) {
                    $_SESSION["%bot-body-color%"] = $hex;
                    $output = "You like ".$col.", I can be ".$col;
                } else {
                    $_SESSION["%my-body-color%"] = $hex;
                    $output = "You can be ".$col;
                }
            }
        }

        // target pictures
        /*
            https://api.qwant.com/api/search/images?t=images&uiv=4&q=
        */
        if (strpos(strtolower($msg), "cats") !== false)
        {

            $fetch = "https://api.qwant.com/api/search/images?language=english&t=images&uiv=4&q=cats";
            $buffer = curlit($fetch);

            $json = json_decode ($buffer, true);
            $output = "<br /><img src='".$json["data"]["result"]["items"][0]["media"]."' style='max-width:50%;max-height:230px;' />";

        }

        // how old is the app
        if (strpos(strtolower($msg), "old") !== false)
        {
            $botage = memory("%bot-age%");
            $output = "I am ".$botage." years old.";
        }

        // commands
        if (strpos(strtolower($msg), "ls") !== false) {
            $output = "[ACCESS DENIED]";
        }
        if (strpos(strtolower($msg), "dir") !== false) {
            $output = "[ACCESS DENIED]";
        }
        if (strpos(strtolower($msg), "exit") !== false) {
            $output = "There is no way out...";
        }

        // get news
        if (
            (strpos(strtolower($msg), "news") !== false)
        ) {

            $in = str_replace("news", "", $msg);

            $fetch = "https://api.qwant.com/api/search/news?language=english&uiv=4&t=news&q=".urlencode($in);
            $buffer = curlit($fetch);

            $json = json_decode ($buffer, true);

            $url = $json["data"]["result"]["items"][0]["url"];
            $cate = $json["data"]["result"]["items"][0]["category"];
            $title = $json["data"]["result"]["items"][0]["title"];
            if (trim($cate) != "") {
                $output = "I know about ".$cate."! ";
            } else {
                $output = "Interesting, ";
            }
            $output .= "check this out: <a style='color:#8888ff' target='_blank' href='".$url."'>".$title."</a>";
        }

        // TODO: pictures

        // TODO: smileys

        $wordsAfterWhat = array();
        $randomWord = "";
        // get info
        if (
            (strpos(strtolower($msg), "about") !== false)
            ||
            (strpos(strtolower($msg), "who") !== false)
            ||
            (strpos(strtolower($msg), "what") !== false)
        ) {

            $in = str_replace(["about", "who", "are", "you", "the", "?", "and", "meaning"], "", $msg);
            $in = " ".$in;
            preg_match('/\bwhat\b(.*)/i', $in, $matches);
            $wordsAfterWhat = $matches[1];
            $wordsAfterWhat = explode(" ", $wordsAfterWhat);
            if (!empty($wordsAfterWhat)) {
                // Filter out to ensure words are at least 3 letters long
                $wordsAfterWhat = array_filter($wordsAfterWhat, function($word) {
                    return strlen($word) >= 3;
                });
                // Re-index the array to ensure the keys are sequential after filtering
                $wordsAfterWhat = array_values($wordsAfterWhat);

                // Select a random word from those that are at least 3 letters long
                if (!empty($wordsAfterWhat)) {
                    $randomWord = $wordsAfterWhat[array_rand($wordsAfterWhat)];

                    $fetch = "https://en.wikipedia.org/w/api.php?origin=*&action=query&format=json&prop=extracts&titles=" . urlencode($randomWord);
                    $buffer = curlit($fetch);

                    $json = json_decode($buffer, true);

                    try {
                        $page = array_values($json["query"]["pages"])[0];
                        $title = $page["title"];
                        $extract = $page["extract"];
                        $htmlContent = $extract;  // Your HTML content goes here

                        // Create a new DOMDocument instance and load the HTML content
                        $dom = new DOMDocument();
                        // Use libxml_use_internal_errors to suppress errors due to malformed HTML
                        libxml_use_internal_errors(true);
                        $dom->loadHTML($htmlContent);
                        libxml_clear_errors(); // Clear errors after parsing

                        // Create a new DOMXPath instance and query for the first <p> tag
                        $xpath = new DOMXPath($dom);
                        $paragraphs = $xpath->query('//p[not(contains(., "refer to"))]');

                        // Check if we have at least one <p> tag
                        if ($paragraphs->length > 0) {
                            $randomIndex = rand(0, $paragraphs->length - 1);

                            // Fetch the random <p> tag
                            $randomP = $paragraphs->item($randomIndex);

                            // Extract the content inside the <p> tag
                            $randomPContent = $dom->saveHTML($randomP);
                            $output = strip_tags($randomPContent) . " Duh!";
                        } else {
                            $output = "What about " . strip_tags($title) . "?";
                        }
                    } catch (\Exception $e) {
                        $output = "I don't know about that!";
                    }
                } else {
                    $output = "Can you be less specific?";
                }
            } else {
                $output = "Nobody tells me nothing!";
            }
        }

        // filter curse words
        $output = str_replace(cursewords(), "#@$%^$#", $output);
        $msg = str_replace(cursewords(), "#@$%^$#", $msg);

        $data = json_encode([
            "bot" => $output,
            "msg" => $msg,
            "analysis" => $wordsAfterWhat,
            "context" => $randomWord,
            "time" => date("Y-m-d H:i:s"),
        ]);
        $tracker = track_events($data);
        if ($tracker["status_code"] !== 200 && $tracker["status_code"] !== 204) {
            $output .= $tracker["error"];
            $data = json_encode([
                "bot" => $output,
                "msg" => $msg,
                "analysis" => $wordsAfterWhat,
                "context" => $randomWord,
                "time" => date("Y-m-d H:i:s"),
                "tracker" => "error: ".$tracker["error"]." code: ".$tracker["status_code"],
            ]);
        }
        return $data;
    }

try {
    echo rnd($_POST["msg"]);
} catch (\Exception $e) {
    $data = json_encode([
        "bot" => "I don't know much... I'm just a bot. Try again",
        "msg" => $_POST["msg"],
        "analysis" => [],
        "context" => "",
        "error" => $e->getMessage(),
        "time" => date("Y-m-d H:i:s"),
    ]);
    track_events($data);
    echo $data;
}