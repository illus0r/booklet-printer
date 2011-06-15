<?php
$messages = array (
    'en_US'=> array(
       'My favorite foods are' =>
           'My favorite foods are',
       'french fries' => 'french fries',
       'biscuit' => 'biscuit',
       'candy X' => 'candy %d',
       'potato chips' => 'potato chips',
       'cookie' => 'cookie',
       'corn' => 'corn',
       'eggplant' => 'eggplant'
    ),

    'en_GB'=> array(
        'My favorite foods are' =>
            'My favourite foods are',
        'french fries' => 'chips',
        'biscuit' => 'scone',
        'candy X' => 'sweets %d',
        'potato chips' => 'crisps',
        'cookie' => 'biscuit',
        'corn' => 'maize',
        'eggplant' => 'aubergine'
    )
);

function msg($s) {
    global $LANG;
    global $messages;
    
    if (isset($messages[$LANG][$s])) {
        return $messages[$LANG][$s];
    } else {
        error_log("l10n error:LANG:" . 
            "$lang,message:'$s'");
    }
}
?>

