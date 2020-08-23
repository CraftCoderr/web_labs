<?php

function renderErrors($model, $key) {
    if (array_key_exists('errors', $model)) {
        if (array_key_exists($key, $model['errors'])) {
            echo '<ul class="errorbox">';
            foreach ($model['errors'][$key] as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
    }
}

function keepValue($model, $key) {
    if (array_key_exists('keeper', $model)) {
        if (array_key_exists($key, $model['keeper'])) {
            return htmlspecialchars($model['keeper'][$key]);
        }
    }
    return null;
}

function keepCheckedValue($model, $key, $value) {
    if (array_key_exists('keeper', $model)) {
        if (array_key_exists($key, $model['keeper']) && $model['keeper'][$key] === $value) {
            return 'checked';
        }
    }
    return '';
}

?>