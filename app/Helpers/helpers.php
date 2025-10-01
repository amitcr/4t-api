<?php
use App\Models\OptionsModel;
use App\Models\PostModel;
use App\Core\Config;

if (!function_exists('dd')) {
    function dd(...$vars) {
        foreach ($vars as $v) {
            echo "<pre>";
            var_dump($v);
            echo "</pre>";
        }
        die(1);
    }
}

if (!function_exists('pr')) {
    function pr(...$vars) {
        foreach ($vars as $v) {
            echo "<pre>";
            print_r($v);
            echo "</pre>";
        }        
    }
}


if(!function_exists('get_personal_report_global_price')){
    function get_personal_report_global_price(){
        $settings = get_mytemp_settings();
        if(empty($settings))
            return;

        return $settings['assessment_price'];
    }
}

// Get Assessment Self Questions Page Link
if(!function_exists('get_assessment_self_page_link')){
    function get_assessment_self_page_link(){
        $page_id = get_assessment_self_page_id();
        if(empty($page_id))
            return;

        $post = PostModel::find($page_id);
        if(empty($post))
            return;

        return $post->guid;
    }
}

// Get Assessment Self Questions Page ID
if(!function_exists('get_assessment_self_page_id')){
    function get_assessment_self_page_id(){
        $settings = get_mytemp_settings();
        if(empty($settings))
            return;

        return $settings['mytemp_questions'];
    }
}


// Get Assessment Self Questions Page Link
if(!function_exists('get_assessment_needs_page_link')){
    function get_assessment_needs_page_link(){
        $page_id = get_assessment_needs_page_id();
        if(empty($page_id))
            return;

        $post = PostModel::find($page_id);
        if(empty($post))
            return;

        return $post->guid;
    }
}

// Get Assessment Needs Choices Page ID
if(!function_exists('get_assessment_needs_page_id')){
    function get_assessment_needs_page_id(){
        $settings = get_mytemp_settings();
        if(empty($settings))
            return;

        return $settings['mytemp_needassessment'];
    }
}

// Get Assessment Payment Page Link
if(!function_exists('get_assessment_payment_page_link')){
    function get_assessment_payment_page_link(){
        $page_id = get_assessment_payment_page_id();
        if(empty($page_id))
            return;

        $post = PostModel::find($page_id);
        if(empty($post))
            return;

        return $post->guid;
    }
}

// Get Assessment Payment Page ID
if(!function_exists('get_assessment_payment_page_id')){
    function get_assessment_payment_page_id(){
        $settings = get_mytemp_settings();
        if(empty($settings))
            return;

        return $settings['mytemp_payment_page'];
    }
}

if(!function_exists('get_mytemp_settings')){
    function get_mytemp_settings(){
        $settings = OptionsModel::where('option_name', 'mytemp_settings')->first();
        return unserialize($settings->option_value);
    }
}

if (!function_exists('get_settings_option')) {
    function get_settings_option($key)
    {
        // Case 1: dot notation string ("option.key1.key2")
        if (is_string($key) && strpos($key, '.') !== false) {
            $parts = explode('.', $key);
            $optionName = array_shift($parts);

            $option = OptionsModel::where('option_name', $optionName)->first();
            if (!$option) {
                return null;
            }

            $value = maybe_unserialize($option->option_value);

            foreach ($parts as $nestedKey) {
                if (is_array($value) && array_key_exists($nestedKey, $value)) {
                    $value = $value[$nestedKey];
                } else {
                    return null; // nested key not found
                }
            }
            return $value;
        }

        // Case 2: simple string (direct option_name)
        if (is_string($key)) {
            $option = OptionsModel::where('option_name', $key)->first();
            if (!$option) {
                return null;
            }
            return maybe_unserialize($option->option_value);
        }

        // Case 3: array syntax ['option_name' => ['nested_key']]
        if (is_array($key)) {
            $optionName = array_key_first($key);
            $nestedKeys = $key[$optionName];

            $option = OptionsModel::where('option_name', $optionName)->first();
            if (!$option) {
                return null;
            }

            $value = maybe_unserialize($option->option_value);

            foreach ((array)$nestedKeys as $nestedKey) {
                if (is_array($value) && array_key_exists($nestedKey, $value)) {
                    $value = $value[$nestedKey];
                } else {
                    return null;
                }
            }
            return $value;
        }

        return null;
    }
}


if (!function_exists('maybe_unserialize')) {
    function maybe_unserialize($original) {
        if (is_serialized($original)) {
            return @unserialize($original);
        }
        return $original;
    }
}

if (!function_exists('is_serialized')) {
    function is_serialized($data) {
        // simple check
        return ($data === 'b:0;' || @unserialize($data) !== false);
    }
}

if(!function_exists('get_app_option')){
    function get_app_option($key = ''){
        if(empty($key))
            return;

        $config = Config::get('app');
        return isset($config[$key]) ? $config[$key] : '';
    }
}

if(!function_exists('get_logo_url')){
    function get_logo_url(){
        return get_settings_option('home').'resources/images/logo.png';
    }
}

if(!function_exists('get_assessment_chart_image')){
    function get_assessment_chart_image(int $assessment_id, string $imageType = '', string $returnType = ''){
        if(empty($assessment_id) || $assessment_id == 0)
            return false;

        $imageName = !empty($imageType) ? $imageType.'_chart_'.$assessment_id.'.png': 'chart_'.$assessment_id.'.png';
        if(file_exists( PROJECT_ROOT.'/assessments/images/'.$imageName )){
            if(empty($returnType) || $returnType == "url"){
                return get_settings_option('home') .'assessments/images/'.$imageName;
            }else{
                return PROJECT_ROOT.'/assessments/images/'.$imageName;
            }
        }

        return false;
    }
}

if(!function_exists('get_assessment_participant_name')){
    function get_assessment_participant_name($assessment, $nameType = 'full'){
        if(empty($assessment))
            return '';

        $participantName = !empty($assessment->first_name) ? $assessment->first_name.' '.$assessment->last_name : (isset($assessment->user) ? $assessment->user_display_name : '');
        $participantFirstName = !empty($assessment->first_name) ? $assessment->first_name : '';
        if(empty($participantName)){
            $participantFirstName = UserMetaModel::where(['user_id' => $assessment->user_id, 'meta_key' => 'first_name'])->value('meta_value');
            $participantLastName = UserMetaModel::where(['user_id' => $assessment->user_id, 'meta_key' => 'last_name'])->value('meta_value');

            if(!empty($participantFirstName)){
                $participantName = $participantFirstName;
                if(!empty($participantLastName)){
                    $participantName .= ' '.$participantLastName;
                }
            }
        }
        if($nameType == 'first')
            return $participantFirstName;
        else if($nameType == 'last')
            return $participantLastName;
        else
            return $participantName;
    }
}