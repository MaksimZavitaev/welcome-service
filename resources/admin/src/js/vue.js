import Vue from 'vue'

import Focus from './directives/focus'
import Mask from './directives/mask'

import MultiInput from './components/MultiInput.vue'

Vue.config.productionTip = false;

window.Event = new Vue();

Vue.directive('focus', Focus);
Vue.directive('mask', Mask);

const app = new Vue({
    el: '#app',
    components: {
        MultiInput,
    }
});

window.app = app;
