import Vue from 'vue'

import Focus from './directives/focus'

import MultiInput from './components/MultiInput.vue'

Vue.config.productionTip = false;

window.Event = new Vue();

Vue.directive('focus', Focus);

const app = new Vue({
    el: '#app',
    components: {
        MultiInput,
    }
});

window.app = app;
