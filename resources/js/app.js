require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import DataTable from 'laravel-vue-datatable';

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(DataTable);

Vue.component('select-component',{
  props: ['options'],
  mounted() {
  	var self = this;
  	this.$select2 = $(this.$el).select2({
    	data: this.options
    })
    .on('change', function(e){
    	self.$emit('input', $(e.target).val())
    });
  },
  
  watch: {
  	options (newOpts) {
    	this.$select2.empty().select2({
      	data: newOpts
			})
		}, 
  },
  template: '<select></select>'
})

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
