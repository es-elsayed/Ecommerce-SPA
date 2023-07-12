<script setup>
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { getActiveLanguage } from 'laravel-vue-i18n';
</script>

<template>
    <button @click="getActiveLanguage() == 'ar' ? loadLanguageAsync('en') : loadLanguageAsync('ar');">
        {{ $t('general.change_lang') }}
    </button>
</template>


